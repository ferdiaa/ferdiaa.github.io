

$(document).ready(function(){
  
    $('.slider-wrap').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        speed: 1000,
        infinite: false,
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1,
            }
          },
          {
            breakpoint: 820,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 553,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ],
        prevArrow:"<button type='button' class='slick-prev pull-left'><i class='fa-solid fa-arrow-left slick-arrow' aria-hidden='true'></i></button>",
        nextArrow:"<button type='button' class='slick-next pull-right'><i class='fa-solid fa-arrow-right slick-arrow' aria-hidden='true'></i></button>"
    });
    
});

$(document).ready(function(){
    $('.slider-review__wrap').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        speed: 1000,
        infinite: false,
        responsive: [
            {
              breakpoint: 1082,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
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
          ],
        prevArrow:"<button type='button' class='slick-prev-review pull-left'><i class='fa-solid fa-arrow-left slick-arrow' aria-hidden='true'></i></button>",
        nextArrow:"<button type='button' class='slick-next-review pull-right'><i class='fa-solid fa-arrow-right slick-arrow' aria-hidden='true'></i></button>"
    });
});
