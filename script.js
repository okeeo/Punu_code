document.addEventListener('DOMContentLoaded', function() {
    const menuButton = document.querySelector('.boutton-menu'); // Le bouton "Menu"
    const menu = document.getElementById('menu'); // Le menu principal
    const submenuItems = document.querySelectorAll('.menu > li'); // Les éléments de menu
    const arrows = document.querySelectorAll('.menu > li > i'); // Les icônes de flèches
    const overlay = document.querySelector('.overlay'); // L'overlay

    // Gestion du clic sur le mot "Menu" pour afficher/masquer le menu principal
    menuButton.addEventListener('click', function() {
        menu.classList.toggle('visible'); // Ajoute ou retire la classe "visible" pour afficher/masquer le menu
        document.documentElement.classList.toggle('menu-open'); // Ajoute ou retire la classe "menu-open" sur <html> et <body> pour empêcher le défilement de la page
        overlay.classList.toggle('visible'); // Affiche ou masque l'overlay
    });

    // Gestion du clic sur l'icône de la flèche pour afficher/masquer le sous-menu
    arrows.forEach(function(arrow) {
        arrow.addEventListener('click', function(e) {
            e.stopPropagation(); // Empêche la propagation de l'événement pour éviter que le menu se ferme immédiatement

            const parentItem = arrow.closest('li'); // Trouve l'élément parent (li) de la flèche
            const submenu = parentItem.querySelector('.submenu'); // Récupère le sous-menu associé

            if (submenu) {
                submenu.classList.toggle('visible'); // Affiche ou cache le sous-menu
                arrow.classList.toggle('rotate'); // Fait pivoter la flèche

                // Ajoute la classe menu-actif sur l'élément parent
                parentItem.classList.toggle('menu-actif');

                // Ferme les autres sous-menus et retire la classe menu-actif
                submenuItems.forEach(function(otherItem) {
                    if (otherItem !== parentItem) {
                        const otherSubmenu = otherItem.querySelector('.submenu');
                        const otherArrow = otherItem.querySelector('i');
                        if (otherSubmenu) {
                            otherSubmenu.classList.remove('visible');
                            otherArrow.classList.remove('rotate');
                            otherItem.classList.remove('menu-actif'); // Retire la classe menu-actif des autres éléments
                        }
                    }
                });
            }
        });
    });

    // Optionnel : fermer le menu principal si vous cliquez ailleurs sur la page
    document.addEventListener('click', function(e) {
        if (!menu.contains(e.target) && !menuButton.contains(e.target)) {
            menu.classList.remove('visible');
            document.documentElement.classList.remove('menu-open'); // Restaure le défilement lorsque le menu est fermé
            overlay.classList.remove('visible'); // Masque l'overlay
        }
    });

    // Empêche le clic sur l'overlay de fermer le menu
    overlay.addEventListener('click', function(e) {
        e.stopPropagation();
    });
});


$(document).ready(function() {
    $('.quote-slider').slick({
        autoplay: true,         // Active la lecture automatique
        autoplaySpeed: 3500,    // Change toutes les 5 secondes
        arrows: false,          // Supprime les flèches de navigation
        dots: true,             // Ajoute des points pour naviguer           
        speed: 1000,            // Durée de la transition (en millisecondes)
        infinite: true          // Assure une boucle infinie
    });
});
