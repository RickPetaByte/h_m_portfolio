<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Page</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background-color: #4682B4; 
            width: 126mm; 
            height: 178.2mm; 
            max-width: 100vw; 
            max-height: 100vh; 
            box-sizing: border-box; 
        }
    </style>
</head>
<body>
    <div class="container">

    </div>
</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Page</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background-color: #fff;
        }
        .container {
            position: relative;
            background-color: #fff; 
            width: 126mm; 
            height: 178.2mm; 
            max-width: 100vw; 
            max-height: 100vh; 
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .left-section, .right-section {
            position: absolute;
            top: 0;
            bottom: 0;
        }
        .left-section {
            background-color: #333;
            color: #fff;
            width: 50%;
            left: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 20px;
            box-sizing: border-box;
        }
        .left-section img {
            width: 100%; 
            height: auto;
            border: 3px solid #fff; 
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .left-section .title {
            font-size: 24px;
            font-weight: bold;
            margin: 50px 0 5px 0;
        }
        .left-section .subtitle {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .right-section {
            background-color: #fff;
            color: #000;
            width: 50%;
            transform: skewX(-20deg);
            right: -10%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 20px;
            box-sizing: border-box;
        }
        .right-section .content {
            transform: skewX(20deg);
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }
        .text-about {
            font-size: 14px;
            margin-bottom: 20px;
        }
        .specialties {
            margin-top: auto;
        }
        .specialties h3 {
            font-size: 16px;
            margin-bottom: 10px;
        }
        .specialties ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .specialties ul li {
            font-size: 14px;
        }
        .name {
            margin-top: auto;
            font-size: 18px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-section">
            <img src="img/Standaard.png" alt="Profile Image">
            <div class="title">TITLE</div>
            <div class="subtitle">SUBTITLE</div>
        </div>
        <div class="right-section">
            <div class="content">
                <div class="text-about">
                    Text about yourself<br>
                    ------------- ---- ------- ------<br>
                    -- -- ---- --- -------- -- -- ----<br>
                    -- ------- ----- --- --- ----
                </div>
                <div class="specialties">
                    <h3>SPECIALTIES</h3>
                    <ul>
                        <li>One</li>
                        <li>Two</li>
                        <li>Three</li>
                        <li>Four</li>
                        <li>Four</li>
                        <li>Six</li>
                    </ul>
                </div>
                <div class="name">Name</div>
            </div>
        </div>
    </div>
</body>
</html>