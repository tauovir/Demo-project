$(function() {
    //------------ search floating icon and label ---------- 
    $('.has-focus input').on('focus blur', function(e) {
        $(this).parents('.has-focus').toggleClass('focused', (e.type === 'focus' || this.value.length > 0));
    }).trigger('blur');

    //--------search add cross btn on key press --
    $('input.search').keyup(function() {
        if ($.trim($('.search').val()).length) {
            $(this).parents('.searchWrap').find('.clearSearch').addClass('show');
            console.log($(this).parents('.searchWrap').find('.clearSearch'));
        } else {
            $(this).parents('.searchWrap').find('.clearSearch').removeClass('show');
        }
    });
    $('.clearSearch').click(function() {
        $('input.search').val('');
        $(this).removeClass('show');
        $('.searchWrap').removeClass('focused');
    });

    //---------------- fixed header ---
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        if (scroll >= 10) {
            $('.headerWrapper').addClass('fixed');
        } else {
            $('.headerWrapper').removeClass('fixed');
        }
    });


});