$(document).ready(function() {
    particlesJS.load('particles-js', '/js/config.json', function() {
        console.log('particles.js loaded - callback');
    });
    $('input,textarea').focus(function() {
        $(this).data('placeholder', $(this).attr('placeholder'))
        $(this).attr('placeholder', '');
    });
    console.log(2);
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
    $(".services__down").click(function() {
        $(this).parent(".services__block").find(".services__list-item").toggleClass('services__list-hidden');
        $(this).toggleClass('services__down-reverse');
    });
    $(".promo__advantages_down").click(function() {
        $(this).parent(".promo__advantages").find(".promo__advantages-list_active").toggleClass('promo__advantages-list_hidden');
        $(this).toggleClass('promo__advantages_down-reverse');
    });
    $('input,textarea').blur(function() {
        $(this).attr('placeholder', $(this).data('placeholder'));
    });
    $(".faq__card").click(function() {
        $(this).toggleClass("faq-hide")
        $(this).find(".faq-text").slideToggle(400)
        $(this).fadeIn(400, function() {
            $(this).find(".faq__question_img").toggleClass('faq__question_img-reverse');

        });

    })
    $(".our-blog__card_toggle").click(function() {
        $(this).find(".our-blog__content-text").toggleClass('our-blog__content-text_full');
        $(this).find(".our-blog__content-img").toggleClass('our-blog__content-img-reverse');
    });
    $(".our-blog__more").click(function() {
        this.textContent = this.textContent === 'Скрыть' ? 'Смотреть еще' : 'Скрыть';
        $(".our-blog__card-none").slideToggle("slow", function() {
            $(".our-blog__card-none").toggleClass('our-blog__card');
        })

    })
    $(".btn").click(function() {
        $(".textarea").css({ "display": "none" })
    });
    $(".our-team__card-btn").click(function() {
        $(".textarea").css({ "display": "block" })
    });
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

    $('.document-block').owlCarousel({
        dots: false,
        nav: true,
        loop: false,
        navText: false,
        slideBy: 1,
        margin: 55,
        mouseDrag: false,
        responsive: {
            0: {
                items: 1,
                nav: true,
                // autoWidth: true,
                center: true,
                margin: 25
                    // stagePadding: 5
                    // center: true,
            },
            // 768: {
            //     items: 1,
            //     nav: true,
            //     autoWidth: true,
            //     margin: 0
            // },
            960: {
                items: 3,
                nav: false,
                autoWidth: true,
                margin: 20
            },
            1024: {
                items: 3,
                nav: false,
                margin: 58,
                center: false
            }
        }
    });
    $('.review__blocks').owlCarousel({
        dots: false,
        nav: true,
        loop: false,
        navText: false,
        slideBy: 3,
        margin: 60,
        mouseDrag: false,
        responsive: {
            0: {
                items: 1,
                margin: 0,
                autoWidth: true
            },
            800: {
                items: 2,
                autoWidth: false
                    // margin: 20
            },
            1000: {
                items: 3,
                margin: 0,
                autoWidth: false
            },
            1200: {
                items: 3,
                margin: 60,
                autoWidth: false
            }
        }
    });

    $('.our-case__slider').owlCarousel({
        dots: false,
        nav: true,
        loop: false,
        navText: false,
        items: 1,
        mouseDrag: false
    });
    $('.our-work__slider').owlCarousel({
        dots: false,
        nav: true,
        loop: false,
        navText: false,
        items: 5,
        slideBy: 5,
        mouseDrag: false,
        responsive: {
            0: {
                items: 1,
                slideBy: 1
            },
            800: {
                items: 3,
                slideBy: 3
            },
            1300: {
                items: 4,
                slideBy: 4
            },
            1600: {
                items: 5,
                slideBy: 5
            }
        }
    });
});