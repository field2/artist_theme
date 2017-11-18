jQuery(document).ready(function($) {

/* slider */

$('#slideshow').cycle({
swipe:'true',
fx:     'scrollHorz',
rev: 'true',
random: 'true',
speed:  'slow',
timeout: 0,
activePagerClass: 'current-slide',
pause:   1 ,
prev:   '#next',
next:   '#prev'
});




$('.navicon').click(function() {
  $positionY = $(window).scrollTop();
  if ($positionY === 0) {
    $(this).toggleClass('close');
    $('nav.menu-primary-container').toggleClass('slideIn');
  } else {
    $('html, body').animate({
      scrollTop: 0
    }, 400);
    return false;
  }
});
$(window).scroll(function() {
  if ($(this).scrollTop() > 0) {
    $('nav.menu-primary-container').removeClass('slideIn');
    $('.navicon').removeClass('close');
    $('.navicon').addClass('arrow_up');
  } else {
    $('.navicon').removeClass('arrow_up');
  }
});


});