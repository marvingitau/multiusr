/*
 * Authour: Alfred Maina 
 * Company: @Legibra (http://legibra.com)
 */


$(document).ready(function () {
  pauseModalVideo();

  function pauseModalVideo() {
    var idArrayVideo = $(".gcc-youtube-video").map(function () {
      //return this.id
      //console.log("#"+this.id);
      var ids = "#" + this.id;
      $(ids).on('hidden.bs.modal', function (e) {
        $(ids + " iframe").attr("src", $(ids + " iframe").attr("src"));
      });
    }).get().join(',');
  }

  $('.gcc-youtube-video').appendTo("body");

  var owl = $('#video_gallery');
  owl.owlCarousel({
    loop: true,
    margin: 100,
    center: true,
    autoplay: true,
    autoplayTimeout: 10000,
    smartSpeed: 2000,
    slideBy: 1,
    nav: true,
    stagePadding: 20,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 3
      },
      1000: {
        items: 3
      }
    }
  });

  //Custom Button
  $('.videoPrevious').click(function () {
    owl.trigger('prev.owl.carousel');
  });
  $('.videoNext').click(function () {
    owl.trigger('next.owl.carousel');
  });


  var owl = $('.owl-carousel');
  owl.owlCarousel({
    loop: true,
    margin: 0,
    center: true,
    autoplay: true,
    animateIn: 'fadeIn',
    animateOut: 'fadeOut',
    autoplayTimeout: 4000,
    smartSpeed: 1000,
    slideBy: 1,
    nav: false,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 1
      },
      1000: {
        items: 1
      }
    }
  });

});





var scroll_pos = 0;
$(document).scroll(function () {
  scroll_pos = $(this).scrollTop();
  if (scroll_pos > 120) {
    $(".navbar").addClass("scrolled");
  } else {
    $(".navbar").removeClass("scrolled");
  }
  if (scroll_pos > 700) {
    $(".cd-top").addClass("cd-top--is-visible");
  } else {
    $(".cd-top").removeClass("cd-top--is-visible");
  }
  if (scroll_pos > 540) {
    $(".widget-scroll").addClass("fixed-position");
  } else {
    $(".widget-scroll").removeClass("fixed-position");
  }

});


window.addEventListener('load', function () {
  document.querySelector('.pre-loader').classList.add('is-loaded');
});