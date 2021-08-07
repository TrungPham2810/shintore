$( document ).ready (function() {
    $('.checkbox_wrapper').click(function () {
        var checkedbox = $(this).is(":checked");
        $(this).parents('.card').find('.checkbox_child').prop('checked', $(this).is(":checked"));
    });

    $('.check_all').click(function () {
        $(this).parents().find('.checkbox_child').prop('checked', $(this).is(":checked"));
        $(this).parents().find('.checkbox_wrapper').prop('checked', $(this).is(":checked"));
    })

});