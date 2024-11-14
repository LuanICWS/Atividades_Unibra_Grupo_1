let currentSlide = 0; // Inicializa o slide atual
const slides = document.querySelectorAll('.Carrossel_Item'); // Seleciona todas as imagens
const totalSlides = slides.length; // Conta o número total de slides

// Função para mover os slides
function moveSlide(step) {
    currentSlide += step; // Avança ou retrocede o slide

    // Se o slide passar do total, volta ao primeiro
    if (currentSlide >= totalSlides) {
        currentSlide = 0;
    } else if (currentSlide < 0) {
        currentSlide = totalSlides - 1; // Vai para o último slide se for para trás
    }

    // Muda a posição do carrossel
    const carrossel = document.querySelector('.Carrossel');
    carrossel.style.transform = `translateX(-${currentSlide * 100}%)`; // Move o carrossel para o slide correto
}