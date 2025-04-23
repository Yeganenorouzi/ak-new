/*
Template Name: Minia - Admin & Dashboard Template
Author: Themesbrand
Website: https://themesbrand.com/
Contact: themesbrand@gmail.com
File: Form elements Js File
*/


flatpickr('#example-date-input', {
    defaultDate: new Date(),
    locale: "fa",
});

flatpickr('#example-month-input', {
    dateFormat: "M",
    defaultDate: new Date(),
    locale: "fa",
});

flatpickr('#example-week-input', {
    dateFormat: "d M Y",
    locale: "fa",
    defaultDate: new Date(),
});

flatpickr('#example-time-input', {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true
});

flatpickr('#example-full-input', {
    locale: "fa",
    enableTime: true,
    dateFormat: "d M Y H:i",
    time_24hr: true,
    defaultDate: new Date(),
});

flatpickr('#example-full-2-input', {
    locale: "fa",
    enableTime: true,
    dateFormat: "d M Y H:i",
    time_24hr: true,
    defaultDate: new Date(),
});