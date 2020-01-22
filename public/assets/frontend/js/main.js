(function($){
    "user strict";

    $(document).ready(function(e) {
        background();
    });

    $(window).on("load", function() {
        //preloader
        $("#preloader").delay(300).animate({
            "opacity" : "0"
        }, 500, function() {
            $("#preloader").css("display","none");
        });

        // run test on initial page load
        checkSize();
        $(window).resize(checkSize);
    });

    //Function to the css rule
    function checkSize(){
        if (window.matchMedia('(max-width: 1199px)').matches) {
            // js code for responsive drop-down-menu-item with swing effect
            $(".navbar-collapse>ul>li>a, .navbar-collapse ul.sub-menu>li>a").on("click", function() {
                var element = $(this).parent("li");
                if (element.hasClass("open")) {
                    element.removeClass("open");
                    element.find("li").removeClass("open");
                    element.find("ul").slideUp(500,"linear");
                }
                else {
                    element.addClass("open");
                    element.children("ul").slideDown();
                    element.siblings("li").children("ul").slideUp();
                    element.siblings("li").removeClass("open");
                    element.siblings("li").find("li").removeClass("open");
                    element.siblings("li").find("ul").slideUp();
                }
            });
        }
    }


    $(".header-serch-btn").on('click', function(){
        //$(".header-top-search-area").toggleClass("open");
        if ($(this).hasClass('toggle-close')) {
            $(this).removeClass('toggle-close').addClass('toggle-open');
            $('.header-top-search-area').addClass('open');
        }
        else {
            $(this).removeClass('toggle-open').addClass('toggle-close');
            $('.header-top-search-area').removeClass('open');
        }
    });

    //close when click off of container
    $(document).on('click touchstart', function (e){
        if (!$(e.target).is('.header-serch-btn, .header-serch-btn *, .header-top-search-area, .header-top-search-area *')) {
            $('.header-top-search-area').removeClass('open');
            $('.header-serch-btn').addClass('toggle-close');
        }
    });

    //banner-slider
    $('.banner-slider').owlCarousel({
        autoplay: true,
        smartSpeed: 650,
        autoplayTimeout: 5000,
        loop:true,
        nav:false,
        dots: false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

    $('.categories-slider').owlCarousel({
        loop:true,
        margin: 0,
        nav:false,
        dots: false,
        autoplay: true,
        smartSpeed: 350,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:3,
            },
            1000:{
                items:4,
            }
        }
    });

    //banner-slider
    $('.testimonial-slider').owlCarousel({
        animateOut: 'fadeOutDown',
        margin:0,
        loop:true,
        nav: true,
        navText : ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
        dots: false,
        responsive:{
            0:{
                items:1,
                nav: false,
                dots:true
            },
            1000:{
                nav: true,
                dots:false,
                items:1
            }
        }
    });

    //banner-slider
    $('.testimonial-slider-two').owlCarousel({
        animateOut: 'fadeOut',
        animateIn: 'fadeInDown',
        margin:0,
        loop:false,
        nav: false,
        dotData: true,
        dotsData: true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

    // banner content animation
    $(".testimonial-slider").on("translate.owl.carousel", function() {
        $(".testimonial-slide .content p").removeClass("animated fadeInDown").css("opacity", "0"),
            $(".testimonial-slide .content .name").removeClass("animated fadeInUp").css("opacity", "0"),
            $(".testimonial-slide .content .designation").removeClass("animated fadeInUp").css("opacity", "0")
        $(".testimonial-slide .content .client-ratings").removeClass("animated fadeInUp").css("opacity", "0")
    }),
        $(".testimonial-slider").on("translated.owl.carousel", function() {
            $(".testimonial-slide .content p").addClass("animated fadeInDown").css("opacity", "1"),
                $(".testimonial-slide .content .name").addClass("animated fadeInUp").css("opacity", "1"),
                $(".testimonial-slide .content .designation").addClass("animated fadeInUp").css("opacity", "1")
            $(".testimonial-slide .content .client-ratings").addClass("animated fadeInUp").css("opacity", "1")
        });

    $('.brand-slider').owlCarousel({
        loop:true,
        margin: 30,
        nav:false,
        dots: false,
        autoplay: true,
        smartSpeed: 350,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:3,
            },
            1000:{
                items:3,
            }
        }
    });

    $('.thumb-slider').owlCarousel({
        loop:false,
        dots: false,
        autoplay: false,
        smartSpeed: 350,
        nav:true,
        navText : ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:1,
            },
            1000:{
                items:1,
            }
        }
    });

    function background() {
        var img=$('.has_bg_image');
        img.css('background-image', function () {
            var bg = ('url(' + $(this).data('background') + ')');
            return bg;
        });
    }

    new WOW().init();

    // counter
    $('.counter').countUp({
        'time': 1500,
        'delay': 10
    });

    // lightcase plugin init
    $('a[data-rel^=lightcase]').lightcase();

    // Show or hide the sticky footer button
    $(window).on("scroll", function() {
        if ($(this).scrollTop() > 200) {
            $(".scroll-to-top").fadeIn(200);
        } else {
            $(".scroll-to-top").fadeOut(200);
        }
    });

    //js code for mobile menu
    $(".menu-toggle").on("click", function() {
        $(this).toggleClass("is-active");
    });

    // Animate the scroll to top
    $(".scroll-to-top").on("click", function(event) {
        event.preventDefault();
        $("html, body").animate({scrollTop: 0}, 800);
    });

    $('.load-more').click(function(e){
        $(this).addClass('load-more--loading');
        setTimeout(function(e){
            $('.load-more--loading').removeClass('load-more--loading')
        }, 3000);
    })

})(jQuery);