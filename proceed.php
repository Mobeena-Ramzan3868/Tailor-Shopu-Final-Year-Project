<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="proceed.css">
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


    function processForm()
    {
        $requiredFields = array("phone", "email", "address", "country", "province", "city", "postal");
        $missingFields = array();

        foreach ($requiredFields as $requiredField) {
            if (!isset($_POST[$requiredField]) or !$_POST[$requiredField]) {
                $missingFields[] = $requiredField;
            }
        }

        if ($missingFields) {
            displayForm($missingFields);
        } else {
            if (isset($_FILES['imgpic'])) {
                $file_name = $_FILES['imgpic']['name'];
                $file_tmp = $_FILES['imgpic']['tmp_name'];
                if (move_uploaded_file($file_tmp, "images/" . $file_name)) {
                    echo "successfully uploaded";
                } else {
                    echo "could not upload the file";
                }
            }
            @$db = new mysqli('localhost', "root", "", "final year project");
            if (mysqli_connect_errno()) {
                echo 'Connection error: ' . $db->connect_errno;
                exit;
            }
            $timeorder = date("h:i");
            $dateorder = date("d/m/Y");
            // $query = "INSERT INTO custorder (tailorname, custname, status, phone, totalprice, email, country, province, city, postal, address, additonal, sample, dateoforder, timeoforder, daysoforder) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            // $stmt = $db->prepare($query);
            // $stmt->bind_param('ssssssssssssssss', $_SESSION["dtname"], $_SESSION["dcename"], $_POST["status"], $_POST["phone"], $_SESSION["dtprice"], $_POST["email"], $_POST["country"], $_POST["province"], $_POST["city"], $_POST["postal"], $_POST["address"], $_POST["info"], $_FILES["imgpic"]['name'], $dateorder, $timeorder, $_SESSION['tddaysoforder']);
            // $stmt->execute();
            // echo '<br>'.$_SESSION["dcename"], '<br>'.$_SESSION["dtname"], '<br>'.$_POST["status"], '<br>'.$_POST["phone"],'<br>'. $_SESSION["dtprice"], '<br>'.$_POST["email"], '<br>'.$_POST["country"], '<br>'.$_POST["province"], '<br>'.$_POST["city"], '<br>'.$_POST["postal"], '<br>'.$_POST["address"], '<br>'.$_POST["info"], '<br>'.$_FILES["imgpic"]['name'], '<br>'.$dateorder, '<br>'.$timeorder, '<br>'.$_SESSION['tddaysoforder'];
            $fabricid = $_GET["fabricid"];
            $query = "UPDATE custorder SET tailorname=?, custname=?, status=?, phone=?, totalprice=?, email=?, country=?, province=?, city=?, postal=?, address=?, additonal=?, sample=?, dateoforder=?, timeoforder=?, daysoforder=? WHERE orderid =$fabricid";
            $stmt = $db->prepare($query);
            $stmt->bind_param('ssssssssssssssss', $_SESSION["dtname"], $_SESSION["dcename"], $_POST["status"], $_POST["phone"], $_SESSION["dtprice"], $_POST["email"], $_POST["country"], $_POST["province"], $_POST["city"], $_POST["postal"], $_POST["address"], $_POST["info"], $_FILES["imgpic"]['name'], $dateorder, $timeorder, $_SESSION['tddaysoforder']);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                $last_id = $db->insert_id;
                echo "New record created successfully. Last inserted ID is: " . $last_id;
                header('Location: lastpro.php?orderid=' . $fabricid);
            } else {
                echo "<p>An error has occurred.<br/> The item was not added.</p>";
            }
        }
    }


    function displayForm($missingFields)
    {
        @$db = new mysqli('localhost', "root", "", "final year project");
        if (mysqli_connect_errno()) {
            echo 'Connection error: ' . $db->connect_errno;
            exit;
        }
        $stid = $_SESSION['tid'];
        $scid = $_SESSION['cid'];

        $query = "SELECT id, name, phone, email FROM users WHERE id=$scid";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($dcid, $dcname, $dcphone, $dcemail);
        while ($stmt->fetch()) {
            $_SESSION["dcename"] = $dcname;
    ?>
            <div class="contouter">
                <div class="container">
                    <h1>Delivery Detail</h1>
                    <?php if ($missingFields) { ?>
                        <p class="error">Entering name email and address is mandatory in the fields</p>
                    <?php } ?>
                    <form action="proceed.php?fabricid=<?php echo $_GET['fabricid'] ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="status" value="no">
                        <div class="form">
                            <input type="text" name="cname" disabled id="" value="<?php echo $dcname ?>">
                        </div>
                        <div class="form">
                            <input type="text" name="phone" id="" placeholder="Enter your Phone NO " value="<?php echo $dcphone ?>">
                        </div>
                        <div class="form">
                            <input type="email" name="email" id="" placeholder="Enter your Email" value="<?php echo $dcemail ?>">
                        </div>
                        <div class="form1">
                            <input type="text" name="country" id="" placeholder="Enter your Country" value="<?php setValue("country"); ?>">
                        </div>
                        <div class="form1">
                            <input type="text" name="province" id="" placeholder="Enter your Province" value="<?php setValue("province"); ?>">
                        </div>
                        <div class="form1">
                            <input type="text" name="city" id="" placeholder="Enter your City" value="<?php setValue("city"); ?>">
                        </div>
                        <div class="form1">
                            <input type="text" name="postal" id="" placeholder="Enter your Postal Code" value="<?php setValue("postal"); ?>">
                        </div>
                        <div class="form">
                            <textarea name="address" id="address" cols="30" rows="3" placeholder="Enter your Address"><?php setValue("address"); ?></textarea>
                        </div>
                        <div class="form">
                            <textarea name="info" id="info" cols="30" rows="5" placeholder="Additional Information(order notes)"><?php setValue("info"); ?></textarea>
                        </div>
                        <div class="sampleimg">
                            <h4>Design Sample</h4>
                            <input type="file" name="imgpic" id="">
                        </div>
                </div>
            </div>
            <div class="contbill">
                <h2>YOUR ORDER</h2>
                <table style="margin: 3%; width: 86%;">
                <?php
            }
            $tsid = $_SESSION["tid"];
            $query = "SELECT tid, tname, tprice, daysoforder FROM tailoruser WHERE tid=$tsid";
            $stmt = $db->prepare($query);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($dtid, $dtname, $dtprice, $tddaysoforder);
            while ($stmt->fetch()) {
                $_SESSION['dtname'] = $dtname;
                $_SESSION['dtprice'] = $dtprice;
                $_SESSION['tddaysoforder'] = $tddaysoforder;
                echo '<tr class="trtd"><td class="itempro">Tailor Name</td><td class="itemtdpro">' . $dtname . '</td></tr>';
                echo '<tr class="trtd"><td class="itempro">Price</td><td class="itemtdpro"> $' . $dtprice . ' </td></tr>';
                echo '<tr class="trtd"><td class="itempro">Days of delivery</td><td class="itemtdpro"> ' . $tddaysoforder . ' </td></tr>';
                echo '<tr class="trtd"><td class="itempro">Delivery charges</td><td class="itemtdpro"> $20 </td></tr>';
                $sumtot = $dtprice + 20;
                // echo '<tr><td style="font-weight:900; height:64px;" class="itemtdpro "></td><td class="itemtdpro"></td></tr>';
            }
                ?>
                </table>
                <hr style="border:1px solid black; margin-top:-18px;">
                <p style="padding: 20px 49px; margin: 10px 21px;"><span class="tottot">Total</span>
                    <span class="totsum">Rs<?php echo $sumtot ?></span>
                </p>
                <div align="center">
                    <input class="btn" type="submit" name="submit" value="PLACE ORDER">
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
        </div> -->

        <script src="extra.js"></script>
</body>

</html>