$(document).ready(function() {
    $('.your-slider-class').slick({
        slidesToShow: 1,          // Nombre d'images visibles
        slidesToScroll: 1,        // Nombre d'images à faire défiler
        infinite: true,           // Activer le défilement infini
        arrows: true,             // Afficher les flèches de navigation
        prevArrow: $('.prev'),    // Flèche précédente personnalisée
        nextArrow: $('.next'),    // Flèche suivante personnalisée
        autoplay: true,           // Activer le défilement automatique
        autoplaySpeed: 3000,      // Temps entre chaque défilement (ms)
    });
  });
  