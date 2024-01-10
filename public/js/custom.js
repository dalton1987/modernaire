$(document).ready(function(){ // <-- use correct syntax
      $('#theme-color').change(function(){ // <-- use change event
             $('body').css('--theme-color', $(this).val());
       }); 
       $('#primary-text-color').change(function(){ // <-- use change event
             $('body').css('--primary-text-color', $(this).val());
       }); 
       $('#secondary-text-color').change(function(){ // <-- use change event
             $('body').css('--secondary-text-color', $(this).val());
       }); 
});


// hamburger js


$(window).scroll(function() {
    if ($(window).scrollTop() >= 100) {
        $('#header').addClass('fixed-header');
        $('#header').addClass('visible-title');
    } else {
        $('#header').removeClass('fixed-header');
        $('#header').removeClass('visible-title');
    }
});





$(document).ready(function() {
    $('.menu-toggle').on('click', function(e) {
        e.preventDefault();
        $('body').removeClass('open');
    });
    $('.ham-icn').on('click', function(e) {
        e.preventDefault();
        $('body').toggleClass('open');
    });





    $('.testi-txt ul li:first-child a').click(function(e) {
        e.preventDefault();
        $('.testi-sl-mn .slick-prev ').trigger('click');
    })
    $('.testi-txt ul li:last-child a').click(function(e) {
        e.preventDefault();
        $('.testi-sl-mn .slick-next ').trigger('click');

    })
})

$('.productdetailfor').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.productdetailnav'
});
$('.productdetailnav').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    asNavFor: '.productdetailfor',
    dots: false,
    centerMode: true,
    focusOnSelect: true,
    arrows: false

});
// product slider jas end



// aftre banner slider start
$('.after-b-vdo-slider').slick({
    dots: false,
    arrows: false,
    infinite: true,
    autoplay: true,
    speed: 300,
    slidesToShow: 1,
    slidesToScroll: 1,
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});

// aftre banner slider end



// blogslider start
$('.testi-sl-mn').slick({
    dots: false,
    arrows: true,
    infinite: true,
    speed: 300,
    slidesToShow: 1,
    slidesToScroll: 1,
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});

// blogslider end

// product slider jas start

$('.slider-for').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '.slider-for',
    dots: true,
    centerMode: true,
    focusOnSelect: true
});
// product slider jas end

// simple slick slider start
$(".regular").slick({
    dots: true,
    infinite: true,
    speed: 300,
    autoplay: true,
    slidesToShow: 3,
    slidesToScroll: 3
});

// simple slick slider end

// wow animation js 

$(function() {
    new WOW().init();
});


// responsive menu js 

$(function() {
    $('#menu').slicknav();
});


// home bullet dynamic 

$(document).ready(function() {
    setInterval(function() {
        let a = $('.main_slider  .carousel-indicators .active').attr('data-bs-slide-to');
        let b = parseInt(a)
        $('.sl-bullet h5 span em').text(b + 1);
    }, 100);
});



// search button js

(function($) {

    $.fn.searchBox = function(ev) {

        var $searchEl = $('.search-elem');
        var $placeHolder = $('.placeholder');
        var $sField = $('#search-field');

        if (ev === "open") {
            $searchEl.addClass('search-open')
        };

        if (ev === 'close') {
            $searchEl.removeClass('search-open'),
                $placeHolder.removeClass('move-up'),
                $sField.val('');
        };

        var moveText = function() {
            $placeHolder.addClass('move-up');
        }

        $sField.focus(moveText);
        $placeHolder.on('click', moveText);

        $('.submit').prop('disabled', true);
        $('#search-field').keyup(function() {
            if ($(this).val() != '') {
                $('.submit').prop('disabled', false);
            }
        });
    }

}(jQuery));

$('.search-btn').on('click', function(e) {
    $(this).searchBox('open');
    e.preventDefault();
});

$('.close').on('click', function() {
    $(this).searchBox('close');
});



// gallery js

$('[fancybox]').click(function(e) {
    e.preventDefault();
    let url = $(this).attr('fancybox');
    $('.gallery-wrap img').attr('src', url);
    $('.gallery-wrap').addClass('image');
    $('.gallery-wrap').click(function() {
        $(this).removeClass('image');
    });
});


/////////////////// product +/-
$(document).ready(function() {
    $('.num-in span').click(function() {
        var $input = $(this).parents('.num-block').find('input.in-num');
        if ($(this).hasClass('minus')) {
            var count = parseFloat($input.val()) - 1;
            count = count < 1 ? 1 : count;
            if (count < 2) {
                $(this).addClass('dis');
            } else {
                $(this).removeClass('dis');
            }
            $input.val(count);
        } else {
            var count = parseFloat($input.val()) + 1
            $input.val(count);
            if (count > 1) {
                $(this).parents('.num-block').find(('.minus')).removeClass('dis');
            }
        }

        $input.change();
        return false;
    });

});
// product +/-





// PARTNER SLIDER
$('.partnerSlider').slick({
    dots: false,
    arrows: false,
    infinite: true,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 1,
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});