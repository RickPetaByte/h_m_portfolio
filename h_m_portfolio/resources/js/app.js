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

// -------------------- Create portfolio page (Portfolio selecter) -------------------- 

document.addEventListener('DOMContentLoaded', function () {
    const layoutImages = document.querySelectorAll('.img-container-four .imageCreate');
    const colorSections = {
        'dynamic-template-1': document.getElementById('portfolio-1-color-selection'),
        'dynamic-template-2': document.getElementById('portfolio-2-color-selection'),
        'dynamic-template-3': document.getElementById('portfolio-3-color-selection'),
        'dynamic-template-4': document.getElementById('portfolio-4-color-selection')
    };

    let selectedLayout = null; // Houd de geselecteerde lay-out bij
    let selectedColorImage = null; // Houd de geselecteerde kleurafbeelding bij

    layoutImages.forEach(function (image) {
        image.addEventListener('click', function () {
            // Deselecteer eerst alle lay-outafbeeldingen
            layoutImages.forEach(function (img) {
                img.classList.remove('clicked');
            });

            // Verwijder alle .clicked klassen van kleurafbeeldingen in alle secties
            Object.values(colorSections).forEach(function (section) {
                const colorImages = section.querySelectorAll('.img-container img');
                colorImages.forEach(function (img) {
                    img.classList.remove('clicked');
                });
            });

            // Selecteer de geklikte lay-outafbeelding en houd deze bij
            image.classList.add('clicked');
            selectedLayout = image.alt;

            // Verberg alle kleursecties
            Object.values(colorSections).forEach(function (section) {
                section.style.display = 'none';
            });

            // Toon de kleursectie voor de geselecteerde lay-out
            if (colorSections[selectedLayout]) {
                colorSections[selectedLayout].style.display = 'block';
            }

            // Update de hidden input met de geselecteerde layout
            document.getElementById('selected_layout').value = selectedLayout;
        });
    });

    // Voeg event listeners toe aan de kleurafbeeldingen om te voorkomen dat er meer dan één wordt geselecteerd
    Object.values(colorSections).forEach(function (section) {
        const colorImages = section.querySelectorAll('.img-container img');

        colorImages.forEach(function (colorImage) {
            colorImage.addEventListener('click', function () {
                // Deselecteer eerst alle kleurafbeeldingen in deze sectie
                colorImages.forEach(function (img) {
                    img.classList.remove('clicked');
                });

                // Selecteer de geklikte kleurafbeelding
                colorImage.classList.add('clicked');
                selectedColorImage = colorImage.alt;

                // Update de hidden input met de geselecteerde kleurafbeelding
                document.getElementById('selected_image').value = selectedColorImage;
            });
        });
    });
});