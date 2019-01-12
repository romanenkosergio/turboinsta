$(document).ready(function() {

    $('input,textarea').focus(function() {
        $(this).data('placeholder', $(this).attr('placeholder'))
        $(this).attr('placeholder', '');
    });

    $('a[href*="#"]')
        .not('[href="#"]')
        .not('[href="#0"]')
        .click(function(event) {
            if (
                location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
                location.hostname == this.hostname
            ) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000, function() {
                        var $target = $(target);
                        $target.focus();
                        if ($target.is(":focus")) {
                            return false;
                        } else {
                            $target.attr('tabindex', '-1');
                            $target.focus();
                        };
                    });
                }
            }
        });
    $('input,textarea').blur(function() {
        $(this).attr('placeholder', $(this).data('placeholder'));
    });
    $(".faq__card").click(function() {
        $(this).toggleClass("faq-hide")
        $(this).find(".faq-text").slideToggle(400)
        $(this).fadeIn(400, function() {
            $(this).find(".faq__question-text").toggleClass('faq__question-before');

        });
    })
    $(".our-blog__card_toggle").click(function() {
        $(this).find(".our-blog__content-text").toggleClass('our-blog__content-text_full')
        $(this).find(".our-blog__content-img").toggleClass('our-blog__content-img-reverse')


    });
    $(".our-blog__more").click(function() {
        $(this).toggleClass('our-blog__more-reverse', 4000);
        $(".our-blog__card-none").slideToggle("slow", function() {
            $(".our-blog__card-none").toggleClass('our-blog__card');
        })
    })
    $(".case__body").click(function() {
        $(this).find('.case__more').toggleClass('our-blog__more-reverse', 4000);
        $(this).find('.case__text_full').toggleClass('case__text_full-active');
        $(this).find('.case__more_text').toggleClass('case__more_text-dis');
    });

    $(".btn").click(function() {
        $(".textarea").css({ "display": "none" })
    });
    $(".our-team__card-btn").click(function() {
        $(".textarea").css({ "display": "block" })
    });
    $(".about-us-button-more").click(function() {
        $(this).hide();
        $(".about-us-review-hidden").removeClass("about-us-review-hidden")
    })
    $('input[type="tel"]').mask("+38 (999) 999-99-99")

    $("form").submit(function() {
        var text = $('#pop-callback h2').text();
        var theme = $(this).parent().find("input[name=theme]");
        theme.val(text);
    })
    $("body").on('click', "*[pop]", function() {
        $(".pop").removeClass("active")
        $("html").removeClass("off-scroll")
        $(".pop iframe").attr("src", "")
        var next_pop = $(this).attr("pop")
        if (next_pop && next_pop != "") {
            $(".pop" + next_pop).addClass("active")
            $("html").addClass("off-scroll")
            new_title = $(this).attr("pop-title")
            new_btn = $(this).attr("pop-btn")
            new_video = $(this).attr("pop-video")
            var new_attr = $(this).attr("link-ga")
            $(".pop" + next_pop + " button").attr('data-ga', new_attr)
            if (new_title && new_title != "") {
                $(".pop" + next_pop + " h2").text(new_title)
            }
            if (new_btn && new_btn != "") {
                $(".pop" + next_pop + " button").text(new_btn)
            }
            if (new_video && new_video != "") {
                $(".pop" + next_pop + " iframe")[0].src = (new_video + "?autoplay=1");
            }
        }
        return false
    })

    // $('.document-block').slick({
    //     dots: false,
    //     slidesToShow: 3,
    //     slidesToScroll: 3,
    //     infinite: true,
    //     speed: 300,
    //     prevArrow: $('.slick-prev'),
    //     nextArrow: $('.slick-next'),
    //     responsive: [{
    //             breakpoint: 1400,
    //             settings: {
    //                 slidesToShow: 3,
    //                 slidesToScroll: 3
    //             }
    //         },
    //         {
    //             breakpoint: 769,
    //             settings: {
    //                 slidesToShow: 1,
    //                 slidesToScroll: 1
    //             }
    //         }
    //     ]
    // });
    $('.review__blocks').slick({
        slidesToShow: 3,
        slidesToScroll: 3,
        // variableWidth: true,
        draggable: false
    });

    $('.slide-one').owlCarousel({
        loop: true,
        margin: 20,
        dots: true,
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            650: {
                items: 2
            },
            800: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });
    $('.slide-two').owlCarousel({
        loop: true,
        margin: 20,
        dots: true,
        nav: false,
        responsive: {
            0: {
                items: 2
            },
            800: {
                items: 3
            },
            1000: {
                items: 5
            },
            1500: {
                items: 6
            }
        }
    });
    $('.slide-three').owlCarousel({
        loop: true,
        margin: 20,
        dots: true,
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            800: {
                items: 3
            },
            1000: {
                items: 4
            },
            1500: {
                items: 4
            }
        }
    });
    $(document).snowfall({
        flakeCount: 200,
        image: "img/snow/2.png",
        minSize: 5,
        maxSize: 10,
        round: true,
        shadow: false,
    });
    new WOW().init();
});