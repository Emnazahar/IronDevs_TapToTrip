$(function() {
    $('a.scroll').on('click',function ( event ) {
        event.preventDefault();

        var $anchor  = $(this),
            $section = $anchor.attr('data-section');

        if ( $section === '2' || $section === '3' ) {
            $('#wrap .wrap-inner').addClass('goto-' + $section);
        } else {
            $('#wrap .wrap-inner').removeClass('goto-2 goto-3');
        }
    });
});