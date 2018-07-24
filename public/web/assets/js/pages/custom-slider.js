$('#firstSlider').owlCarousel({
    navigation: true,
    margin: 60,
    nav: true,
    //autoplay: true,
    center: true,
    autoplayTimeout: 3000,
    loop: true,
    dots: true,
    singleItem: true,
    autoplayHoverPause: true,
    responsive: {
        0: {
            items: 1
        },
        767: {
            items: 1,
            stagePadding: 0,
        },
        1300: {
            items: 1,
            stagePadding: 220,
        },
        1600: {
            items: 1,
            stagePadding: 345,
        },
        1920: {
            items: 1,
            stagePadding: 475,
        }
    }
})
$('#secondSlider').owlCarousel({
    navigation: true,
    margin: 60,
    nav: true,
    autoplay: true,
    center: true,
    autoplayTimeout: 3000,
    loop: true,
    dots: true,
    singleItem: true,
    autoplayHoverPause: true,
    responsive: {
        0: {
            items: 1
        },
        767: {
            items: 1,
            stagePadding: 0,
        },
        1300: {
            items: 1,
            stagePadding: 220,
        },
        1600: {
            items: 1,
            stagePadding: 345,
        },
        1920: {
            items: 1,
            stagePadding: 475,
        }
    }
})