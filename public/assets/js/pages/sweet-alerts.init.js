!function(t){"use strict";var e=function(){};e.prototype.init=function(){t("#sa-basic").on("click",function(){Swal.fire({title:"هر احمقی می تواند از رایانه استفاده کند!",confirmButtonClass:"btn btn-confirm mt-2"})}),t("#sa-title").click(function(){Swal.fire({title:"اینترنت داری؟",text:"آن چیز هنوز وجود دارد؟",type:"question",confirmButtonClass:"btn btn-confirm mt-2"})}),t("#sa-success").click(function(){Swal.fire({title:"کارت خوب بود",text:"شما کلیک کردید روی دکمه",type:"success",confirmButtonClass:"btn btn-confirm mt-2"})}),t("#sa-error").click(function(){Swal.fire({type:"error",title:"Oops...",text:"Something went wrong!",confirmButtonClass:"btn btn-confirm mt-2",footer:'<a href="">Why do I have this issue?</a>'})}),t("#sa-long-content").click(function(){Swal.fire({imageUrl:"https://placeholder.pics/svg/300x1500",imageHeight:1500,imageAlt:"A tall image",confirmButtonClass:"btn btn-confirm mt-2"})}),t("#sa-custom-position").click(function(){Swal.fire({position:"top-end",type:"success",title:"Your work has been saved",showConfirmButton:!1,timer:1500})}),t("#sa-warning").click(function(){Swal.fire({title:"آیا مطمنی؟",text:"ای مورد غیر قابل بازگشت است",type:"warning",showCancelButton:!0,confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:"بله پاکش کن"}).then(function(t){t.value&&Swal.fire("حذف شد!","فایل شما حذف شد","موفقیت")})}),t("#sa-params").click(function(){Swal.fire({title:"آیا مطمنی؟",text:"ای مورد غیر قابل بازگشت است",type:"warning",showCancelButton:!0,confirmButtonText:"بله پاکش کن",cancelButtonText:"لغوش کن",confirmButtonClass:"btn btn-success mt-2",cancelButtonClass:"btn btn-danger ml-2 mt-2",buttonsStyling:!1}).then(function(t){t.value?Swal.fire({title:"Deleted!",text:"Your file has been deleted.",type:"success"}):t.dismiss===Swal.DismissReason.cancel&&Swal.fire({title:"لغو شد",text:"پرونده خیالی شما ایمن است:)",type:"error"})})}),t("#sa-image").click(function(){Swal.fire({title:"پیام",text:"داشبورد مدیریتی بوت استرپ 4 واکنش گرا",imageUrl:"assets/images/logo-sm.png",imageHeight:50,animation:!1,confirmButtonClass:"btn btn-confirm mt-2"})}),t("#sa-close").click(function(){var t;Swal.fire({title:"بسته شدن خودکار",html:"بسته میشه در <strong></strong> ثانیه.",timer:2e3,onBeforeOpen:function(){Swal.showLoading(),t=setInterval(function(){Swal.getContent().querySelector("strong").textContent=Swal.getTimerLeft()},100)},onClose:function(){clearInterval(t)}}).then(function(t){t.dismiss===Swal.DismissReason.timer&&console.log("I was closed by the timer")})}),t("#custom-html-alert").click(function(){Swal.fire({title:"<i>اچ تی ام ال</i> <u>مثال</u>",type:"info",html:'شما می توانید استفاده کنید <b>متن کلفت</b>, <a href="//coderthemes.com/">لینک</a> ',showCloseButton:!0,showCancelButton:!0,confirmButtonClass:"btn btn-confirm mt-2",cancelButtonClass:"btn btn-cancel ml-2 mt-2",confirmButtonText:'<i class="mdi mdi-thumb-up-outline"></i> خوب!',cancelButtonText:'<i class="mdi mdi-thumb-down-outline"></i>'})}),t("#custom-padding-width-alert").click(function(){Swal.fire({title:"عرض سفارشی ، روکش ، پس زمینه.",width:600,padding:100,confirmButtonClass:"btn btn-confirm mt-2",background:"#fff url(//subtlepatterns2015.subtlepatterns.netdna-cdn.com/patterns/geometry.png)"})}),t("#ajax-alert").click(function(){Swal.fire({title:"نام کاربری گیت خود را ارسال کنید",input:"text",inputAttributes:{autocapitalize:"off"},showCancelButton:!0,confirmButtonText:"مشاهده",showLoaderOnConfirm:!0,preConfirm:function(t){return fetch("//api.github.com/users/"+t).then(function(t){if(!t.ok)throw new Error(t.statusText);return t.json()}).catch(function(t){Swal.showValidationMessage("Request failed: "+t)})},allowOutsideClick:function(){Swal.isLoading()}}).then(function(t){t.value&&Swal.fire({title:t.value.login+"'s avatar",imageUrl:t.value.avatar_url})})}),t("#chaining-alert").click(function(){Swal.mixin({input:"text",confirmButtonText:"بعدی",showCancelButton:!0,progressSteps:["1","2","3"]}).queue([{title:"سوال اول",text:"روش زنجیر زدن سیب به راحتی انجام می شود"},"سوال دوم","سوال سوم"]).then(function(t){t.value&&Swal.fire({title:"پایان!",html:"نتیجه شما: <pre><code>"+JSON.stringify(t.value)+"</code></pre>",confirmButtonText:"با عشق!"})})}),t("#dynamic-alert").click(function(){swal.queue([{title:"آی پی عمومی شما",confirmButtonText:"نشان دادن آی پی عمومی من",confirmButtonClass:"btn btn-confirm mt-2 ffiy",text:"آی پی عمومی شما از طریق درخواست آجاکس دریافت می شود",showLoaderOnConfirm:!0,preConfirm:function(){return new Promise(function(e){t.get("https://api.ipify.org?format=json").done(function(t){swal.insertQueueStep(t.ip),e()})})}}])})},t.SweetAlert=new e,t.SweetAlert.Constructor=e}(window.jQuery),function(t){"use strict";window.jQuery.SweetAlert.init()}();