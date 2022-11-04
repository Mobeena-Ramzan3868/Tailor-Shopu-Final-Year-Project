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

        h1 {
            text-align: center;
            font-size: 200%;
            margin-top: 2%;
        }

        button {
            margin: 3% auto;
            width: 23%;
            display: block;
            font-size: 140%;
            border-radius: 8px;
            padding: 1%;
            background: #0c4c4b;
            border: 1px solid #0c4c4b;
            color: white;
        }
        a{
            text-decoration: none;
            color: white;
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
                <!-- <button name="Go" placeholder="Go..." class="go">Go</button> -->
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










    <div style="padding:1% 0% ;"></div>
    <?php
    // session_start();
    // session_destroy();
    $db = new mysqli('localhost', 'root', '', 'final year project');
    if (mysqli_connect_errno()) {
        echo 'connection error: ' . $db->connect_errno;
        exit;
    }
    $custid = $_GET['custid'];
    $query = "SELECT id, name, phone, password, email, dob FROM users WHERE id=?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('s', $custid);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($cid, $cname, $cphone, $cpassword, $cemail, $cdob);
    $tempcont = "no";

    $btnbtn = 0;
    while ($stmt->fetch()) {
        // echo $cid, $cname, $cphone, $cpassword, $cemail, $cdob;
        $query1 = "SELECT orderid, tailorname, custname, status, phone, totalprice, email, country, province, city, postal, address, additonal, custage, custgender, dateoforder, timeoforder, daysoforder, deliveryboyid, orderdeliverystatus, typeoforder, rating, feedback FROM custorder WHERE custname='$cname'";
        $stmto = $db->prepare($query1);
        $stmto->execute();
        $stmto->store_result();
        $stmto->bind_result($orderid, $tailorname, $custname, $status, $phone, $totalprice, $email, $country, $province, $city, $postal, $address, $additonal, $custage, $custgender, $dateoforder, $timeoforder, $daysoforder, $deliveryboyid, $orderdeliverystatus, $typeoforder, $rating, $feedback);
        while ($stmto->fetch()) {
            if ($status == 'reject') {
                $tempcont = "yes";
                echo "<h1>Your order with <br> Tailor: " . $tailorname . "<br> got rejected</h1>";
            }
            if ($status == 'accept') {
                $tempcont = "acc";
                echo "<h1>Your order with <br> Tailor: " . $tailorname . "<br> got Accepted</h1>"; ?>
                <h1>Price offered by tailor is: <?php echo $totalprice ?></h1>
                <h1>days take to complete the order: <?php echo $daysoforder ?></h1>
                <button><a href="cancelorderbycust.php?orderid=<?php echo $orderid;?>&custid=<?php echo $custid?>">Cancel Order</a></button>
                <?php
            }
            if ($status == 'no') {
                $tempcont = "no";
                echo "<h1>Your order with <br> Tailor: " . $tailorname . "<br> still pending</h1>";
                echo '<button><a href="cancelorderbycust.php?orderid='.$orderid.'&custid='.$custid.'">Cancel Order</a></button>';
            }
        }
        $stmts = $db->prepare($query1);
        $stmts->execute();
        $stmts->store_result();
        $stmts->bind_result($orderid, $tailorname, $custname, $status, $phone, $totalprice, $email, $country, $province, $city, $postal, $address, $additonal, $custage, $custgender, $dateoforder, $timeoforder, $daysoforder, $deliveryboyid, $orderdeliverystatus, $typeoforder, $rating, $feedback);
        while ($stmts->fetch()) {
            if ($orderdeliverystatus == 'custend') {
                if (($rating == "") and ($feedback == "")) {
                    // header("Location:rating.php?tailorname=" . $tailorname . "&custid=" . $cid . "&orderid=" . $orderid);
                    if ($tempcont == 'yes') { ?>
                        <a href="rating.php?tailorname=<?php echo $tailorname ?>&custid=<?php echo $cid ?>&orderid=<?php echo $orderid ?>" style="text-decoration: none;"><button>Continue</button></a>;
                    <?php
                    } else {
                        header("Location:rating.php?tailorname=".$tailorname."&custid=".$cid."&orderid=".$orderid);
                    }
                }
            } else {
                if ($btnbtn == 0) { ?>
                    <a href="profiletailor.php" style="text-decoration: none;"><button>Continue Shopping</button></a>
    <?php $btnbtn = 1;
                }
            }
        }
    }
    ?>
    <!-- <a href="profiletailor.php"><button>Continue Shopping</button></a> -->







    <!-- 
    <div class="scroll" id="scroll">
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