// Liste des images à afficher
const images = [
    "Assets/Images/acceuil-image.jpg",
    "Assets/Images/TableChaise.jpg",   // Remplacez par vos images
    "Assets/Images/eau_fond_blanc.jpg"
];

// Sélectionner la section et l'élément image-container
const sectionAccueil = document.querySelector('.accueil');
const imageContainer = document.querySelector('.image-container');

// Sélectionner les boutons de navigation
const prevButton = document.getElementById('prev');
const nextButton = document.getElementById('next');

// Variable pour suivre l'image actuelle
let currentIndex = 0;

// Fonction pour mettre à jour l'image de fond
function updateBackgroundImage() {
    imageContainer.style.backgroundImage = `url(${images[currentIndex]})`;
    imageContainer.style.transform = "translateX(100%)"; // Déplace l'image à droite
    setTimeout(() => {
        imageContainer.style.transition = 'transform 2s ease-in-out'; // Assurez-vous que la transition dure 1 seconde
        imageContainer.style.transform = "translateX(0)"; // Déplace l'image à sa position d'origine
    }, 100); // Le délai de 100ms permet à l'animation de démarrer après le changement d'image
}

// Événement pour le bouton "Prev"
prevButton.addEventListener('click', function() {
    currentIndex = (currentIndex - 1 + images.length) % images.length; // Décrémenter l'index et revenir au début si nécessaire
    updateBackgroundImage();
});

// Événement pour le bouton "Next"
nextButton.addEventListener('click', function() {
    currentIndex = (currentIndex + 1) % images.length; // Incrémenter l'index et revenir à la première image si nécessaire
    updateBackgroundImage();
});

// Initialiser avec la première image
updateBackgroundImage();
