/*
Template Name: Monster Admin
Author: Themedesigner
Email: niravjoshi87@gmail.com
File: js
*/
$(function () {
    "use strict";
    $(function () {
        $(".preloader").fadeOut();
    });
    
    $('#owl-demo2').owlCarousel({
            margin:50,
            nav:false,
            autoplay:true,
            loop: true,
            slideSpeed : 10,
            rewindNav : true,
            scrollPerPage : false,
            responsive:{
                0:{
                    items:1
                },
                480:{
                    items:1
                },
                700:{
                    items:1
                },
                1000:{
                    items:1
                },
                1100:{
                    items:1
                }
            }
        })
        $('a').on('click',function(event){
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - 90 }, 1000);
        event.preventDefault();
    });  
	
	// ============================================================== 
    // Terbaru
    // ============================================================== 
    $(".right-side-toggle.terbaru").click(function () {
        $(".right-sidebar.terbaru").slideDown(50);
        $(".right-sidebar.terbaru").toggleClass("shw-rside");
        $(".ti-angle-left.terbaru").toggleClass("terbaru-close");
        $(".btn.terbaru").toggleClass("terbaru-btn");
        //$("#main-wrapper").toggleClass("wrapperx");
    });
	
	// ============================================================== 
    // Katalog
    // ============================================================== 
    $(".top-side-toggle.katalog").click(function () {
        $(".top-sidebar.katalog").slideDown(50);
        $(".top-sidebar.katalog").toggleClass("shw-topside");
    });
	
	// ============================================================== 
    // Terbaru
    // ============================================================== 
    $(".right-side-toggle.terbaru2").click(function () {
        $(".right-sidebar2.terbaru2").slideDown(50);
        $(".right-sidebar2.terbaru2").toggleClass("shw-rside2");
		$(".ti-angle-right.terbaru2").toggleClass("terbaru2-close");
        $(".btn.terbaru2").toggleClass("terbaru-btn");
        $("#main-wrapper").toggleClass("wrappery");
    });
    
        
});