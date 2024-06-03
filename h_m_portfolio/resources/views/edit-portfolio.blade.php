<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Next Page</title>
</head>
<body>
    <!-- Gebruik de opgeslagen afbeeldinggegevens om de juiste afbeelding weer te geven -->
    @if(session('selectedImage'))
        <?php $selectedImage = session('selectedImage'); ?>
        <!-- Opbouwen van het absoluut bestandspad naar de afbeelding op basis van de geselecteerde waarden -->
        <?php 
            $templateNumber = $selectedImage['template']; // Template nummer
            $colorCode = $selectedImage['color']; // Kleurcode
            
            // Opbouwen van het absoluut bestandspad
            $imagePath = asset("img/portfolios/portfolio-{$templateNumber}/Empty/Empty{$colorCode}.png");
        ?>
        <!-- Gebruik het dynamisch opgebouwde pad om de afbeelding weer te geven -->
        <img src="{{ $imagePath }}" alt="Selected Portfolio">
    @else
        <p>No image selected.</p>
    @endif
</body>
</html>
