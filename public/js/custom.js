/** * js file */
$(document).ready(function(){
    console.log("ready");
    $(document).on("click", ".header .toggle", function () {
        $(this).prev(".nav-box").slideToggle();
    });
    var winWidth = $(window).outerWidth();
    if (winWidth > 1199) {
        $(".header .navbar .navbar-nav .nav-item").hover(function () {
            $(this).find(".navbar-sub").fadeIn();
        }, function () {
            $(this).find(".navbar-sub").hide();
        });
    } else {
        $(".header").append('<div class="nav-box"></div>');
        $(".header").append('<div class="toggle"></div>');
        $(".header .navbar").each(function () {
            $(this).appendTo(".header .nav-box");
        });
        $(".header .navbar .navbar-nav>.nav-item>.nav-link").click(function() {
                if (!$(this).hasClass("open")) {
                    $(".header .navbar .navbar-nav>.nav-item>.nav-link").removeClass("open");
                    $(".navbar-sub").slideUp();
                    $(this).next(".navbar-sub").slideDown();
                    $(this).addClass("open");
                } else {
                    $(this).removeClass("open");
                    $(".navbar-sub").slideUp();
                }
        });
    }
    $(".investor-section .gird .item .card .collapse-info").click(function () {
        if ($(this).hasClass("open")) {
            $(this).removeClass("open");
            $(this).next(".info").css("height", "56px");
        } else {
            $(this).addClass("open");
            $(this).next(".info").css("height", "auto");
        }
    });
    $('.apply-form .file-select input[type=file]').change(function (e) {
        $(this).next().find(".filename").html(e.target.files[0].name).addClass("active");
        $(this).next().find(".clear").show();
    });
    $(".apply-form .file-select label span.clear").click(function (e) {
        e.preventDefault();
        $(this).prev(".filename").html("Liita portfolio / CV").removeClass("active");
        $(this).parents(".file-select").find("input[type=file]").val('');
        $(this).hide();
    });
    $('.details-form .file-select input[type=file]').change(function (e) {
        $(this).next().find(".filename").html(e.target.files[0].name).addClass("active");
        $(this).next().find(".clear").show();
    });
    $(".details-form .file-select label span.clear").click(function (e) {
        e.preventDefault();
        $(this).prev(".filename").html("No file chosen").removeClass("active");
        $(this).parents(".file-select").find("input[type=file]").val('');
        $(this).hide();
    });
    if ($('.owl-carousel.slider').length) {
        $('.owl-carousel.slider').owlCarousel({
            loop: true,
            nav: true,
            items: 1,
            dots: false
        });
    }

    function bannerHeight(){
        var hdHeight =  $(".header").outerHeight();
        var contentHeight = $(".banner .content").outerHeight();
        $(".banner").css({
           paddingTop: hdHeight,
           minHeight: contentHeight +hdHeight
        });
        $(".banner>img").css({
            minHeight: contentHeight
        });
    }
    if($(".banner").length){
        bannerHeight();
        $(window).on("resize",function(){
            bannerHeight();
        });
    }
});

function showToastNotification(nType, mesg) {
    var toastConfig = {
        closeButton: true,
        debug: false,
        newestOnTop: false,
        progressBar: true,
        positionClass: "toast-top-right",
        preventDuplicates: false,
        onclick: null,
    };

    if ('error' === nType) {
        toastr.error('', mesg, toastConfig);
    } else {
        toastr.success('', mesg, toastConfig);
    }
}