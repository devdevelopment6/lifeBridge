jQuery(document).ready(function() {
var owl = jQuery('#owltestimonialcarousel');
owl.owlCarousel({
loop: true,
margin: 10,
autoplay: false,
autoplayTimeout: 5000,
autoplayHoverPause: true,
responsive:{

0:{

items:1,

nav:false,
dots:true

},

768:{

items:3,

nav:false,
dots:true

},

1000:{

items:6,

nav:true,

loop:true,

dots:false

}

}
});
})
