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

        .outertable {
            background-color: #b8e9e7;
            border: 2px solid black;
            width: 55%;
            margin: 0% auto;
            padding: 2% 2%;
        }

        .outertable th {
            border: 1px solid black;
            width: 35%;
            padding: 2% 2%;
            text-align: left;
        }

        .outertable td {
            border: 1px solid black;
            padding: 2% 2%;
        }

        button {
            float: right;
    margin: 1% 4%;
    width: 25%;
    font-size: 110%;
    border-radius: 5px;
    padding: 2%;
            background: #0c4c4b;
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
    @$db = new mysqli('localhost', "root", "", "final year project");
    if (mysqli_connect_errno()) {
        echo 'Connection error: ' . $db->connect_errno;
        exit;
    }
    $query = "SELECT id, name, phone, password, email, dob FROM users";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $name, $phone, $password, $email, $dob);
    // echo "<h6>Number of persons found " . $stmt->num_rows . "</h6>";
    if ($stmt->num_rows == 0) {
        echo "not found in db";
    }
    while ($stmt->fetch()) { ?>
        <div style="padding:4% 0% ; padding-bottom:0%;">
            <table class="outertable">
                <tr>
                    <th>Customer Name</th>
                    <td><?php echo $name ?></td>
                </tr>
                <tr>
                    <th>Customer Phone No</th>
                    <td><?php echo $phone ?></td>
                </tr>
                <tr>
                    <th>Customer Email</th>
                    <td><?php echo $email ?></td>
                </tr>
                <tr>
                    <th>Customer DOB</th>
                    <td><?php echo $dob ?></td>
                </tr>
                <tr>
                    <th>No Of Orders Placed</th>
                    <td><?php
                        $queryo = "SELECT custname FROM custorder WHERE custname='$name'";
                        $stmto = $db->prepare($queryo);
                        $stmto->execute();
                        $stmto->store_result();
                        $stmto->bind_result($custname);
                        $countorders = 0;
                        while ($stmto->fetch()) {
                            $countorders = $countorders + 1;
                        }
                        echo $countorders;
                        ?></td>
                </tr>
                <tr>
                    <td colspan="3" style="border: none ;"><a href="delcustomer.php?cid=<?php echo $id ?>"><button>Delete Customer</button></a></td>
                </tr>
            </table>
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