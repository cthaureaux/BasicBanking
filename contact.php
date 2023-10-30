<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <title>Contact Us</title>
    <style>
        body {
          background-image: url(images/laptop3.jpg);
          background-size: cover;
          background-position: center;
        }
        .center {
            display: inline;
            text-align: center;
            
        }
        .hover-container {
          transition: all 0.6s ease;
        }
        
        .hover-container:hover {
          transform: scale(1.1);
          
        }
    </style>
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container mt-5 hover-container" style="background-color: #FBFAF5; width: 500px; box-shadow: 0 3px 10px 5px rgba(0, 0, 0, .50);">
        <div class="row center">
            <h2 class = "mt-3 mb-3">Contact Us</h2>
            <p>If you have any questions or concerns regarding our banking services, we're here to help. You can contact us via phone or email. Our customer support team is available 24/7 to assist you!</p>
        </div>
        <div class="row center">
            <div class="mr-2">
                <i class="fas fa-envelope"></i> Email: <a href="mailto:admin@bank.com">Basic Bank</a>
            </div>
        </div>
        <div class="row center">
            <div class="mr-2">
                <i class="fas fa-phone"></i> Tel: <a href="tel:555-666-7777">555-666-7777</a>
            </div>
        </div>
        <div class="row center">
            <div class="mr-2">
                <i class="fas fa-user"></i> Contact Us: <a href="mailto:chaletj1@montclair.edu">Joe</a>
            </div>
        </div>
        <div class="row center">
            <div class="mr-2">
                <i class="fas fa-user"></i> Contact Us: <a href="mailto:ihekwabac1@montclair.edu">Cassie</a>
            </div>
        </div>
        <div class="row center">
            <div class="mr-2">
                <i class="fas fa-user"></i> Contact Us: <a href="mailto:thaureauxc1@montclair.edu">Catherine</a>
            </div>
        </div>
        <div class="row center">
            <div class="mr-2">
                <i class="fas fa-user"></i> Contact Us: <a href="mailto:rojasc8@montclair.edu">Chris</a>
            </div>
        </div>
        <div class="row center">
            <div class="mr-2">
                <i class="fas fa-user"></i> Contact Us: <a href="mailto:kruegelj1@montclair.edu">Jared</a>
            </div>
        </div>
    </div>
</body>
<?php
    include 'footer.html';
?>
</html>