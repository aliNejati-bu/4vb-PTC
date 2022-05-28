let addPhoneBtn = document.getElementById("sendMobileButton")
let addPhoneErrorFlag = false;
let time = 150;
let status = 1;

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
    if (result.status == 409) {
        endLoading();
        let data = await result.json();
        console.log(data);
        document.getElementById("phone").classList.add("parsley-error");
        document.getElementById("phoneFildConteiner").innerHTML = document.getElementById("phoneFildConteiner").innerHTML + "<ul class=\"parsley-errors-list filled\" id=\"parsley-id-5\"><li class=\"parsley-required\">شماره تلفن تکراری است</li></ul>";
        return
    } else if (result.status != 200) {
        endLoading();
        document.getElementById("phone").classList.add("parsley-error");
        document.getElementById("phoneFildConteiner").innerHTML = document.getElementById("phoneFildConteiner").innerHTML + "<ul class=\"parsley-errors-list filled\" id=\"parsley-id-5\"><li class=\"parsley-required\">خطای نا شناخته</li></ul>";
        return
    } else {
        resend();
        document.getElementById("playGround").innerHTML = `
<div class="account-box">
                                <div class="account-logo-box">
                                    <div class="text-center">
                                        <a href="index.html">
                                            <img src="/assets/images/logo-dark.png" alt="" height="30">
                                        </a>
                                    </div>
                                    <h5 id="notifer" class="text-uppercase mb-1 mt-4 alert-success">کد تایید ارسال شد...</h5>
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
                                                    type="submit" >ارسال مجدد
                                                  ( <span id="timerForResend">120</span> )
                                            </button>
                                        </div>
                                    </div>
                                    <p style="text-align: center;font-size: 2rem" id="loadingBox"></p>

                                </div>
                            
                           
                     <div id="editPhone">
                     
</div>
                            </div>
        
        
        `;
        document.getElementById("resendCodeBtn").disabled = true;
        setInterval(() => {
            document.getElementById("timerForResend").innerText = time.toString();
            if (time != 0) {
                document.getElementById("resendCodeBtn").disabled = true;
                time--;
            } else {
                document.getElementById("resendCodeBtn").disabled = false;
            }
        }, 1000);

        document.getElementById("resendCodeBtn").addEventListener("click", resend);
        setTimeout(()=>{
            document.getElementById("editPhone").innerHTML = `
            <div class="row mt-4 pt-2">
                                    <div class="col-sm-12 text-center">
                                        <p class="text-muted mb-0 ">شماره تلفن اشتباه است؟ <a href="${verifyPhone}" class="text-dark ml-1"><b>
                                                    ویرایش شماره</b></a></p>
                                    </div>
                                </div>
            `;
        },200000);
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
        document.getElementById("codeFild").innerHTML = document.getElementById("codeFild").innerHTML + "<ul class=\"parsley-errors-list filled\" id=\"parsley-id-5\"><li class=\"parsley-required\">کد تایید نا معتبر و یا منقضی شده.</li></ul>";
        endLoading();
    }

    if (result.status != 200) {
        endLoading()
        return "";
    }
    document.getElementById("playGround").innerHTML = "";
    window.location.replace(appUrl + panelRoute);
}


async function resend() {
    time = 125;
    fetch(appUrl + sendVerifyCodeRoute, {
        method: "GET",
        headers: {'Content-Type': 'application/json', 'Authorization': 'Bearer ' + token},
    }).then(result => {
        if (result.status != 200) {
            document.getElementById("notifer").classList.remove("alert-success")
            document.getElementById("notifer").classList.add("alert-danger");
            document.getElementById("notifer").innerText = "کد تایید ارسال نشد. (کمی بعد دوباره امتحان کنید.)";
        } else {
            document.getElementById("notifer").classList.remove("alert-danger")
            document.getElementById("notifer").classList.add("alert-success");
            document.getElementById("notifer").innerText = "کد تایید ارسال شد...";
        }
    });

}