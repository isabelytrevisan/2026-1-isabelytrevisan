

let slideIndex = 1;
mostrarSlides(slideIndex);

function mudarSlide(n){
    mostrarSlides(slideIndex += n);
}

function mostrarSlides(n){

    let slides = document.getElementsByClassName("slides");

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

 // menu
        document.addEventListener('DOMContentLoaded', () => {
        const btnToggle = document.getElementById('toggleMenu');
        const menuAside = document.querySelector('.menu-aside');

        if (btnToggle && menuAside) {
            btnToggle.addEventListener('click', () => {
                menuAside.classList.toggle('collapsed');
            });
        }
    });