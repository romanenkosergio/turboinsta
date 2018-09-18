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
                        if ($target.is(":focus")) { // Checking if the target was focused
                            return false;
                        } else {
                            $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                            $target.focus(); // Set focus again
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

    });
    $(".our-blog__more").click(function() {
        $(this).toggleClass('our-blog__more-reverse', 4000);
        $(".our-blog__card-none").slideToggle("slow", function() {
            $(".our-blog__card-none").toggleClass('our-blog__card');
        })
    })


    $(".about-us-button-more").click(function() {
        $(this).hide();
        $(".about-us-review-hidden").removeClass("about-us-review-hidden")
    })
    $(".btn").on("click", function(event) {
        event.preventDefault();
        $(".pop-content .textarea").css({ "display": "none" })
    });
    $(".our-team__card-btn").on("click", function(event) {
        event.preventDefault();
        $(".pop-content .textarea").css({ "display": "block" })
    });
    $('input[type="tel"]').mask("+38 (999) 999-99-99")
    $("form").submit(function(event) {
        event.preventDefault();
        res = true;
        $(this).find(".not-valid").remove()
        var google_target = $(this).find("[type='submit']").attr('data-ga')
        $(this).find("input").each(function() {
            if ($(this).val() == "") {
                $(this).before("<p class='not-valid'>Заполните поле</p>")
                res = false
            }
        })

        if (res) {

            var query = {
                name: $(this).parent().find("input[name=name]").val(),
                phone: $(this).parent().find("input[name=phone]").val(),
                msg: $(this).parent().find("textarea[name=msg]").val(),
                theme: $("#pop-callback h2").text()
            }
            console.log(query);
            $(this).parent().find("input[name=name]").val('')
            $(this).parent().find("input[name=phone]").val('')
            $(this).parent().find("textarea[name=msg]").val('')
            $.post("send.php", { query: query }, function(data) {
                console.log(data);


                $(".pop").removeClass("active")
                $(".pop#pop-thanks").addClass("active")
                $("html").addClass("off-scroll")
                    // ga('send', 'event', 'call_me', 'Click')
                eval(google_target)

            });
        }
    });
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
                $(".pop" + next_pop + " iframe")[0].src = new_video + "?autoplay=1";
            }
        }
        return false
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
    })

    $(function() {

        if (!$.cookie('hideModal')) {

            setTimeout(function() {
                $('#newyear_overlay').css({ 'display': 'block' });
            }, 1000);

            /*setTimeout(function () {
                $('#newyear_overlay').css({'display': 'none'});
            }, 7000);*/

        }
        $.cookie('hideModal', true, {
            // Время хранения cookie в днях
            expires: 1,
            path: '/'
        });
    });

})