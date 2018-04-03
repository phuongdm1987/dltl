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
$('.btn-search').click(function() {
   $('.btn-search').removeClass('active');
   $(this).addClass('active');
   $(this).parents('#box-search').find('#tour_type').val($(this).data('value'));
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})