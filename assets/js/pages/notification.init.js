

/*
Template Name: Minia - Admin & Dashboard Template
Author: Themesbrand
Website: https://themesbrand.com/
Contact: themesbrand@gmail.com
File: Toastr init js
*/

// alert
document.getElementById("alert").addEventListener("click", function() {
    alertify.confirm('عنوان هشدار', 'پیام هشدار!', function(){ alertify.success('باشه'); }).set('labels', {ok:'باشه', cancel:'لغو'});
});

// هشدار تایید
document.getElementById("alert-confirm").addEventListener("click", function() {
    alertify.confirm("این یک دیالوگ تایید است.",
    function(){
        alertify.success('باشه');
    },
    function(){
        alertify.error('لغو');
    }).set('labels', {ok:'باشه', cancel:'لغو'});
});

// هشدار پرسش
document.getElementById("alert-prompt").addEventListener("click", function() {
    alertify.prompt("این یک دیالوگ پرسش است.", "مقدار پیشفرض",
    function(evt, value ){
        alertify.success('باشه: ' + value);
    },
    function(){
        alertify.error('لغو');
    }).set('labels', {ok:'باشه', cancel:'لغو'});
});

// هشدار موفقیت
document.getElementById("alert-success").addEventListener("click", function() {
    alertify.success('پیام موفقیت').set('labels', {ok:'باشه', cancel:'لغو'});
});

// هشدار خطا
document.getElementById("alert-error").addEventListener("click", function() {
    alertify.error('پیام خطا').set('labels', {ok:'باشه', cancel:'لغو'});
});

// هشدار هشدار
document.getElementById("alert-warning").addEventListener("click", function() {
    alertify.warning('پیام هشدار').set('labels', {ok:'باشه', cancel:'لغو'});
});

// هشدار عادی
document.getElementById("alert-message").addEventListener("click", function() {
    alertify.message('پیام عادی').set('labels', {ok:'باشه', cancel:'لغو'});
});