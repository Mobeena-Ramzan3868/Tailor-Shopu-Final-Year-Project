<?php session_start();
// echo "next";
$_SESSION['tid'];
$_SESSION['custname'];
$_SESSION['cid'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Andada+Pro&display=swap" rel="stylesheet">
    <title>Tailor Shopu</title>
    <script src="https://kit.fontawesome.com/afd6aa68df.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Andada+Pro:ital,wght@1,700&display=swap');
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Slabo+27px&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="extra.css">
    <style>
        body {
            font-family: 'Andada Pro', serif;
        }

        .container {
            margin: 0% 10%;
            padding: 3% 6%;
            padding-bottom: 1%;
            width: 35%;
            text-align: center;
        }

        a {
            text-decoration: none;
        }

        .container button {
            margin: 0% auto;
            width: 84%;
            display: block;
            font-size: 160%;
            border-radius: 8px;
            padding: 4%;
            background: #0c4c4b;
            color: white;
            border: none;
        }

        p {
            font-size: 190%;
            margin-left: 16%;
        }

        img {
            float: right;
            margin: 3% 5%;
            padding: 2% 1%;
            margin-top: 0%;
            display: inline;
        }

        h1 {
            font-size: 382%;
            margin: 10% 1%;
            margin-top: 0%;
        }

        hr {
            margin: 0% auto;
            margin-bottom: 2%;
            margin-left: 16%;
            display: block;
            width: 33%;
            border: 1px solid;
        }

        .btn {
            margin: 2% auto;
            margin-left: 18%;
            width: 29%;
            display: block;
            font-size: 160%;
            border-radius: 8px;
            padding: 1.5%;
            background: #0c4c4b;
            border: none;
            color: white
        }
    </style>
</head>

<body>
    <div class="nav-bar" id="navbar" style="display: none;">
        <div class="slide-in">
            <button id="scrolltoleft" onclick="leftFunction()"><img src="left-chevron.png"></button>
        </div>
        <a class="logo" href="homepro.html"><img id="limg" src="logos.png" alt="logo"></a>
        <div class="main-menu">
            <ul>
                <li><a href="homepro.html">Home</a></li>
                <li><a href="profiletailor.php">Tailor</a></li>
                <li><a href="termsandconditions.html">Policies</a></li>
                <li><a href="faqs.php">FAQs</a></li>
            </ul>
        </div>
        <div class="acc">
            <i id="accs" class="fas fa-user-circle"></i>
            <script>
                document.getElementById('accs').onclick = function() {
                    location.href = 'loginform.php';
                };
            </script>
        </div>
        <div class="search-button">
            <form action="searchprofile.php" method="POST">
                <input type="text" name="search" placeholder=" Search Here....." class="Search">
                <input type="submit" name="Go" value="Go..." class="go">
                <i class="fas fa-search"></i>
            </form>
        </div>
        <div class="copyright">
            <b> TailorShopu.pk - &copy; 2022 -All Rights Reserved</b>
        </div>
    </div>
    <div class="Closenavbar" id="Closenavbar">
        <div class="close">
            <button id="Close" onclick="closeFunction()"><img id="imgclose" src="right-chevron.png"></button>
        </div>
        <div class="close-menu">
            <ul>
                <li><a href="homepro.html"><i class="fa fa-home"></i></a> <span class="tooltip">Home</span></li>
                <li><a href="profiletailor.php"><i class="fa fa-book"></i></a><span class="tooltip">Tailors</span></li>
                <li><a href="termsandconditions.html"><i class="fa fa-edit"></i></a><span class="tooltip">Polices</span></li>
                <li><a href="faqs.php"><i class="fa fa-info"></i></a><span class="tooltip">FAQs</span></li>
            </ul>
        </div>
    </div>








    <img src="foampic.png" alt="" width="600" height="600">
    <div class="container">
        <h1>Fashion Design: <br> Tool for clothing design</h1>
        <a href="pencil/set2/newatempt.php"><button>Design your Own Dress</button></a>
    </div>
    <div style="text-align: center; display: block; margin: 4% auto;">
        <hr>
        <p>OR</p>
        <a href="measurementprevious.html"><button class="btn">Proceed to CheckOut</button></a>
    </div>






    <!-- <div class="scroll" id="scroll">
        <button id="scrolltotop" onclick="topFunction()"><img src="up-chevron.png"></button>
    </div>
    <div class="footer" id="footer">
        <div class="Des">
            <h3>About Website</h3>
            <p>
                TailorShopu is a young, professional and state of the art online tailoring factory that aims at by designing your own dress, providing an unparalleled and hassle free tailoring experience to the customers at affordable prices with free pickup and delivery
                services.
            </p>
        </div>
        <div class="follow">
            <h3>Follow Us</h3>
            <i class="fab fa-facebook"></i> Facebook<br>
            <i class="fab fa-instagram"></i> Instagram<br>
            <i class="fab fa-twitter"></i> Twitter
        </div>
        <div class="contact">
            <h3>Contact Us</h3>
            <p>184 Main Rd, Isl, Pakistan</p>
            <p>Call: (+92)012345678</p>
            <p>Email: TailorShopu@.com</p>
        </div>
    </div> -->

    <script src="extra.js"></script>
</body>

</html>