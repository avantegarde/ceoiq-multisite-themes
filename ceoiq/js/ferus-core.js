/**
 * Main JS file for ferus-core
 * Author: Kael Steinert
 */
jQuery(document).ready(function ($) {

    // Custom Menu Toggle
    $('button#menu-toggle').click(function(){
        $(this).toggleClass('active');
        var menu = $('#menu-float');
        var menuText = $(this).find('.menu-label');
        if(menu.hasClass('active')){
            menu.removeClass('active');
            menuText.html('Menu');
            $('body').removeClass('noscroll');
        } else {
            menu.addClass('active');
            menuText.html('Close');
            $('body').addClass('noscroll');
        }
    });

    /**
     * Masonry Blogroll
     */
    $('.posts-grid-wrapper').masonry({
        // set itemSelector so .grid-sizer is not used in layout
        itemSelector: '.post-item',
        // use element for option
        columnWidth: '.grid-sizer',
        percentPosition: true
    });
    /**
     * Tools Toggle Collapse
     */
    $('.tool-toggle [data-toggle="collapse"]').click( function(e) {
        $('.tool-toggle').removeClass('active');
        $(this).closest('.tool-toggle').addClass('active');
        $('.tools-wrap .collapse').collapse('hide');
    });
    /**
     * Lightbox
     */
    /*lightbox.option({
        'wrapAround': true
    });*/
    $('.lb-gallery').featherlightGallery();

    /**
     * Header Search
     * @type {*}
     */
    var search_holder = $('.header-search');
    if (search_holder) {
        var searchTrigger = search_holder.find('label[for="search_text"]');
        $(searchTrigger).click(function(){
            if (search_holder.hasClass('active')) {
                search_holder.removeClass('active');
            } else {
                search_holder.addClass('active');
            }
        });
    }
    /**
     * Homepage Slider
     */
    /*$('.home_slider').slick({
        infinite: true,
        dots: true,
        arrows: false,
        autoplay: true,
        speed: 1000,
        autoplaySpeed: 4000,
        fade: true,
    });*/
    /**
     * Testimonials Slider
     */
    $('.testimonial_slider').slick({
        infinite: true,
        dots: false,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 12000,
    });
    /**
     * Slideset Products
     */
    $('.prop-slideset').slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 650,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    /**
     * Gallery Slideset
     */
    $('.gallery-slideset').slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
    /**
     * Homepage Content Slider
     */
    $('.content_slider').slick({
        infinite: true,
        dots: false,
        arrows: true,
        fade: true,
        cssEase: 'linear'
    });
    /**
     * Slick Tab Slider
     * Usage: <button data-slide=3>GoTo Slide 3<button>
     */
    $('.tab-slider').slick({
        dots: false,
        arrows: false,
        speed: 800,
        infinite: true
    });
    $('.tab-slider').on('afterChange', function(event, slick, currentSlide){
        var holder = $(this).closest('section');
        var slideNumber = currentSlide;
        $(holder).find('.tab-slider-nav [data-slide]').removeClass('active');
        $(holder).find('.tab-slider-nav [data-slide="' + slideNumber + '"]').addClass('active');
    });
    $('.tab-slider-nav [data-slide]').click(function () {
        var holder = $(this).closest('section');
        var currentSlider = $(holder).find('.tab-slider');
        var slideNumber = $(this).attr("data-slide");
        var currentSlide = $(currentSlider).slick('slickCurrentSlide');
        $(currentSlider).slick('slickGoTo', slideNumber);
        if (slideNumber != currentSlide) {
            $(holder).find('.tab-slider-nav [data-slide]').removeClass('active');
        }
        $(this).addClass('active');
    });
    /**
     * Accordion
     */
    var allPanels = $('.accordion > [data-accordion=content]').hide();
    var activePanel = $('.accordion > [data-accordion=content].active').show();
    $('.accordion > [data-accordion=title]').click(function () {
        var target = $(this).next();
        var holder = $(this).closest('.accordion');
        var allPanelTitles = holder.find('> [data-accordion=title]');
        var allPanels = holder.find('[data-accordion=content]');

        if (!$(this).hasClass('active')) {
            allPanelTitles.removeClass('active');
            $(this).addClass('active');
        } else if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        }
        if (!target.hasClass('active')) {
            allPanels.removeClass('active').slideUp();
            target.addClass('active').slideDown();
        } else if (target.hasClass('active')) {
            target.removeClass('active').slideUp();
        }
        return false;
    });
    /**
     * Listing Gallery
     * @type {*}
     */
    var listingGallery = $('#listing-gallery');
    if (listingGallery) {
        var galleryView = listingGallery.find('#gallery-view');
        var galleryNavItems = listingGallery.find('#gallery-nav .thumb-item');
        listingGallery.find('#gallery-nav .thumb-item:first-of-type').addClass('active');
        $('#gallery-nav .thumb-item').click(function () {
            var image = $(this).attr('data-image');
            galleryNavItems.removeClass('active');
            $(this).addClass('active');
            galleryView.css('background-image', 'url(' + image + ')');
        });
    }
    /**
     * Listing Gallery Slideset
     */
    $('.prop-gallery-nav').slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 601,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 401,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
        ]
    });
    /**
     * Workshop modal form pre-populate
     */
    $('#workshopModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var workshop = button.data('workshop');
        var modal = $(this);
        modal.find('li.gfield.workshop-prepop input').val(workshop);
    });
    /**
     * Virtual Programs modal form pre-populate
     */
    $('#vprogramModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var vprogram = button.data('vprogram');
        var modal = $(this);
        modal.find('li.gfield.vprogram-prepop input').val(vprogram);
    });
    /**
     * Video modal
     */
    $('.video-modal').on('shown.bs.modal', function () {
        EQCSS.apply();
    });
    /**
     * Toggle Floating Contact Form
     */
    var float_contact = $('#contact-float');
    if(float_contact){
        float_contact.find('.toggle').click(function () {
            if(float_contact.hasClass('active')){
                float_contact.removeClass('active');
                $(this).html('Chat Now! <i class="fa fa-envelope"></i>');
            } else {
                float_contact.addClass('active');
                $(this).html('Chat Now! <i class="fa fa-close"></i>');
            }
        });
        float_contact.find('.close').click(function () {
            if(float_contact.hasClass('active')){
                float_contact.removeClass('active');
            }
        });
    }

});// END document.ready

