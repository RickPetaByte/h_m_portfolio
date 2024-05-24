import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Functie om het huidige thema op te slaan in localStorage
function saveThemePreference(theme) {
    localStorage.setItem('theme', theme);
}

// Functie om het opgeslagen thema te herstellen bij het laden van de pagina
function restoreThemePreference() {
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        document.body.classList.add('dark-theme');
        document.getElementById('icon').src = 'img/sun.png';
    } else {
        document.body.classList.remove('dark-theme');
        document.getElementById('icon').src = 'img/moon.png';
    }
}

// Event listener voor het wijzigen van het thema
document.getElementById('icon').onclick = function() {
    toggleTheme();
};

// Functie om het thema te wijzigen
function toggleTheme() {
    if (document.body.classList.contains('dark-theme')) {
        document.body.classList.remove('dark-theme');
        document.getElementById('icon').src = 'img/moon.png';
        saveThemePreference('light'); // Opslaan van themavoorkeur als licht
    } else {
        document.body.classList.add('dark-theme');
        document.getElementById('icon').src = 'img/sun.png';
        saveThemePreference('dark'); // Opslaan van themavoorkeur als donker
    }
}

// Herstel het thema bij het laden van de pagina
restoreThemePreference();

// Voorkom themawijziging bij klikken op login- en registerknoppen
document.querySelectorAll('.login-btn, .register-btn').forEach(function(button) {
    button.addEventListener('click', function(event) {
        event.preventDefault(); // Voorkom standaardgedrag van de link
        // Geef aan dat het thema niet gewijzigd moet worden
    });
});