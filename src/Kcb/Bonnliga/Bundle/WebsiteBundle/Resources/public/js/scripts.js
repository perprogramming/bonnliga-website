$(document).ready(function() {
    $('table').fixedtableheader();

    $('div.pott').on('mouseenter', function() {
        $(this).find('div').slideDown();
    }).on('mouseleave', function() {
        $(this).find('div').slideUp();
    });

    $('.dropdown-toggle').dropdown();

    $('.info').popover();
});