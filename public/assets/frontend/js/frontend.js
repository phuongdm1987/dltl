$('.carousel').carousel();
$('.dropdown-toggle').dropdown();
$('.datepicker').datepicker({
    format: "dd-mm-yyyy",
    weekStart: 1,
    todayBtn: "linked",
    clearBtn: true,
    language: "vi",
    autoclose: true,
    todayHighlight: true
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})