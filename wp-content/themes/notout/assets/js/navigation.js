"use strict";

;

(function($) {
    "use strict";

    var screenWidth = 1080;
    var notoutMenu = $('.notout-inline-menu');
    $('.notout-inline-menu li').find('> .sub-menu').before('<span class="mb-toggle js-show-mb-nav"><i class="fas fa-chevron-down"></i></span>'); // Desktop Menu

    var desktopMenu = function desktopMenu() {
        if ($(window).width() > screenWidth) {
            var notoutMenuLink = $('.notout-inline-menu li');
            notoutMenuLink.find('> ul.sub-menu').addClass('hide');
            notoutMenuLink.on('mouseover', function() {
                $(this).find('> ul.sub-menu').addClass('open').removeClass('hide').stop(true, true);
            });
            notoutMenuLink.on('mouseleave', function() {
                $(this).find('ul.sub-menu').addClass('hide').removeClass('open').stop(true, true);
            });
        }
    };

    desktopMenu(); // Mobile Menu

    var mobileMenu = function mobileMenu() {
        if ($(window).width() <= screenWidth) {
            var showNav = '.js-show-nav';
            $(document.body).on('click', showNav, function(e) {
                $(this).addClass('js-hide-nav').removeClass('js-show-nav');
                e.preventDefault();
                notoutMenu.addClass('open');
            });
            var hideNav = '.js-hide-nav';
            $(document.body).on('click', hideNav, function(e) {
                e.preventDefault();
                $(this).addClass('js-show-nav').removeClass('js-hide-nav');
                notoutMenu.removeClass('open');
            });
            var subMenuShowNav = '.js-show-mb-nav';
            $(document.body).on('click', subMenuShowNav, function(e) {
                e.preventDefault();
                $(this).addClass('js-hide-mb-nav').removeClass('js-show-mb-nav');
                $(this).parent().find('> .sub-menu').addClass('open');
            });
            var subMenuHideNav = '.js-hide-mb-nav';
            $(document.body).on('click', subMenuHideNav, function(e) {
                e.preventDefault();
                $(this).addClass('js-show-mb-nav').removeClass('js-hide-mb-nav');
                $(this).parent().find('> .sub-menu').removeClass('open');
            });
        }
    };

    mobileMenu(); // On Window Resize Event

    $(window).resize(function() {
        desktopMenu();
        mobileMenu();
    }); // Scroll to fixed top

    $(window).on('scroll', function(e) {
        var scrollTop = $(window).scrollTop();
        var topMenu = $('.notout-navbar');

        if (scrollTop > 220) {
            topMenu.addClass('fixed-to-top');
        } else {
            topMenu.removeClass('fixed-to-top');
        }
    });
    /**
     * Page Progress Bar
     */

    var pageProgressBar = function pageProgressBar() {
        var winScroll = $(window).scrollTop();
        var contentHeight = $('.blog-box').height();
        var scrolled = winScroll / contentHeight * 100;
        $('#page-progress').css({
            width: scrolled + '%'
        });
    }; // Navbar Scrolling Effects


    var c,
        currentScrollTop = 0,
        navbar = $('nav#site-navigation');
    $(window).scroll(function() {
        var a = $(window).scrollTop();
        var b = navbar.height();
        currentScrollTop = a;

        if (c < currentScrollTop && a > b + b) {
            navbar.addClass("scrollUp").removeClass("scrollDown");
            $(window).scroll(function(e) {
                var scrollPosition = $(window).scrollTop();
                pageProgressBar();
            });
        } else if (c > currentScrollTop && !(a <= b)) {
            navbar.removeClass("scrollUp").addClass("scrollDown");
        }

        c = currentScrollTop;
    }); // Scroll to fixed top

    $(window).on('scroll', function(e) {
        var scrollTop = $(window).scrollTop();
        var topMenu = $('.notout-navbar');

        if (scrollTop > 0) {
            topMenu.addClass('in-scroll');
        } else {
            topMenu.removeClass('in-scroll');
        }
    });
})(jQuery);