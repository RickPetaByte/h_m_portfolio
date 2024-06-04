import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// -------------------- Black / White Theme --------------------

// Functie om het huidige thema op te slaan in localStorage
function saveThemePreference(theme) {
    localStorage.setItem('theme', theme);
}

// Functie om het opgeslagen thema te herstellen bij het laden van de pagina
function restoreThemePreference() {
    const savedTheme = localStorage.getItem('theme');
    const iconElement = document.querySelector('.icon');
    const logoElement = document.getElementById('logo');
    const footerLogoElement = document.getElementById('footer-logo'); // Voeg deze regel toe

    if (savedTheme === 'dark') {
        document.body.classList.add('dark-theme');
        iconElement.src = 'img/sun.png';
        logoElement.src = 'img/LogoCircleWhite.png';
        footerLogoElement.src = 'img/LogoCircleWhite.png'; // Voeg deze regel toe
    } else {
        document.body.classList.remove('dark-theme');
        iconElement.src = 'img/moon.png';
        logoElement.src = 'img/LogoCircle.png';
        footerLogoElement.src = 'img/LogoCircle.png'; // Voeg deze regel toe
    }
}

// Event listener voor het wijzigen van het thema
document.querySelector('.icon').onclick = function() {
    // Voeg de transitieklasse toe bij klikken
    document.body.classList.add('theme-transition');
    
    // Thema wisselen
    toggleTheme();
    
    // Verwijder de transitieklasse na de transitie
    setTimeout(() => {
        document.body.classList.remove('theme-transition');
    }, 500); // Tijd moet overeenkomen met de CSS transitie tijd

    console.log("Dit werkt");
};

// Functie om het thema te wijzigen
function toggleTheme() {
    const iconElement = document.querySelector('.icon');
    const logoElement = document.getElementById('logo');
    const footerLogoElement = document.getElementById('footer-logo'); // Voeg deze regel toe

    if (document.body.classList.contains('dark-theme')) {
        document.body.classList.remove('dark-theme');
        iconElement.src = 'img/moon.png';
        logoElement.src = 'img/LogoCircle.png';
        footerLogoElement.src = 'img/LogoCircle.png'; // Voeg deze regel toe
        saveThemePreference('light'); // Opslaan van themavoorkeur als licht
    } else {
        document.body.classList.add('dark-theme');
        iconElement.src = 'img/sun.png';
        logoElement.src = 'img/LogoCircleWhite.png';
        footerLogoElement.src = 'img/LogoCircleWhite.png'; // Voeg deze regel toe
        saveThemePreference('dark'); // Opslaan van themavoorkeur als donker
    }
}

// Herstel het thema bij het laden van de pagina zonder transitie
restoreThemePreference();

// Voorkom themawijziging bij klikken op login- en registerknoppen
document.querySelectorAll('.login-btn, .register-btn').forEach(function(button) {
    button.addEventListener('click', function(event) {
        event.preventDefault(); // Voorkom standaardgedrag van de link
        // Geef aan dat het thema niet gewijzigd moet worden
    });
});

// -------------------- Black / White Theme --------------------