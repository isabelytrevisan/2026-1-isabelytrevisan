let slideIndex = 1;

function mudarSlide(n){
    mostrarSlides(slideIndex += n);
}

// slides func
function mostrarSlides(n){

    let slides = document.getElementsByClassName("slides");

    if(slides.length === 0) return; // Exit if no slides exist

    if(n > slides.length){
        slideIndex = 1;
    }

    if(n < 1){
        slideIndex = slides.length;
    }

    for(let i = 0; i < slides.length; i++){
        slides[i].style.display = "none";
    }

    slides[slideIndex - 1].style.display = "block";
}

if(document.getElementsByClassName("slides").length > 0) {
    mostrarSlides(slideIndex);
}

// menu func

document.addEventListener('DOMContentLoaded', () => {
    const btnToggle = document.getElementById('toggleMenu');
    const menuAside = document.querySelector('.menu-aside');

    if (btnToggle && menuAside) {
        btnToggle.addEventListener('click', () => {
            menuAside.classList.toggle('collapsed');
        });
    }
});