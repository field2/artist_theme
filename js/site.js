jQuery(document).ready(function($) {



$('.slideshow').cycle({
swipe:'true',
fx:     'scrollHorz',
rev: 'true',
random: 'true',
speed:  'slow',
timeout: 0,
activePagerClass: 'current-slide',
pause:   1 ,
prev:   '#next',
next:   '#prev',
});
});