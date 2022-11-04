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
            width: 60%;
            margin: 0% auto;
            padding: 1% 1%;
        }

        .outertable th {
            border: 1px solid black;
            padding: 1% 1%;
            text-align: left;
            width: 30%;
        }

        .outertable td {
            border: 1px solid black;
            padding: 1% 1%;
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
    $query = "SELECT id, name, phone, email, dob, vehicletype, vehicleno, cnic, gender, country, city, province, postal, address, image FROM deliveryboy";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $name, $phone, $email, $dob, $vehicletype, $vehicleno, $cnic, $gender, $country, $city, $province, $postal, $address, $image);
    // echo "<h6>Number of persons found " . $stmt->num_rows . "</h6>";
    if ($stmt->num_rows == 0) {
        echo "not found in db";
    }
    while ($stmt->fetch()) { ?>
        <div style="padding:4% 0%; padding-bottom:0%;">
            <table class="outertable">
                <tr>
                    <td rowspan="14" style="border:none; padding:0 0;"><img src="images/<?php echo $image ?>" alt="" width="300" height="570"></td>
                    <th>Delivery Boy Name</th>
                    <td><?php echo $name ?></td>
                </tr>
                <tr>
                    <th>Delivery Boy Phone</th>
                    <td><?php echo $phone ?></td>
                </tr>
                <tr>
                    <th>Delivery Boy Email</th>
                    <td><?php echo $email ?></td>
                </tr>
                <tr>
                    <th>Delivery Boy DOB</th>
                    <td><?php echo $dob ?></td>
                </tr>
                <tr>
                    <th>Delivery Boy Vehicle Type</th>
                    <td><?php echo $vehicletype ?></td>
                </tr>
                <tr>
                    <th>Delivery Boy Vehicle No</th>
                    <td><?php echo $vehicleno ?></td>
                </tr>
                <tr>
                    <th>Delivery Boy CNIC</th>
                    <td><?php echo $cnic ?></td>
                </tr>
                <tr>
                    <th>Delivery Boy Gender</th>
                    <td><?php echo $gender ?></td>
                </tr>
                <tr>
                    <th>Delivery Boy Country</th>
                    <td><?php echo $country ?></td>
                </tr>
                <tr>
                    <th>Delivery Boy City</th>
                    <td><?php echo $city ?></td>
                </tr>
                <tr>
                    <th>Delivery Boy Province</th>
                    <td><?php echo $province ?></td>
                </tr>
                <tr>
                    <th>Delivery Boy Postal</th>
                    <td><?php echo $postal ?></td>
                </tr>
                <tr>
                    <th>Delivery Boy Address</th>
                    <td><?php echo $address ?></td>
                </tr>
                <tr>
                    <th>Delivery Boy Total Orders</th>
                    <td><?php
                        $queryo = "SELECT deliveryboyid, rawfabricdeliboyid FROM custorder WHERE deliveryboyid=$id or rawfabricdeliboyid=$id";
                        $stmto = $db->prepare($queryo);
                        $stmto->execute();
                        $stmto->store_result();
                        $stmto->bind_result($deliveryboyid, $rawfabricdeliboyid);
                        $countorders = 0;
                        while ($stmto->fetch()) {
                            $countorders = $countorders + 1;
                        }
                        echo $countorders;
                        ?></td>
                </tr>
                <tr>
                    <td colspan="3" style="border: none ;"><a href="deldeliveryboy.php?did=<?php echo $id ?>"><button>Delete Delivery Boy</button></a></td>
                </tr>
            </table>
        </div>
    <?php } ?>






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