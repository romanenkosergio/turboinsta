$(document).ready(function() {
    setTimeout(function() { $(".black-friday").css({ display: "none" }) }, 15e3), $(".black-friday").find(".modal__close").click(function() { $(".black-friday").css({ display: "none" }) }), $("input,textarea").focus(function() { $(this).data("placeholder", $(this).attr("placeholder")), $(this).attr("placeholder", "") }), $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').click(function(t) {
        if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") && location.hostname == this.hostname) {
            var e = $(this.hash);
            (e = e.length ? e : $("[name=" + this.hash.slice(1) + "]")).length && (t.preventDefault(), $("html, body").animate({ scrollTop: e.offset().top }, 1e3, function() {
                var t = $(e);
                if (t.focus(), t.is(":focus")) return !1;
                t.attr("tabindex", "-1"), t.focus()
            }))
        }
    }), $("input,textarea").blur(function() { $(this).attr("placeholder", $(this).data("placeholder")) }), $(".faq__card").click(function() { $(this).toggleClass("faq-hide"), $(this).find(".faq-text").slideToggle(400), $(this).fadeIn(400, function() { $(this).find(".faq__question-text").toggleClass("faq__question-before") }) }), $(".our-blog__card_toggle").click(function() { $(this).find(".our-blog__content-text").toggleClass("our-blog__content-text_full"), $(this).find(".our-blog__content-img").toggleClass("our-blog__content-img-reverse") }), $(".our-blog__more").click(function() { $(this).toggleClass("our-blog__more-reverse", 4e3), $(".our-blog__card-none").slideToggle("slow", function() { $(".our-blog__card-none").toggleClass("our-blog__card") }) }), $(".case__body").click(function() { $(this).find(".case__more").toggleClass("our-blog__more-reverse", 4e3), $(this).find(".case__text_full").toggleClass("case__text_full-active"), $(this).find(".case__more_text").toggleClass("case__more_text-dis") }), $(".btn").click(function() { $(".textarea").css({ display: "none" }) }), $(".our-team__card-btn").click(function() { $(".textarea").css({ display: "block" }) }), $(".about-us-button-more").click(function() { $(this).hide(), $(".about-us-review-hidden").removeClass("about-us-review-hidden") }), $('input[type="tel"]').mask("+38 (999) 999-99-99"), $("form").submit(function() {
        var t = $("#pop-callback h2").text();
        $(this).parent().find("input[name=theme]").val(t)
    }), $("body").on("click", "*[pop]", function() {
        $(".pop").removeClass("active"), $("html").removeClass("off-scroll"), $(".pop iframe").attr("src", "");
        var t = $(this).attr("pop");
        if (t && "" != t) {
            $(".pop" + t).addClass("active"), $("html").addClass("off-scroll"), new_title = $(this).attr("pop-title"), new_btn = $(this).attr("pop-btn"), new_video = $(this).attr("pop-video");
            var e = $(this).attr("link-ga");
            $(".pop" + t + " button").attr("data-ga", e), new_title && "" != new_title && $(".pop" + t + " h2").text(new_title), new_btn && "" != new_btn && $(".pop" + t + " button").text(new_btn), new_video && "" != new_video && ($(".pop" + t + " iframe")[0].src = new_video + "?autoplay=1")
        }
        return !1
    }), $(".slide-one").owlCarousel({ loop: !0, margin: 20, dots: !0, nav: !1, responsive: { 0: { items: 1 }, 650: { items: 2 }, 800: { items: 2 }, 1e3: { items: 3 } } }), $(".slide-two").owlCarousel({ loop: !0, margin: 20, dots: !0, nav: !1, responsive: { 0: { items: 2 }, 800: { items: 3 }, 1e3: { items: 5 }, 1500: { items: 6 } } }), $(".slide-three").owlCarousel({ loop: !0, margin: 20, dots: !0, nav: !1, responsive: { 0: { items: 1 }, 800: { items: 3 }, 1e3: { items: 4 }, 1500: { items: 4 } } }), $(function() { $.cookie("hideModal") || setTimeout(function() { $("#newyear_overlay").css({ display: "block" }) }, 1e3), $.cookie("hideModal", !0, { expires: 1, path: "/" }) }), $(".youtube").each(function() {
        $(this).css("background-image", "url(//i.ytimg.com/vi/" + this.id + "/sddefault.jpg)"), $(this).append($("<div/>", { class: "play" })), $(document).delegate("#" + this.id, "click", function() {
            var t = "https://www.youtube.com/embed/" + this.id + "?autoplay=1&autohide=1";
            $(this).data("params") && (t += "&" + $(this).data("params"));
            var e = $("<iframe/>", { frameborder: "0", src: t, width: $(this).width(), height: $(this).height() });
            $(this).replaceWith(e)
        })
    })
});