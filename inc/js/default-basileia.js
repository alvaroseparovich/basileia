
function changeColors(){
    
    var colorThief = new ColorThief();
    
    bsFeatured = document.querySelector(".basileia-book-store");
    console.log(bsFeatured.querySelectorAll("img"));
    slidesEl = Array.prototype.slice.call(bsFeatured.querySelectorAll("img"));
    console.log(slidesEl);
    st = '';
    slidesEl.forEach(e=>{
        color = colorThief.getColor(e);
        el = e.parentElement;
        id = el.id;
        
        el.backgroundColor = "rgba( "+color[0]+" , "+color[1]+" , "+color[2]+" , 1 )";
        console.log(el);
        if(id == ""){
            st = st + ".basileia-featured-bg{background-color: rgba( "+color[0]+" , "+color[1]+" , "+color[2]+" , 1 );} ";
        }else{
            st = st + "#bg-basileia-"+id+".basileia-featured-bg{background-color: rgba( "+color[0]+" , "+color[1]+" , "+color[2]+" , 1 );} ";
        }
    })

    style = document.createElement("style");
    style.innerText = st;
    document.querySelector("footer").appendChild(style);
}
    
window.onload = changeColors;
/*
function waitForSlides(){
    bsFeatured = document.querySelector(".basileia-book-store");
    slideEl = bsFeatured.querySelector(".slider-section .slick-slider .slick-slide");
    if (slideEl != null) {
        console.log(slideEl);
    }else{

        setTimeout(	waitForSlides() ,3000);
        
    }
}
waitForSlides();*/