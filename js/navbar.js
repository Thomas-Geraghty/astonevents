$(document).ready(function() {
  var stickyNavTop = $('.navbar').offset().top - 20;

  var stickyNav = function(){
    var scrollTop = $(window).scrollTop();

    if (scrollTop > stickyNavTop) {
      $('.navbar').addClass('navbar-sticky');
    } else {
      $('.navbar').removeClass('navbar-sticky');
    }
  };

  stickyNav();

  $(window).scroll(function() {
    stickyNav();
  });
 });