/*************************************************************************/
/* Window.load  */
/*************************************************************************/
jQuery(window).load(function () {

    /**
     * Auto Page Height for small pages
     */
    window.addEventListener("resize", autoPageHeight);
    function autoPageHeight() {
        var footer = document.getElementsByClassName("site-footer")[0];
        var pageBody = document.getElementsByClassName("page-body")[0];
        if (footer && pageBody) {
            var footerHeight = footer.clientHeight;
            var pageHeight = window.innerHeight - footerHeight;
            pageBody.style.minHeight = pageHeight + "px";
        }
    }
    //autoPageHeight();

    /**
     * Smooth Scroll
     */
    jQuery('a.smooth[href^="#"]:not([href="#"])').on('click', function (e) {
        e.preventDefault();
        var target = this.hash;
        var $target = jQuery(target);
        if (jQuery(window).width() > 767 && jQuery(window).width() < 991) {
            var $offset = $target.offset().top - 225;
        }
        else {
            var $offset = $target.offset().top - 180;
        }
        jQuery('html, body').stop().animate({
            'scrollTop': $offset
        }, 900, 'swing', function () {
            window.location.hash = target;
        });
    });

});/* END window.load */

/**
 * Match Height Columns
 * USAGE: data-col=a
 */
function colMatchHeight() {
    var cols = document.querySelectorAll('[data-col]'),
        encountered = [];
    for (i = 0; i < cols.length; i++) {
        var attr = cols[i].getAttribute('data-col');
        if (encountered.indexOf(attr) == -1) {
            encountered.push(attr);
        }
    }
    for (set = 0; set < encountered.length; set++) {
        var col = document.querySelectorAll('[data-col="' + encountered[set] + '"]'),
            group = [];
        for (i = 0; i < col.length; i++) {
            col[i].style.height = 'auto';
            group.push(col[i].scrollHeight);
        }
        for (i = 0; i < col.length; i++) {
            col[i].style.height = Math.max.apply(Math, group) + 'px';
        }
    }
}
window.addEventListener("load", colMatchHeight);
window.addEventListener("resize", colMatchHeight);

/**
 * Gmap click to interact
 */
/*function mapClickActivate() {
    var map = document.getElementById('googlemap');
    if (map) {
        //var iframe = map.getElementsByTagName('iframe')[0];
        var iframe = document.getElementById('apimap');
        iframe.style.pointerEvents = 'none';
        map.onclick = function () {
            map.className += ' map-active';
            iframe.style.pointerEvents = 'inherit';
        };
        map.onmouseleave = function () {
            iframe.style.pointerEvents = 'none';
            map.classList.remove('map-active');
        };
    }
}
window.addEventListener("load", mapClickActivate);
window.addEventListener("resize", mapClickActivate);*/

/**
 * Proper Parallax
 */
