<?php session_start(); ?>
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








    <?php if (isset($_SESSION['tid'])) {
        @$db = new mysqli('localhost', "root", "", "final year project");
        if (mysqli_connect_errno()) {
            echo 'Connection error: ' . $db->connect_errno;
            exit;
        }
        if (isset($_GET['orderid'])) {
            $fabricid = $_GET['orderid'];
            $queryss = "SELECT orderid, custname FROM custorder WHERE orderid=$fabricid";
            $stmtss = $db->prepare($queryss);
            $stmtss->execute();
            $stmtss->store_result();
            $stmtss->bind_result($oorderid, $ocustname);
            while ($stmtss->fetch()) {
                // echo $oorderid, $ocustname;
                $queryu = "SELECT id, name, dob FROM users WHERE name='$ocustname'";
                $stmtu = $db->prepare($queryu);
                $stmtu->execute();
                $stmtu->store_result();
                $stmtu->bind_result($cid, $cname, $cdob);
                while ($stmtu->fetch()) {
                    $dateOfBirth = $cdob;
                    // echo $cdob;
                    $today = date("Y-m-d");
                    $diff = date_diff(date_create($dateOfBirth), date_create($today));
                    $custager = $diff->format('%y');
                    $query = "UPDATE custorder SET custage=? WHERE orderid=$fabricid";
                    $stmt = $db->prepare($query);
                    $stmt->bind_param('s', $custager);
                    $stmt->execute();
                }
            }
        } ?>
        <div align="center" style="position: absolute; top: 17%; left: 31%;">
            <p style="font-size: 245%; padding-top: 80px; font-weight:900;">THANKS FOR CHOOSING US</p>
            <button style="border:1px solid rgb(12, 80, 88); background-color:rgb(12, 80, 88); font-size:25px; padding: 10px;"><a style="text-decoration: none; color:white;" href="profiletailor.php">Continue Shopping</a></button>
        </div>
    <?php
        $_SESSION = array();
        session_destroy();
    } else {
        echo "error has been occured";
        header("Location:homepro.html");
    } ?>







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