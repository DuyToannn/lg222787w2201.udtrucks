$(window).load(function() {
    var swiper = new Swiper(".mySwiper", {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
    });
    var swiper2 = new Swiper(".mySwiper2", {
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        thumbs: {
            swiper: swiper,
        },
    });
    
    
    // Zoom
    
    $(function(){
        $('.zoomsl').imagezoomsl({ 
            zoomrange: [2, 12],
            scrollspeedanimate: 10,
            loopspeedanimate: 5,
            magnifiereffectanimate: "slideIn"
        });  
    });
})
