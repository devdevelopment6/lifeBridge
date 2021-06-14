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

575:{

items:1,

nav:false,
dots:true

},

991:{

items:1,

nav:true,

loop:true,

dots:false

}


}
});
})
