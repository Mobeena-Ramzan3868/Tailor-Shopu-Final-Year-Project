<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ PAGE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Andada+Pro&display=swap" rel="stylesheet">
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

        .wall {
            height: 615px;
        }

        .wall img {
            position: absolute;
            left: 8%;
            top: 8%;
            width: 88%;
            height: 64%;
            opacity: 55%;
        }

        .imgheading {
            position: absolute;
            text-align: center;
            left: 19%;
            top: 36%;
            letter-spacing: .05em;
            font-size: 340%;
        }

        .faq-container {
            display: flex;
            justify-content: center;
            flex-direction: column;
            margin-bottom: 5%
        }

        .error {
            width: 44%;
            margin-left: 28%;
            text-align: center;
            font-size: 130%;
            color: white;
            background-color: rgb(243 108 108);
        }

        .container {
            margin: 1% 10%;
    width: 80%;
    padding-bottom: 5%;
        }

        .form input {
            text-align: center;
            display: block;
            width: 40%;
            margin: 11px auto;
            padding: 11px 18px;
            border: 2px solid black;
            font-size: 20px;
            border-radius: 8px;
        }
        .form textarea {
            text-align: center;
            display: block;
            width: 40%;
            margin: 11px auto;
            padding: 11px 18px;
            border: 2px solid black;
            font-size: 20px;
            border-radius: 8px;
        }

        .submit {
            margin: 4% auto;
            width: 42%;
            display: block;
            font-size: 136%;
            border-radius: 8px;
            padding: 1%;
            background: #0c4c4b;
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









    <div class="wall">
        <img src="faqimg.jpg" alt="wallpaper">
        <div class="imgheading">
            <p>FREQUENTLY ASKED QUESTIONS</p>
        </div>
    </div>
    <?php
    if (isset($_POST["submit"])) {
        processForm();
    } else {
        displayForm(array());
    }

    function setValue($fieldName)
    {
        if (isset($_POST[$fieldName])) {
            echo $_POST[$fieldName];
        }
    }

    function validateField($fieldName, $missingFields)
    {
        if (in_array($fieldName, $missingFields)) {
            echo ' class="error"';
        }
    }

    function processForm()
    {
        $requiredFields = array("fquestion", "fanswer");
        $missingFields = array();
        $wrongfield = false;

        foreach ($requiredFields as $requiredField) {
            if (!isset($_POST[$requiredField]) or !$_POST[$requiredField]) {
                $missingFields[] = $requiredField;
            }
        }

        if ($missingFields) {
            displayForm($missingFields, $wrongfield);
        } else {
            @$db = new mysqli('localhost', "root", "", "final year project");
            if (mysqli_connect_errno()) {
                echo 'Connection error: ' . $db->connect_errno;
                exit;
            }
            $query = "INSERT INTO faq (fquestion, fanswer) VALUES (?, ?)";
            $stmt = $db->prepare($query);
            $stmt->bind_param('ss', $_POST["fquestion"], $_POST["fanswer"]);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                echo "<script>window.location.href='faqsdelete.php';</script>";
                exit;
                // header('Location: faqsdelete.php');
            } else {
                echo "<p>An error has occurred.<br/> The item was not added.</p>";
            }
        }
    }


    function displayForm($missingFields)
    { ?>
        <div class="container">
            <form action="faqsadding.php" method="post">
                <?php if ($missingFields) { ?>
                    <p class="error">FILLING IN ALL FIELDS ARE MANDATORY</p>
                <?php } ?>
                <div class="form">
                    <input type="text" name="fquestion" id="" placeholder="Enter your FAQ question" <?php validateField("fquestion", $missingFields) ?> value="<?php setValue("fquestion"); ?>">
                </div>
                <div class="form">
                    <textarea name="fanswer" id="fanswer" cols="30" rows="4" placeholder="Enter your FAQ Answer" <?php validateField("fanswer", $missingFields) ?>><?php setValue("fanswer"); ?></textarea>
                </div>
                <input class="submit" type="submit" name="submit" value="SUBMIT">
            </form>
        </div>
    <?php
    }
    ?>






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
    </div>

    <script src="extra.js"></script>
</body>


</html>