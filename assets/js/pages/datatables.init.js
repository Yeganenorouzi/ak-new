/*
Template Name: Minia - Admin & Dashboard Template
Author: Themesbrand
Website: https://themesbrand.com/
Contact: themesbrand@gmail.com
File: Datatables Js File
*/

$(document).ready(function() {
    $('#datatable').DataTable({
        language: {
            // farsi
            "search": "جستجو:",
            "lengthMenu": "نمایش _MENU_ رکورد",
            emptyTable: "هیچ داده ای در جدول وجود ندارد",
            info: "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
            infoEmpty: "نمایش 0 تا 0 از 0 رکورد",
            infoFiltered: "(فیلتر شده از _MAX_ رکورد)",
            infoPostFix: "",
            buttons: {
                copy: "کپی",
                excel: "اکسل",
                pdf: "پی دی اف",
                colvis: "نمایش ستون ها"
            },
            paginate: {
                first: "ابتدا",
                previous: "قبلی",
                next: "بعدی",
                last: "انتها"
            }
        }
    });

    //Buttons examples
    var table = $('#datatable-buttons').DataTable({
        lengthChange: false,
        buttons: ['copy', 'excel', 'pdf', 'colvis'],
        language: {
            // farsi
            "search": "جستجو:",
            "lengthMenu": "نمایش _MENU_ رکورد",
            emptyTable: "هیچ داده ای در جدول وجود ندارد",
            info: "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
            infoEmpty: "نمایش 0 تا 0 از 0 رکورد",
            infoFiltered: "(فیلتر شده از _MAX_ رکورد)",
            infoPostFix: "",
            buttons: {
                copy: "کپی",
                excel: "اکسل",
                pdf: "پی دی اف",
                colvis: "نمایش ستون ها"
            },
            paginate: {
                first: "ابتدا",
                previous: "قبلی",
                next: "بعدی",
                last: "انتها"
            }
        }
    });

    table.buttons().container()
        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

    $(".dataTables_length select").addClass('form-select form-select-sm');
});