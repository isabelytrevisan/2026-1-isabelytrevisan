let slideIndex = 1;

function mudarSlide(n){
    mostrarSlides(slideIndex += n);
}

// slides func
function mostrarSlides(n){

    let slides = document.getElementsByClassName("slides");

    if(slides.length === 0) return; // sai se não houver slides
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

// dropdown func
document.addEventListener("DOMContentLoaded", function() {
    const selectOriginal = document.getElementById('idEstoque');
    const container = document.getElementById('pill-container');
    const options = selectOriginal.options;

    Array.from(options).forEach((option, index) => {
        const pill = document.createElement('div');
        pill.classList.add('pill');
        
        pill.innerHTML = `<span class="close-icon">✕</span> ${ option.text}`;

        pill.addEventListener('click', () => {
            option.selected = !option.selected;
            
            pill.classList.toggle('active');

            selectOriginal.dispatchEvent(new Event('change'));
        });

        container.appendChild(pill);
    });
});

const cards = document.querySelectorAll(".flip-card");

cards.forEach(card => {

    card.addEventListener("click", () => {

        card.classList.toggle("virado");

    });

});