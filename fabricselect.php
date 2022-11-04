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

        .error {
            font-size: 130%;
            color: white;
            background-color: rgb(243 108 108);
        }

        .btn {
            margin: 23px auto;
            width: 64%;
            display: block;
            font-size: 136%;
            border-radius: 8px;
            padding: 2%;
            background: #0c4c4b;
            color: white;
        }

        .btn:hover {
            background-color: #1eb1ae;
        }

        .container {
            /* border: 1px solid white; */
            margin: auto;
            padding: 8px 54px;
            width: 40%;
            padding-bottom: 36px;
            /* border-radius: 27px; */
        }

        .form {
            text-align: center;
        }

        .form label {

            font-size: 140%;
        }

        .form input {
            text-align: center;
            width: 57%;
            margin: 2% 13%;
            padding: 1% 6%;
            border: 2px solid black;
            font-size: 20px;
            border-radius: 8px;
        }

        .form select {
            text-align: center;
            width: 69%;
            margin: 2% 13%;
            padding: 1% 6%;
            border: 2px solid black;
            font-size: 20px;
            border-radius: 8px;
        }

        .container h1 {
            font-size: 400%;
            text-align: center;
            margin-bottom: 27px;
            padding: 1px 47px;
        }

        .container h2 {
            text-align: center;
            margin-bottom: 10%;
            padding: 1%;
            margin-top: 8%;
            z-index: -1;
        }

        hr {
            border: 2px solid black;
            position: absolute;
            top: 58%;
            width: 18%;
            /* left: 32.3%; */
        }

        .firsthr {
            /* top: 61%; */
            right: 51%
        }

        .secondhr {
            /* top: 61%; */
            right: 30.8%;
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









    <?php
    if (isset($_POST["submitf"])) {
        processForm();
    } else if (isset($_POST['submitwf'])) {
        secondfunction();
    } else {
        displayForm(array(), array());
    }


    function setValue($fieldName)
    {
        if (isset($_POST[$fieldName])) {
            echo $_POST[$fieldName];
        }
    }
    function setSelected($fieldName, $fieldValue)
    {
        if (isset($_POST[$fieldName]) and $_POST[$fieldName] == $fieldValue) {
            echo ' selected="selected"';
        }
    }

    function validateField($fieldName, $missingFields)
    {
        if (in_array($fieldName, $missingFields)) {
            echo ' class="error"';
        }
    }
    function validate($fieldName, $missing)
    {
        if (in_array($fieldName, $missing)) {
            echo ' class="error"';
        }
    }
    function processForm()
    {
        $requiredFields = array("fabricft", "meter");
        $missingFields = array();
        foreach ($requiredFields as $requiredField) {
            if (!isset($_POST[$requiredField]) or !$_POST[$requiredField]) {
                $missingFields[] = $requiredField;
            }
        }
        if ($missingFields) {
            displayForm($missingFields, array());
        } else {
            @$db = new mysqli('localhost', "root", "", "final year project");
            if (mysqli_connect_errno()) {
                echo 'Connection error: ' . $db->connect_errno;
                exit;
            }
            $query = "INSERT INTO custorder (custgender, orderdeliverystatus, tfabricname, fmeter, typeoforder, measurementid) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($query);
            $stmt->bind_param('ssssss', $_SESSION["custgenderorder"], $_POST['tailorstart'], $_POST['fabricft'], $_POST["meter"], $_POST["bytail"], $_SESSION["measurementidcust"]);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                // echo "get successfully by tailor";
                $last_id = $db->insert_id;
                // echo "New record created successfully. Last inserted ID is: " . $last_id;
                // header('Location: proceed.php?fabricid=' . $last_id);
                echo("<script>location.href = 'proceed.php?fabricid=$last_id';</script>");
            } else {
                echo "<p>An error has occurred.<br/> The item was not added.</p>";
            }
        }
    }
    function secondfunction()
    {
        $required = array("yfabricd");
        $missing = array();
        foreach ($required as $requiredField) {
            if (!isset($_POST[$requiredField]) or !$_POST[$requiredField]) {
                $missing[] = $requiredField;
            }
        }
        if ($missing) {
            displayForm(array(), $missing);
        } else {
            @$db = new mysqli('localhost', "root", "", "final year project");
            if (mysqli_connect_errno()) {
                echo 'Connection error: ' . $db->connect_errno;
                exit;
            }
            $query = "INSERT INTO custorder (custgender,orderdeliverystatus, cfabricdet, typeoforder, measurementid) VALUES (?, ?, ?, ?,?)";
            $stmt = $db->prepare($query);
            $stmt->bind_param('sssss', $_SESSION["custgenderorder"], $_POST['customerstart'], $_POST["yfabricd"], $_POST["bycust"], $_SESSION["measurementidcust"]);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                // echo "get successfully by customer";
                $last_id = $db->insert_id;
                // echo "New record created successfully. Last inserted ID is: " . $last_id;
                // header('Location: proceed.php?fabricid=' . $last_id);
                echo("<script>location.href = 'proceed.php?fabricid=$last_id';</script>");
            } else {
                echo "<p>An error has occurred.<br/> The item was not added.</p>";
            }
        }
    }
    function displayForm($missingFields, $missing)
    { ?>
        <div class="container">
            <h1>Fabric Details</h1>
            <?php if ($missingFields or $missing) { ?>
                <p class="error">FILLING THE HIGHLIGHTED FIELDS FOR FABRIC IS COMPULSORY</p>
            <?php } ?>
            <form action="fabricselect.php" method="post">
                <div class="form">
                    <!-- <label for="fabricft">Select Fabric Name For Tailor To Use</label> -->
                    <select name="fabricft" id="fabricft" <?php validateField("fabricft", $missingFields) ?>>
                        <option value="" disabled selected>Select Fabric Name For Tailor To Use</option>
                        <option value="Cotton" <?php setSelected("fabricft", "Cotton") ?>>Cotton</option>
                        <option value="Silk" <?php setSelected("fabricft", "Silk") ?>>Silk</option>
                        <option value="Chiffon" <?php setSelected("fabricft", "Chiffon") ?>>Chiffon</option>
                        <option value="Linen" <?php setSelected("fabricft", "Linen") ?>>Linen</option>
                        <option value="Velvet" <?php setSelected("fabricft", "Velvet") ?>>Velvet</option>
                        <option value="Wool" <?php setSelected("fabricft", "Wool") ?>>Wool</option>
                        <option value="Muslin" <?php setSelected("fabricft", "Muslin") ?>>Muslin</option>
                        <option value="Lawn" <?php setSelected("fabricft", "lawn") ?>>Lawn</option>
                        <option value="Flannel" <?php setSelected("fabricft", "Flannel") ?>>Flannel</option>
                        <option value="Satin" <?php setSelected("fabricft", "Satin") ?>>Satin</option>
                    </select>
                    <input type="number" min="0" step="0.1" name="meter" id="meter" <?php validateField("meter", $missingFields) ?> placeholder="How Many Meters of Fabric" value="<?php setValue("meter"); ?>">
                </div>
                <input type="hidden" name="bytail" value="bytailor">
                <input type="hidden" name="tailorstart" value="tailorst">
                <div align="center">
                    <input class="btn" type="submit" name="submitf" value="FABRIC SELECTED">
                </div>
            </form>
            <hr class="firsthr">
            <h2>or</h2>
            <hr class="secondhr">
            <h3 align="center" style="font-size: 160%;">DELIVER YOUR OWN FABRIC TO THE TAILOR</h3>
            <form action="fabricselect.php" method="post">
                <div class="form">
                    <input type="text" name="yfabricd" id="yfabricd" <?php validate("yfabricd", $missing) ?> placeholder="Enter your Fabric Details " value="<?php setValue("yfabricd"); ?>">
                </div>
                <input type="hidden" name="bycust" value="bycustomer">
                <input type="hidden" name="customerstart" value="customerst">
                <div align="center">
                    <!-- <a href="proceed.php" style="text-decoration: none;"> -->
                    <input class="btn" type="submit" name="submitwf" value="DELIVER YOUR OWN FABRIC">
                    <!-- </a> -->
                </div>
            </form>
        </div>
    <?php
    }
    ?>






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
    </div>

    <script src="extra.js"></script> -->
</body>

</html>