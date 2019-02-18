$(document).ready(function() {
    /************** * Particle * **************/
    particlesJS.load('step-one', '/js/config.json', function() {});
    /************** * Particle End* **************/

    /************** * Lazy load * **************/
    [].forEach.call(document.querySelectorAll('img[data-src]'), function(img) {
        img.setAttribute('src', img.getAttribute('data-src'));
        img.onload = function() {
            img.removeAttribute('data-src');
        };
    });
    /************** * Lazy load End* **************/

    /************** * Navigation link* **************/
    $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function(event) {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ?
                target :
                $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                event.preventDefault();
                $('html, body').animate({
                    scrollTop: target
                        .offset()
                        .top
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
    /************** * Navigation link End* **************/

    /************** * Other Functions Blocks * **************/
    /********** * Promo Down Button * **********/
    $(".promo__advantages_down").click(function() {
        $(this)
            .parent(".promo__advantages")
            .find(".promo__advantages-list_active")
            .toggleClass('promo__advantages-list_hidden');
        $(this).toggleClass('promo__advantages_down-reverse');
    });
    /********** * Promo Down Button End * **********/

    /********** * Our-Team Down Button  * **********/
    $(".our-team__card_down").click(function(e) {
            e.stopImmediatePropagation();
            $(this)
                .parent(".our-team__card")
                .find(".our-team__card-text span")
                .toggleClass('our-team__card-text_hidden');
            $(this).toggleClass('our-team__card_down-reverse');
        })
        /********** * Our-Team Down Button End * **********/

    /********** * Faq Down Button End * **********/
    $(".faq__card").click(function() {
            $(this).toggleClass("faq-hide")
            $(this).find(".faq-text").slideToggle(400)
            $(this).fadeIn(400, function() {
                $(this).find(".faq__question_img").toggleClass('faq__question_img-reverse');
            });
        })
        /********** * Faq Down Button End * **********/

    /********** * Our-Blog Down Button End * **********/
    $(".our-blog__card_toggle").click(function() {
        $(this)
            .find(".our-blog__content-text")
            .toggleClass('our-blog__content-text_full');
        $(this)
            .find(".our-blog__content-img")
            .toggleClass('our-blog__content-img-reverse');
    });
    $(".our-blog__card-none").hide();
    $(".our-blog__more").on('click', (e) => {
        e.preventDefault();
        $(".our-blog__more").text() == 'Смотреть еще' ? $(".our-blog__more").text("Скрыть") :
            $(".our-blog__more").text("Смотреть еще");
        //  if($(this).text())
        $(".our-blog__card-none").slideToggle(300, (e) => {
            $(".our-blog__card-none").toggleClass("our-blog__card-hidden");
            if ($(this).is(':visible')) {
                $(this).css('display', 'flex');
            }
        });

    });
    // $(".our-blog__more").click(function() {
    //     $(".our-blog__card-none").slideToggle("slow", function() {
    //         $(".our-blog__card-none").toggleClass('our-blog__card-hidden');
    //     });
    //
    /********** * Our-Blog Down Button End * **********/
    /************** * Other Functions Blocks End * **************/

    /************** * Sliders Block * **************/
    /********** * document-block * **********/
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
                    // stagePadding: 5 center: true,
            },
            // 768: {     items: 1,     nav: true,     autoWidth: true,     margin: 0 },
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
    /********** * document-block end* **********/

    /********** * review__blocks * **********/
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
    /********** * review__blocks end * **********/

    /********** * our-case * **********/
    $('.our-case__slider').owlCarousel({
        dots: false,
        nav: true,
        loop: false,
        navText: false,
        items: 1,
        mouseDrag: false
    });
    /********** * our-case end * **********/

    /********** * our-workr * **********/
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
    /********** * our-workr end * **********/
    /************** * Sliders Block End* **************/


    /************** * Modal Block * **************/
    let new_price;
    $("body").on('click', "*[pop]", function() {
            $(".pop").removeClass("active");
            $("html").removeClass("off-scroll");
            $(".pop iframe").attr("src", "");
            var next_pop = $(this).attr("pop");
            if (next_pop && next_pop != "") {
                $(".pop" + next_pop).addClass("active");
                $("html").addClass("off-scroll");
                new_title = $(this).attr("pop-title");
                new_btn = $(this).attr("pop-btn");
                new_price = $(this).attr("pop-price");
                new_video = $(this).attr("pop-video");
                var new_attr = $(this).attr("link-ga");
                $(".pop" + next_pop + " button").attr('data-ga', new_attr)
                if (new_title && new_title != "") {
                    $(".pop" + next_pop + " h2").text(new_title);
                }
                if (new_btn && new_btn != "") {
                    $(".pop" + next_pop + " button").text(new_btn);
                }
                if (new_price && new_price != "") {
                    $(".pop" + new_price + "input[name=price]").val(new_price);
                    // return this
                }

                if (new_video && new_video != "") {
                    $(".pop" + next_pop + " iframe")[0].src = (new_video + "?autoplay=1");
                }
            }
            return false
        })
        /************** * Modal Block  End* **************/

    /************** * Form Block * **************/
    /********** * our-team block * **********/
    $(".btn").click(function() {
        $(".textarea").css({
            "display": "none"
        })
    });
    $(".our-team__card-btn").click(function() {
        $(".textarea").css({
            "display": "block"
        })
    });
    /********** * our-team block end * **********/

    /********** * mask * **********/
    $('input[type="tel"]').mask("+38 (999) 999-99-99");
    /********** * mask end* **********/

    /********** * placeholder blur * **********/
    $('input,textarea').focus(function() {
        $(this).data('placeholder', $(this).attr('placeholder'));
        $(this).attr('placeholder', '');
    });
    $('input,textarea').blur(function() {
        $(this).attr('placeholder', $(this).data('placeholder'));
    });
    /********** * placeholder blur end * **********/
    /********** * range * **********/

    var pipsSlider = document.getElementById('range');
    noUiSlider.create(pipsSlider, {
        start: 2,
        range: {
            'min': 2,
            'max': 6
        },
        connect: [true, false],
        step: 1,
        pips: {
            mode: 'steps',
            stepped: true
        }

    });
    var pips = pipsSlider.querySelectorAll('.noUi-value');

    function clickOnPip() {
        var value = Number(this.getAttribute('data-value'));
        let Value = pipsSlider.noUiSlider.set(value);
    }

    for (var i = 0; i < pips.length; i++) {

        // For this example. Do this in CSS!
        pips[i].style.cursor = 'pointer';
        pips[i].addEventListener('click', clickOnPip);
    }

    /********** * range end * **********/

    /********** * calculator  * **********/

    let partsPrice = 5990;
    let totalSumBody = $('#totalSum');
    let rangeValue = parseInt(pipsSlider.noUiSlider.get());

    function calcSum() {
        pipsSlider.noUiSlider.on('update', (values) => {
            let rangeValue = parseInt(values.join(''));
            let sumForMonth = (partsPrice / rangeValue);
            let commision = (partsPrice * 2.9 / 100);
            let totalSum = Math.round(commision + sumForMonth);
            totalSumBody.text(totalSum + "");
        });
    }

    function getPrice(e) {
        e.preventDefault();
        $('.pay-parts__promo-block').removeClass('pay-parts__promo-block_active');
        $(this).addClass('pay-parts__promo-block_active');
        let partsPrice = parseInt($(this).attr('data-sum'));
        pipsSlider.noUiSlider.on('update', (values) => {
            let rangeValue = parseInt(values.join(''));
            let sumForMonth = (partsPrice / rangeValue);
            let commision = (partsPrice * 2.9 / 100);
            let totalSum = Math.round(commision + sumForMonth);
            // console.log(totalSum);
            totalSumBody.text(totalSum + "");
        });

    }
    $(".pay-parts__promo-block").on('click', getPrice);

    calcSum();

    /********** * calculator end * **********/

    /********** * send pay-parts * **********/
    $('#pay-parts__btn').on('click', (e) => {
        e.preventDefault();
        let totaPrice = parseInt($(".pay-parts__promo-block_active").attr("data-sum"));
        let totaTitle = $(".pay-parts__promo-block_active").attr("data-title");
        let totaPart = parseInt(pipsSlider.noUiSlider.get());


        // console.log(totaPrice);
        // console.log(totaTitle);
        // console.log(totaPart);
        let query = {
            name: totaTitle,
            price: totaPrice,
            part: totaPart,
        }

        $.post("payParts.php", { query: query }, function(data) {
            let url = $.cookie('url');
            // console.log(url);
            // window.location.href = url;
            window.open(url, '_blank');
        });
    });
    /********** * send pay-parts end * **********/

    /********** * send form * **********/
    let price = $("input[name=price]");

    $("form").submit(function() {
        $(this).attr("action", "send-contact.php");
        price.val(new_price);
        var text = $('#pop-callback h2').text();
        var theme = $(this).parent().find("input[name=theme]");
        theme.val(text);
        var google_target = $(this).find("[type='submit']").attr('data-ga');
        eval(google_target);
        // setTimeout(() => {
        //     $("form").trigger("reset");
        // }, 2000);
    });
    /********** * send form end* **********/
    /********** * pay form * **********/
    $('form#form-pay').submit(function(e) {
        e.preventDefault();
        res = true;
        var google_target = $(this).find("[type='submit']").attr('data-ga')
        var theme = $(this).parent().find("#promo");
        var name = $(this).parent().find("input[name=name]");
        var phone = $(this).parent().find("input[name=phone]");
        var price = $(this).parent().find("#promo option:selected");
        price = price.attr('data-price');
        theme = theme.val();
        console.log(theme);
        console.log(price);


        if (res) {
            var query = {
                name: $(this).parent().find("input[name=name]").val(),
                phone: $(this).parent().find("input[name=phone]").val(),
                theme: $(this).parent().find("select[name=promo]").val(),
                price: $(this).parent().find("#promo option:selected").attr('data-price'),
            }
            $(this).parent().find("input[name=name]").val('')
            $(this).parent().find("input[name=phone]").val('')
            $(this).parent().find("#promo")
            $(this).parent().find("#promo option:selected").attr('data-price')
            $.post("pay/liqpay/order.php", { query: query }, function(data) {

                // console.log(data);
                $('#form_responce').html(data); //И передаем эту форму в невидимое поле form_responce
                $('#form_responce form').submit() //Сразу же автоматически сабмитим эту форму, так как всеравно клиент её не видит

                $(".pop").removeClass("active")
                $(".pop#pop-thanks").addClass("active")
                $("html").addClass("off-scroll")
                ga('send', 'event', 'call_me', 'Click')
                eval(google_target)

            });
        }

    });

    /********** * pay form end* **********/


});