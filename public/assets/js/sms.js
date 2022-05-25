let addPhoneBtn = document.getElementById("sendMobileButton")
let addPhoneErrorFlag = false;
addPhoneBtn.addEventListener("click", async (ev) => {
    startLoading();
    let phone = document.getElementById("phone").value;
    if (phone.length != 11 && !addPhoneErrorFlag) {
        addPhoneErrorFlag = true;
        document.getElementById("phone").classList.add("parsley-error");
        document.getElementById("phoneFildConteiner").innerHTML = document.getElementById("phoneFildConteiner").innerHTML + "<ul class=\"parsley-errors-list filled\" id=\"parsley-id-5\"><li class=\"parsley-required\">شماره تلفن معتبر نیست.</li></ul>";
        endLoading();
    }
    if (phone.length != 11) {
        endLoading();
        return
    }
    let result = await fetch(appUrl + addPhoneRoute, {
        method: "POST",
        headers: {'Content-Type': 'application/json', 'Authorization': 'Bearer ' + token},
        body: JSON.stringify({
            "phone_number": phone
        }),
    });
    if (result.status == 400) {
        endLoading();
        let data = await result.json();
        document.getElementById("phone").classList.add("parsley-error");
        document.getElementById("phoneFildConteiner").innerHTML = document.getElementById("phoneFildConteiner").innerHTML + "<ul class=\"parsley-errors-list filled\" id=\"parsley-id-5\"><li class=\"parsley-required\">" + data.messages.phone_number + "</li></ul>";
        return
    } else if (result.status != 200) {
        endLoading();
        document.getElementById("phone").classList.add("parsley-error");
        document.getElementById("phoneFildConteiner").innerHTML = document.getElementById("phoneFildConteiner").innerHTML + "<ul class=\"parsley-errors-list filled\" id=\"parsley-id-5\"><li class=\"parsley-required\">خطای نا شناخته</li></ul>";
        return
    } else {
        let result = await fetch(appUrl + sendVerifyCodeRoute, {
            method: "GET",
            headers: {'Content-Type': 'application/json', 'Authorization': 'Bearer ' + token},
        });
        if (result.status != 200) {
            endLoading();
            document.getElementById("phone").classList.add("parsley-error");
            document.getElementById("phoneFildConteiner").innerHTML = document.getElementById("phoneFildConteiner").innerHTML + "<ul class=\"parsley-errors-list filled\" id=\"parsley-id-5\"><li class=\"parsley-required\">یک کد تایید برای شما ارسال شده لطفا کمی صبر کنید.</li></ul>";
            return
        }
        document.getElementById("playGround").innerHTML = `
<div class="account-box">
                                <div class="account-logo-box">
                                    <div class="text-center">
                                        <a href="index.html">
                                            <img src="/assets/images/logo-dark.png" alt="" height="30">
                                        </a>
                                    </div>
                                    <h5 class="text-uppercase mb-1 mt-4 alert-success">کد تایید ارسال شد...</h5>
                                    <p class="mb-0">لطفا عبارت شش رقمی پیامک شده را وارد کنید.</p>
                                </div>

                                <div class="account-content mt-4">


                                    <div class="form-group row">
                                        <div class="col-12" id="codeFild">
                                            <label for="phone">کد تایید</label>
                                            <input class="form-control" type="text" name="phone" id="code"
                                                   required=""
                                                   placeholder="کد تایید را وارد کنید.">
                                        </div>
                                    </div>

                                    <div class="form-group row text-center mt-2">
                                        <div class="col-6">
                                            <button onclick="sendCode()" id="sendCodeBtn" class="btn btn-md btn-block btn-primary waves-effect waves-light ffiy"
                                                    type="submit">تایید شماره تماس
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <button id="resendCodeBtn" class="btn btn-md btn-block btn-primary waves-effect waves-light ffiy"
                                                    type="submit" disabled>ارسال مجدد
                                                  ( <span id="timerForResend">120</span> )
                                            </button>
                                        </div>
                                    </div>
                                    <p style="text-align: center;font-size: 2rem" id="loadingBox"></p>

                                </div>
                            </div>
        
        
        `;
    }
});


function startLoading() {
    document.getElementById("loadingBox").innerHTML = "صبر کنید....";
}

function endLoading() {
    document.getElementById("loadingBox").innerHTML = "";
}

let codeFlag = false;
let invalidCodeFlag = false;

async function sendCode() {
    startLoading();

    let code = document.getElementById('code').value;
    if (code != 6 && !codeFlag) {
        codeFlag = true;
        document.getElementById("code").classList.add("parsley-error");
        document.getElementById("codeFild").innerHTML = document.getElementById("codeFild").innerHTML + "<ul class=\"parsley-errors-list filled\" id=\"parsley-id-5\"><li class=\"parsley-required\">کد تایید نا معتبر.</li></ul>";
        endLoading();
    }

    if (code.length != 6) {
        endLoading()
        return "";
    }

    let result = await fetch(appUrl + verifyCodeRoute, {
        method: "POST",
        headers: {'Content-Type': 'application/json', 'Authorization': 'Bearer ' + token},
        body: JSON.stringify({
            "code": code
        }),
    });
    if (result.status != 200 && !invalidCodeFlag) {
        invalidCodeFlag = true;
        document.getElementById("code").classList.add("parsley-error");
        document.getElementById("codeFild").innerHTML = document.getElementById("codeFild").innerHTML + "<ul class=\"parsley-errors-list filled\" id=\"parsley-id-5\"><li class=\"parsley-required\">کد تایید نا معتبر.</li></ul>";
        endLoading();
    }

    if (result.status != 200) {
        endLoading()
        return "";
    }

    window.location.replace(appUrl + panelRoute);
}