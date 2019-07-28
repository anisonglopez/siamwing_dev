function unhideBody() {
  var bodyElems = document.getElementsByTagName("body");
  bodyElems[0].style.visibility = "visible";
  $("#overlay").fadeOut();
}
(function($) {

  "use strict"; // Start of use strict
 // alert(document.cookie);
 $('#viewless').hide();
 // Toggle the side navigation
 $("#sidebarToggle").on('click',function(e) {
  $("body").toggleClass("sidebar-toggled");
$(".sidebar").toggleClass("toggled");
$('#sidebarToggle').hide();
$('#viewless').show();
document.cookie = 'flag=1; path=/';
var cookieValue = document.cookie.replace(/(?:(?:^|.*;\s*)flag\s*\=\s*([^;]*).*$)|^.*$/, "$1");
if ($(".sidebar").hasClass("toggled")) {
  $('.sidebar .collapse').collapse('hide');
};
 });
 $('#viewless').click(function(){
   $("body").toggleClass("sidebar-toggled");
$(".sidebar").toggleClass("toggled");
   $('#sidebarToggle').show();
   $('#viewless').hide();
   
   document.cookie = 'flag=2; path=/';
   var cookieValue = document.cookie.replace(/(?:(?:^|.*;\s*)flag\s*\=\s*([^;]*).*$)|^.*$/, "$1");

});
var cookieValue = document.cookie.replace(/(?:(?:^|.*;\s*)flag\s*\=\s*([^;]*).*$)|^.*$/, "$1");
var toggle_flag = Number(cookieValue);
if( toggle_flag === 1){
 $('#sidebarToggle').click();
} 
else {
 $("body").toggleClass("");
 $(".sidebar").toggleClass("");
}

  // Toggle the side navigation
  $(" #sidebarToggleTop").on('click', function(e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
  if ($(".sidebar").hasClass("toggled")) {
    $('.sidebar .collapse').collapse('hide');
  };
  });

  // Close any open menu accordions when window is resized below 768px
  $(window).resize(function() {
    if ($(window).width() < 768) {
      document.cookie = 'flag=1; path=/';
      $('.sidebar .collapse').collapse('hide');
      // if ($(".sidebar").hasClass("toggled")) {
      //   $('.sidebar .collapse').collapse('hide');
      // };
      $("#sidebarToggleTop").on('click',function(e) {
        $(".sidebar").toggleClass("toggled ");

       });
    };
  });

  if ($(window).width() < 768) {
    document.cookie = 'flag=1; path=/';
    $('.sidebar .collapse').collapse('hide');
    // if ($(".sidebar").hasClass("toggled")) {
    //   $('.sidebar .collapse').collapse('hide');
    // };
    // $("#sidebarToggleTop").on('click',function(e) {
    //   $(".sidebar").toggleClass("toggled");
    //  });
  }

//   if ($(window).width() < 400) {
//     document.cookie = 'flag=2; path=/';
//    $('.sidebar .collapse').collapse('hide');
//   //  if ($(".sidebar").hasClass("toggled")) {
//   //    $('.sidebar .collapse').collapse('hide');
//   //  };
//    $("#sidebarToggleTop").on('click',function(e) {
//      $(".sidebar").toggleClass("toggled");
//     });
//  };

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });

  // Scroll to top button appear
  $(document).on('scroll', function() {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function(e) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    e.preventDefault();
  });

})(jQuery); // End of use strict
