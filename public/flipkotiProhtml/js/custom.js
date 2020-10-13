/**
 * js file
 */

$(document).ready(function(){

    if($('#client-resposibilities').length){
        $('#client-resposibilities').multiSelect();
    }
    if($('#contractor-resposibilities').length){
        $('#contractor-resposibilities').multiSelect();
    }
    if($('#legal-agreement').length){
        $('#legal-agreement').multiSelect();
    }


    var winWidth = $(window).outerWidth();

    var content = $(".main-content");
    if(content.length){
        var offsettop =  Math.floor(content.offset().top);
        var contentOffset = "calc(100vh - "+offsettop+"px)";
        content.css("height",contentOffset);
    }

    $(".sidebar-toggle").click(function(){
        $(".main-content").toggleClass("show-sidebar");
    });
    $(".main-content").click(function(event){
        var target = $( event.target );
        if (target.is( ".main-content")){
            $(this).removeClass("show-sidebar");
        }
    });

    $(".sidebar .nav .nav-item .nav-link").click(function(){
        if(!$(this).parent().hasClass("open")){
            $(".sidebar .nav .nav-item").removeClass("open");
            $(this).parent().addClass("open");
            $(".sidebar .nav .nav-item .sub-nav").slideUp();
            $(this).next().slideDown(".sub-nav");
            return;
        }
        else{
            $(".sidebar .nav .nav-item").removeClass("open");
            $(this).next().slideUp(".sub-nav");
        }

    });

    if($('.owl-carousel.slider').length){
        $('.owl-carousel.slider').owlCarousel({
            loop:true,
            nav:true,
            items:1,
            dots:false
        });
    }

    function customScroll(){
        var $scrollable = $(".sidebar .nav"),
            $scrollbar = $(".sidebar .scroll"),
            height = $scrollable.outerHeight(true),    // visible height
            scrollHeight = $scrollable.prop("scrollHeight"), // total height
            barHeight = height * height / scrollHeight;   // Scrollbar height!

        var ua = navigator.userAgent;
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|Mobile|mobile|CriOS/i.test(ua)) {
            $scrollable.css({
                margin:0,
                width:'100%'
            });
        }

        $scrollbar.height(barHeight);

        var scrollableht = Math.round($scrollable.height());
        var scrollbarht = Math.round($scrollbar.height());

        if(scrollableht <= scrollbarht) {
            $scrollbar.hide();
        }
        else{
            $scrollbar.show();
        }

        // Element scroll:
        $scrollable.on("scroll", function () {
            $scrollbar.css({ top: $scrollable.scrollTop() / height * barHeight });
        });
    }


    $(window).resize(function(){
        customScroll();
    });
    $(".sidebar .nav").on("scroll mouseout mouseover",function(){
        customScroll();
    });
    customScroll();


    $('.attachment input[type="file"]').change(function (e) {
        $(this).next().find(".filename").html(e.target.files[0].name).addClass("active");
        $(this).next().find(".clear").show();
    });
    $(".attachment label span.clear").click(function (e) {
        e.preventDefault();
        var content = $(this).prev(".filename").attr("data-text");
        $(this).prev(".filename").html(content).removeClass("active");
        $(this).parents(".file-select").find("input[type=file]").val('');
        $(this).hide();
    });

    if($('.file-select .selected-img').length){
        $('.file-select input[type="file"]').change(function (e) {
            $(this).parent('.file-select').find(".selected-img").show();
            $(this).parent('.file-select').find("label").hide();
        });
        $('.file-select .selected-img span').click(function() {
            $(this).parents('.file-select').find(".selected-img").hide();
            $(this).parents('.file-select').find("label").show();
        });
    }
    $("select#m-payment").change(function(e){
        if($(this).val() == "other"){
            $("#custom-message").slideDown();
        }
        else{
            $("#custom-message").hide();
        }
    });



    /* 1. Visualizing things on Hover - See next part for action on click */
    $('#stars li').on('mouseover', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

        // Now highlight all the stars that's not after the current hovered star
        $(this).parent().children('li.star').each(function(e){
            if (e < onStar) {
                $(this).addClass('hover');
            }
            else {
                $(this).removeClass('hover');
            }
        });

    }).on('mouseout', function(){
        $(this).parent().children('li.star').each(function(e){
            $(this).removeClass('hover');
        });
    });


    if($('#stars').length){
        $('#stars li').on('mouseover', function(){
            var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
            // Now highlight all the stars that's not after the current hovered star
            $(this).parent().children('li.star').each(function(e){
                if (e < onStar) {
                    $(this).addClass('hover');
                }
                else {
                    $(this).removeClass('hover');
                }
            });
        }).on('mouseout', function(){
            $(this).parent().children('li.star').each(function(e){
                $(this).removeClass('hover');
            });
        });


        /* 2. Action to perform on click */
        $('#stars li').on('click', function(){
            var onStar = parseInt($(this).data('value'), 10); // The star currently selected
            var stars = $(this).parent().children('li.star');
            var count = 0;
            for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass('selected');
            }



            for (i = 0; i < onStar; i++) {
                $(stars[i]).addClass('selected');
                count += $(stars[i]).length;
                $('#stars').next(".count").find('span').text(count);
            }

            // JUST RESPONSE (Not needed)
            var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);


        });
    }


});




















