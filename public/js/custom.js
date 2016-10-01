jQuery(document).ready(function($) {
    $('[data-toggle="tooltip"]').tooltip();
    $(document).on('mouseenter', '#wiki-page-options>li>a', function() {
        $(this).addClass('btn-default');
    });
    $(document).on('mouseleave', '#wiki-page-options>li>a', function() {
        $(this).removeClass('btn-default');
    });
});

$( document ).ready( function( ) {
    $('.tree li').each( function() {
        if($(this).children('ul').length > 0) {
            $(this).addClass('parent');
            $(this).find('ul').hide();
            $(this).find('ul').addClass('list-unstyled');
            $(this).find('ul').css('padding-left', 25);
        }
    });

    $('#tree-con .parent').find('a:first').each(function(index, el) {
        $(this).prepend('<i class="fa fa-angle-right"></i> ');
        $(this).first('a').css('margin-left', -14);
    });

    $( '.tree li.parent > a' ).click( function() {
        if($(this).closest('li').hasClass('active')) {
            $(this).closest('li').find('i:first').removeClass('fa-angle-down').addClass('fa-angle-right');
        }

        if (!$(this).closest('li').hasClass('active')) {
            $(this).closest('li').find('i:first').removeClass('fa-angle-right').addClass('fa-angle-down');
        };

        $(this).parent().toggleClass('active');
        $(this).parent().children('ul').slideToggle('fast');
    });
});