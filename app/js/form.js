$(document).ready(function() {
    /********** * mask * **********/
    $('input[type="tel"]').mask("+38 (999) 999-99-99");
    /********** * mask end* **********/
    $("form").attr("action", "sendForm.php");
    /************** * Lazy load * **************/
    [].forEach.call(document.querySelectorAll('img[data-src]'), function(img) {
        img.setAttribute('src', img.getAttribute('data-src'));
        img.onload = function() {
            img.removeAttribute('data-src');
        };
    });
    /************** * Lazy load End* **************/
});