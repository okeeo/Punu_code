// BOUTON PLUS MOINS//


const counters = document.querySelectorAll('.quantity-counter');

counters.forEach(counter => {
  const minusBtn = counter.querySelector('.minus');
  const plusBtn = counter.querySelector('.plus');
  const input = counter.querySelector('.quantity-input');

  // Gestion du bouton "moins"
  minusBtn.addEventListener('click', (event) => {
    event.preventDefault(); // Empêche le comportement par défaut
    let currentValue = parseInt(input.value) || 1;
    if (currentValue > parseInt(input.min || 1)) {
      input.value = currentValue - 1;
    }
  });

  // Gestion du bouton "plus"
  plusBtn.addEventListener('click', (event) => {
    event.preventDefault(); // Empêche le comportement par défaut
    let currentValue = parseInt(input.value) || 1;
    input.value = currentValue + 1;
  });

  // Optionnel : s'assurer que la valeur reste correcte après saisie manuelle
  input.addEventListener('input', () => {
    if (parseInt(input.value) < parseInt(input.min || 1)) {
      input.value = input.min || 1;
    }
  });
});



//TAB ITEM PAGE//

document.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelectorAll('.tab');
    const panes = document.querySelectorAll('.tab-pane');
  
    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        // Désactiver tous les onglets
        tabs.forEach(t => t.classList.remove('active'));
        panes.forEach(p => p.classList.remove('active'));
  
        // Activer l'onglet cliqué
        tab.classList.add('active');
        document.getElementById(tab.dataset.tab).classList.add('active');
      });
    });
  });
  

//curseur prix//


  const rangeInput = document.getElementById("price");
const rangeValue = document.getElementById("rangeValue");

rangeInput.addEventListener("input", function() {
    rangeValue.textContent =  rangeInput.value;
});



