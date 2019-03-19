jQuery(document).ready(function($) {

/* nav */


$('.navicon').click(function() {
  $positionY = $(window).scrollTop();
  if ($positionY === 0) {
    $(this).toggleClass('close');
    $('nav.menu-primary-container, nav.menu-main-container').toggleClass('slideIn');
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


/* lightbox */

function enlarge() { 
  // var largeSrc = $(this).attr("src");

// // $( this ).parent().addClass( "enlarge" );
// $( this ).addClass( "enlarge" );

// $( this ).append( "<p>Test</p>" );

}
$( '.wp-block-gallery' ).prepend( '<div class="closepic"><i class="fa fa-window-close"></i></div>' );


$('.wp-block-gallery figure').click(function() {
$( this ).addClass( "enlarge" );
$( ".closepic" ).addClass( "reveal" );

// event.stopPropagation();
console.log("figure clicked");

});


$('.closepic').click(function() {
	console.log("closer clicked");
	$( this ).removeClass( "reveal" );

$(' figure.enlarge').removeClass( "enlarge" );

});


function closeSlideshow() {
  $('body, #lightbox').removeClass('single_view');
}



/* lazyload */
  var lazyloadImages;    

  if ("IntersectionObserver" in window) {
    lazyloadImages = document.querySelectorAll(".rl-gallery-container img");
    var imageObserver = new IntersectionObserver(function(entries, observer) {
      console.log(observer);
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          var image = entry.target;
          image.src = image.dataset.src;
          image.classList.remove("lazy");
          imageObserver.unobserve(image);
        }
      });
    }, {
      root: document.querySelector("main#main"),
      rootMargin: "0px 0px 500px 0px"
    });

    lazyloadImages.forEach(function(image) {
      imageObserver.observe(image);
    });
  } else {  
    var lazyloadThrottleTimeout;
    lazyloadImages = $(".lazy");
    
    function lazyload () {
      if(lazyloadThrottleTimeout) {
        clearTimeout(lazyloadThrottleTimeout);
      }    

      lazyloadThrottleTimeout = setTimeout(function() {
          var scrollTop = $(window).scrollTop();
          lazyloadImages.each(function() {
              var el = $(this);
              if(el.offset().top < window.innerHeight + scrollTop + 500) {
                var url = el.attr("data-src");
                el.attr("src", url);
                el.removeClass("lazy");
                lazyloadImages = $(".lazy");
              }
          });
          if(lazyloadImages.length == 0) { 
            $(document).off("scroll");
            $(window).off("resize");
          }
      }, 20);
    }

    $(document).on("scroll", lazyload);
    $(window).on("resize", lazyload);
  }
});