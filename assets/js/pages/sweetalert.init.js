/*
Template Name: Minia - Admin & Dashboard Template
Author: Themesbrand
Website: https://themesbrand.com/
Contact: themesbrand@gmail.com
File: Sweatalert Js File
*/


// اساسی
document.getElementById("sa-basic").addEventListener("click", function() {
    Swal.fire(
        {
            title: 'هر کسی می‌تواند از یک رایانه استفاده کند',
            confirmButtonColor: '#5156be',
            confirmButtonText: "باشه"
        }
    )
});

// عنوان با متن زیر
document.getElementById("sa-title").addEventListener("click", function() {
    Swal.fire(
        {
            title: "اینترنت؟",
            text: 'آیا این چیز هنوز وجود دارد؟',
            icon: 'question',
            confirmButtonColor: '#5156be',
            confirmButtonText: "باشه"
        }
    )
});

// پیام موفقیت
document.getElementById("sa-success").addEventListener("click", function() {
    Swal.fire(
        {
            title: 'کار خوبی کردید!',
            text: 'شما روی دکمه کلیک کردید!',
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#5156be',
            cancelButtonColor: "#fd625e",
            confirmButtonText: "باشه",
            cancelButtonText: "لغو"
        }
    )
});

// پیام هشدار
document.getElementById("sa-warning").addEventListener("click", function() {
    Swal.fire({
        title: "آیا مطمئن هستید؟",
        text: "شما قادر به بازگشت این کار نخواهید بود!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#2ab57d",
        cancelButtonColor: "#fd625e",
        confirmButtonText: "بله، حذف کنید!",
        cancelButtonText: "لغو"
      }).then(function (result) {
        if (result.value) {
          Swal.fire({
            title: "حذف شد!",
            text: "پرونده شما حذف شده است.",
            icon: "success",
            cancelButtonText: "لغو",
            confirmButtonText: 'باشه',
          })
        }
    });
});

// پارامتر
document.getElementById("sa-params").addEventListener("click", function() {
    Swal.fire({
        title: 'آیا مطمئن هستید؟',
        text: "شما قادر به بازگشت این کار نخواهید بود!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'بله، حذف کنید!',
        cancelButtonText: 'نه، لغو کنید!',
        confirmButtonClass: 'btn bg-green-500 border-green-500 text-white mt-2',
        cancelButtonClass: 'btn bg-red-500 border-red-500 text-white ml-2 mt-2',
        buttonsStyling: false
    }).then(function (result) {
        if (result.value) {
            Swal.fire({
              title: 'حذف شد!',
              text: 'پرونده شما حذف شده است.',
              icon: 'success',
              confirmButtonColor: '#5156be',
              cancelButtonText: "لغو",
              confirmButtonText: 'باشه',
            })
          } else if (
            // بیشتر بخوانید در مورد ردیابی اخراجی
            result.dismiss === Swal.DismissReason.cancel
          ) {
            Swal.fire({
              title: 'لغو شد',
              text: 'پرونده تصوری شما امن است :)',
              icon: 'error',
              confirmButtonColor: '#5156be',
              cancelButtonText: "لغو",
              confirmButtonText: 'باشه',
            })
          }
    });
});


// تصویر سفارشی
document.getElementById("sa-image").addEventListener("click", function() {
    Swal.fire({
        title: 'خوب!',
        text: 'مدال با تصویر سفارشی.',
        imageUrl: 'assets/images/logo-sm.svg',
        imageHeight: 48,
        confirmButtonColor: "#5156be",
        animation: false,
        confirmButtonText: "باشه"
    })
});

// زمانبندی خودکار بسته شود
document.getElementById("sa-close").addEventListener("click", function() {
    var timerInterval;
    Swal.fire({
    title: 'هشدار بسته شود خودکار!',
    html: 'در <b></b> ثانیه بسته خواهم شد.',
    timer: 2000,
    timerProgressBar: true,
    didOpen:function () {
        Swal.showLoading()
        timerInterval = setInterval(function() {
        var content = Swal.getHtmlContainer()
        if (content) {
            var b = content.querySelector('b')
            if (b) {
            b.textContent = Swal.getTimerLeft()
            }
        }
        }, 100)
    },
    onClose: function () {
       

 clearInterval(timerInterval)
    }
    }).then(function (result) {
    /* بیشتر در مورد ردیابی ردیابی خوانید */
    if (result.dismiss === Swal.DismissReason.timer) {
        console.log('توسط تایمر بسته شدم')
    }
    })
});

// html سفارشی هشدار
document.getElementById("custom-html-alert").addEventListener("click", function() {
    Swal.fire({
        title: '<i>HTML</i> <u>نمونه</u>',
        icon: 'info',
        html: 'شما می توانید از <b>متن مشخص</b> استفاده کنید، ' +
        '<a href="//Pichforest.in/">پیوندها</a> ' +
        'و سایر برچسب های HTML',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger ms-1',
        confirmButtonColor: "#47bd9a",
        cancelButtonColor: "#fd625e",
        confirmButtonText: '<i class="fas fa-thumbs-up me-1"></i> عالی!',
        cancelButtonText: '<i class="fas fa-thumbs-down"></i>'
    })
});

// موقعیت
document.getElementById("sa-position").addEventListener("click", function() {
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'کار شما ذخیره شده است',
        showConfirmButton: false,
        timer: 1500,
        cancelButtonText: "لغو",
        confirmButtonText: 'باشه',
    })
});

// عرض سفارشی و پر کردن
document.getElementById("custom-padding-width-alert").addEventListener("click", function() {
    Swal.fire({
        title: 'عرض، پر کردن، پس زمینه سفارشی.',
        width: 600,
        padding: 100,
        confirmButtonColor: "#5156be",
        background: '#696ca1',
        cancelButtonText: "لغو",
        confirmButtonText: 'باشه',
    })
});

// اجرای ajax
document.getElementById("ajax-alert").addEventListener("click", function() {
    Swal.fire({
        title: 'ایمیل را برای اجرای درخواست ajax ارسال کنید',
        input: 'email',
        showCancelButton: true,
        confirmButtonText: 'ارسال',
        showLoaderOnConfirm: true,
        confirmButtonColor: "#5156be",
        cancelButtonColor: "#fd625e",
        cancelButtonText: "لغو",
        preConfirm: function (email) {
            return new Promise(function (resolve, reject) {
                setTimeout(function () {
                    if (email === 'taken@example.com') {
                        reject('این ایمیل قبلا گرفته شده است.')
                    } else {
                        resolve()
                    }
                }, 2000)
            })
        },
        allowOutsideClick: false
    }).then(function (email) {
        Swal.fire({
            icon: 'success',
            title: 'درخواست ajax انجام شد!',
            confirmButtonColor: "#5156be",
            html: 'ایمیل ارسال شده: ' + email.value,
            cancelButtonText: "لغو",
            confirmButtonText: 'باشه',
        })
    })
});
