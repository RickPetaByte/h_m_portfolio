<footer class="container-fluid pt-5 pb-5 footer-boxshadow colorSecond">
    <div class="container">
        <div class="row g-5">
            <!-- Logo en Links -->
            <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2 d-flex justify-content-center flex-row align-items-center align-items-md-center align-items-lg-end align-items-xl-start align-items-xxl-center">
                <img id="footer-logo" src="{{ asset('img/LogoCircle.png') }}" alt="Logo">
                
            </div>
            <!-- Contactinformatie -->
            <div class="col-sm-12 col-md-10 col-lg-10 col-xl-6 d-flex flex-row align-items-center remove-flex-responsive">
                <div class="d-flex w-100 remove-flex-responsive">
                    <div class="d-flex flex-column w-50">
                        <a href="{{ route('about') }}" class="fw-bold">
                            <i class="fa-solid fa-bars iconNavBar iconNavBarColor"></i> About
                        </a>
                        <a href="{{ route('contact.show') }}" class="fw-bold">
                            <i class="fa-solid fa-phone iconNavBar iconNavBarColor"></i> Contact
                        </a>
                    </div>
                    
                    <div class="d-flex align-items-center mb-3 mb-md-0 w-100 justify-content-center m-sm-0 m-0">
                        <i class="fa fa-envelope iconFooter m-3"></i>
                        <div>
                            <span>80925@roc-teraa.nl</span>
                            <br>
                            <span>89153@roc-teraan.nl</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center w-100 justify-content-center">
                        <i class="fab fa-linkedin iconFooter m-3"></i>
                        <div>
                            <a href="https://www.linkedin.com/in/rick-maas-software-developer/" target="_blank" class="hover:text-gray-300">Rick Maas</a>
                            <br>
                            <a href="https://www.linkedin.com/in/jur-heusschen/" target="_blank" class="hover:text-gray-300">Jur Heusschen</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Over deze website -->
            <div class="col-md-11 col-lg-11 col-xl-11 col-xxl-4 mx-auto">
                
                <span>Over deze website:</span>
                <br class="mb-2">
                <strong>H:M Portfolios</strong> is een website waar je gemakkelijk een goed portfolio kunt maken. Je kunt ook het portfolio bewerken, zoals kleuren, tekst en meer wijzigen. Je kunt ook portfoliowebsites van anderen bekijken.
                
            </div>
        </div>
        <!-- Footer Opmerking -->
        <div class="row mt-5">
            <div class="col-12 text-center">
                <p class="footer-company-name">© 2024 H:M Portfolio's. Alle rechten voorbehouden.</p>
            </div>
        </div>
    </div>
</footer>