function getTop(elem) {
    var box = elem.getBoundingClientRect();
    var body = document.body;
    var docEl = document.documentElement;
    var scrollTop = window.pageYOffset || docEl.scrollTop || body.scrollTop;
    var clientTop = docEl.clientTop || body.clientTop || 0;
    var top  = box.top +  scrollTop - clientTop;
    return Math.round(top);
}
function parallaxImages() {
    // Set the scroll for each parallax individually
    var plx = document.getElementsByClassName('parallax');
    for(i=0;i<plx.length;i++){
        var height = plx[i].clientHeight;
        var img = plx[i].getAttribute('data-plx-img');
        var plxImg = document.createElement("div");
        plxImg.className += " plx-img";
        plxImg.style.height = (height+(height/2))+'px';
        plxImg.style.backgroundImage = 'url('+ img +')';
        plx[i].insertBefore(plxImg, plx[i].firstChild);
    }
}
window.addEventListener('load', parallaxImages);
function plxScroll(){
    var scrolled = window.scrollY;
    var win_height_padded = window.innerHeight * 1.25;
    // Set the scroll for each parallax individually
    var plx = document.getElementsByClassName('parallax');
    for(i=0;i<plx.length;i++){
        var offsetTop = getTop(plx[i]);
        //var orientation = plx[i].getAttribute('data-plx-o');
        if (scrolled + win_height_padded >= offsetTop) {
            var plxImg = plx[i].getElementsByClassName('plx-img')[0];
            if(plxImg) {
                var plxImgHeight = plxImg.clientHeight;
                var singleScroll = (scrolled - offsetTop) - plxImgHeight/5;
                plxImg.style.top = (singleScroll / 5) + "px";
            }
        }
    }
}
window.addEventListener('load', plxScroll);
window.addEventListener('resize', plxScroll);
window.addEventListener('scroll', plxScroll);

/**
 * Scroll Revealing Items
 */
var isScrolling = false;
window.addEventListener("scroll", throttleScroll);
function throttleScroll(e) {
    if (isScrolling == false) {
        window.requestAnimationFrame(function() {
            scrolling(e);
            isScrolling = false;
        });
    }
    isScrolling = true;
}
document.addEventListener("DOMContentLoaded", scrolling, false);

function scrolling(e) {
    var scrollItems = document.querySelectorAll("[data-reveal]");
    for (var i = 0; i < scrollItems.length; i++) {
        var scrollItem = scrollItems[i];
        var animationType = scrollItems[i].getAttribute('data-reveal');

        if (isPartiallyVisible(scrollItem)) {
            scrollItem.classList.add('animated', animationType);
        } /*else {
            scrollItem.classList.remove('animated', animationType);
        }*/
    }
}
function isPartiallyVisible(el) {
    var elementBoundary = el.getBoundingClientRect();
    var top = elementBoundary.top;
    var bottom = elementBoundary.bottom;
    var height = elementBoundary.height;

    return ((top + height >= 0) && (height + window.innerHeight >= bottom));
}
function isFullyVisible(el) {
    var elementBoundary = el.getBoundingClientRect();
    var top = elementBoundary.top;
    var bottom = elementBoundary.bottom;

    return ((top >= 0) && (bottom <= window.innerHeight));
}

/**
 * Google Maps API
 */
var map;
function initMap() {
    var mapEl = document.getElementById('apimap');
    if (mapEl) {
        var lpm = {lat: 44.232304, lng: -76.483860};
        var map = new google.maps.Map(mapEl, {
            center: lpm,
            zoom: 15,
            styles: [
                {
                    featureType: 'poi',
                    stylers: [{visibility: 'off'}]
                },
            ]
        });

        var infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);

        service.getDetails({
            placeId: 'ChIJba9Hjv-q0kwRNTPNseS0R2k'
        }, function (place, status) {
            if (status === google.maps.places.PlacesServiceStatus.OK) {
                var marker = new google.maps.Marker({
                    map: map,
                    position: place.geometry.location
                });
                infowindow.setContent(
                    '<div>' +
                    '   <strong>' + place.name + '</strong><br>' +
                    '   <p class="address">' + place.formatted_address + '</p>' +
                    '   <a href="https://www.google.ca/maps/place/Limestone+Property+Management/@44.2322278,-76.4838064,17.73z/data=!4m12!1m6!3m5!1s0x4cd2aaff8e47af6d:0x6947b4e4b1cd3335!2sLimestone+Property+Management!8m2!3d44.2322959!4d-76.4838294!3m4!1s0x4cd2aaff8e47af6d:0x6947b4e4b1cd3335!8m2!3d44.2322959!4d-76.4838294" target="_blank">View Larger Map</a>' +
                    '</div>');
                google.maps.event.addListener(marker, 'click', function () {
                    infowindow.open(map, this);
                });
                infowindow.open(map, marker);
            }
        });
    } else {
        return;
    }
}