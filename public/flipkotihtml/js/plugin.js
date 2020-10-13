

(function($) {

    //background image parallax effect

    var parallax = function($this,options){
        var image = $this.attr("data-image");
        $this.css('position','relative');
        $('<img src="'+ image +'">').prependTo($this).css({
            width: '100%',
            height: '100%',
            objectFit: 'cover',
            position:'absolute',
            left:'0',
            top:'0',
            objectPosition: options.objectPosition
        });
        function update(){
            var $elHeight = $this.outerHeight();
            var $elTop = $this.offset().top;
            var pos = $(window).scrollTop();
            var windowHeight = $(window).outerHeight();

            // Check if totally above or totally below viewport
            if ($elTop + $elHeight < pos || $elTop > pos + windowHeight) {
                return;
            }

            $this.children("img").css('height', Math.round($elHeight + (windowHeight - $elHeight) *  options.speedFactor) + "px");

            $this.children("img").css('top', Math.round(-($elTop - pos) * options.speedFactor) + "px");
            if(options.blurEffect){
                $this.css('filter','blur('+ Math.round(-(($elTop - pos) * options.speedFactor/10)) +'px)');
            }
        }
        $(window).on('resize', function() {
            update();
        });
        $(window).on('load', function() {
            update();
        });
        $(window).on('scroll', function() {
            update();
        });
        update();
    };

    $.fn.bgParallax = function(opts) {
        var defaults = {
            speedFactor:0.4, //value less than one
            objectPosition:"center center", // "right top","left bottom"
            blurEffect:false,
            blurspeed:0.1
        };
        var options = $.extend(defaults, opts);

        return this.each(function(){
            $this = $(this);
            parallax($this,options);
        });
    };


    //smoth scroller

    var scroller = function($this,body,options){
        $element = $this;
        if(!body.children("main").length){
            body.prepend("<main>");
            body.children().each(function(index, element){
                if(!($(element)[0].nodeName == "SCRIPT" || $(element)[0].nodeName == "LINK" || $(element)[0].nodeName == "MAIN")){
                    $(element).appendTo(body.children("main"));
                }
            });
        }
        function updateResize(){
            var height = Math.max( document.body.scrollHeight, document.body.offsetHeight);

            body.css("height",height+"px");
            body.children("main").css({
                position: 'fixed',
                left: 0,
                top: 0,
                width: '100%',
                height: '100vh'
            });

            $($element).css({
                position: "relative",
                width: "100%",
                minHeight: "100vh",
                overflow: "hidden"
            });

            gsap.to($element, {
                duration: 0,
                y: - (window.pageYOffset * options.scrollSpeed)
            });
        }
        $(window).on('resize', function() {
            body.removeAttr("style");
            body.find("main").removeAttr("style");
            updateResize();
        });
        updateResize();

        $(window).on('scroll', function() {
            gsap.to($element, {
                duration: options.duration,
                y: - (window.pageYOffset * options.scrollSpeed)
            });
        });
    };

    $.fn.smothScroller = function(opts) {
        var defaults = {
            duration: 0.6,
            scrollSpeed: 1
        };
        var options = $.extend(defaults, opts);
        var $this = this;
        var body = $("body");

        $(window).on('load', function() {
            scroller($this,body,options);
        });
    };

    //css Animate on scroll
    //$("body").cssAnimate();
    //<element class="animateblock" data-animate-class="fadeInLeft" data-animate-delay="0.8s">


    $.fn.cssAnimate = function() {
        var $elems = $('.animateblock');
        var winheight = $(window).height();
        $(window).load(function() {
            $(window).scroll(function() {
                animate_elems();
            });
            animate_elems();
        });

        function animate_elems() {
            wintop = $(window).scrollTop();
            $elems.each(function() {
                $elm = $(this);
                var $elmClass = $elm.attr('data-animate-class');
                var $elmDelay = $elm.attr('data-animate-delay');

                $elmClass = $elmClass == "undefined" ? "" : $elmClass;

                if ($elm.hasClass('animated')) {
                    return !0
                }
                topcoords = $elm.offset().top;
                if (wintop > (topcoords - (winheight * .85))) {
                    $elm.addClass($elmClass + ' animated').css({
                        "animation-delay": $elmDelay
                    });
                }
            });
        }
    }



    //Go to top on button click


    $.fn.goToTop = function(opt) {
        var element = $(this);
        var options = $.extend({
            offset: 400,
            animatespeed: 800,
        }, opt);
        $(window).scroll(function() {
            goTop(options);
        });
        goTop(options);

        function goTop() {
            if ($(window).scrollTop() > options.offset) {
                element.fadeIn(100);
            } else {
                element.fadeOut(100);
            }
        }
        element.click(function() {
            $('html, body').animate({
                scrollTop: 0
            }, options.animatespeed);
            return !1
        })
    };

})(jQuery);