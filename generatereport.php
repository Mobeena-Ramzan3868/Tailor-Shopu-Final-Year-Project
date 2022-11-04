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

        th {
            border: 1px solid black;
            padding: 1% 2%;
            width: 25%;
        }

        td {
            border: 1px solid black;
            padding: 1% 1%;
        }

        .outertab {
            background-color: #b8e9e7;
            border: 2px solid black;
            padding: 1% 1%;
            margin: 0% auto;
            width: 70%;
        }

        .pichead {
            padding: 1% 0%;
            font-size: 170%;
        }

        .datereport {
            background-color: #76cfcb;
            border: none;
            font-size: 250%;
            font-weight: 900;
            padding: 3% 2%;
            text-align: center;
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
    $query = "SELECT orderid, tailorname, custname, status, phone, totalprice, email, country, province, city, postal, address, additonal, sample, custage, custgender, dateoforder, timeoforder, daysoforder, deliveryboyid, rawfabricdeliboyid, orderdeliverystatus, tfabricname, fmeter, cfabricdet, typeoforder, measurementid, rating, feedback FROM custorder ORDER BY orderid desc";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($orderid, $tailorname, $custname, $status, $phone, $totalprice, $email, $country, $province, $city, $postal, $address, $additonal, $sample, $custage, $custgender, $dateoforder, $timeoforder, $daysoforder, $deliveryboyid, $rawfabricdeliboyid, $orderdeliverystatus, $tfabricname, $fmeter, $cfabricdet, $typeoforder, $measurementid, $rating, $feedback);
    // echo "<h6>Number of persons found " . $stmt->num_rows . "</h6>";
    if ($stmt->num_rows == 0) {
        echo "not found in db";
    }
    while ($stmt->fetch()) { ?>
    <div style="padding: 4% 0% ; padding-bottom: 0%"></div>
        <table class="outertab">
            <tr>
                <td colspan="3" class="datereport">DATE: <?php echo $dateoforder; ?></td>
            </tr>
            <tr>
                <th rowspan="26" style="padding: 0% 0%; border: none;">
                    <table>
                        <tr>
                            <td class="pichead"> Order Sample</td>
                        </tr>
                        <tr>
                            <td style="border: none; padding: 0% 0%;"><img src="images/<?php echo $sample ?>" alt="" width="350" height="900"></td>
                        </tr>
                    </table>
                </th>
                <th align="left">Tailor Name</th>
                <td><?php echo $tailorname ?></td>
            </tr>
            <tr>
                <th align="left">Customer Name</th>
                <td><?php echo $custname ?></td>
            </tr>
            <tr>
                <th align="left">Customer Phone</th>
                <td><?php echo $phone ?></td>
            </tr>
            <tr>
                <th align="left">Customer Email</th>
                <td><?php echo $email ?></td>
            </tr>
            <tr>
                <th align="left">Customer Country</th>
                <td><?php echo $country ?></td>
            </tr>
            <tr>
                <th align="left">Customer Province</th>
                <td><?php echo $province ?></td>
            </tr>
            <tr>
                <th align="left">Customer City</th>
                <td><?php echo $city ?></td>
            </tr>
            <tr>
                <th align="left">Customer Postal Code</th>
                <td><?php echo $postal ?></td>
            </tr>
            <tr>
                <th align="left">Customer Address</th>
                <td><?php echo $address ?></td>
            </tr>
            <tr>
                <th align="left">Order Total Price</th>
                <td><?php echo $totalprice ?></td>
            </tr>
            <tr>
                <th align="left">Customer Additional Information</th>
                <td><?php echo $additonal ?></td>
            </tr>
            <tr>
                <th align="left">Customer Age</th>
                <td><?php echo $custage ?></td>
            </tr>
            <tr>
                <th align="left">Status of order</th>
                <td><?php echo $status ?></td>
            </tr>
            <tr>
                <th align="left">Placed Date Of Order</th>
                <td><?php echo $dateoforder ?></td>
            </tr>
            <tr>
                <th align="left">Placed Order Time</th>
                <td><?php echo $timeoforder ?></td>
            </tr>
            <tr>
                <th align="left">Days of Order</th>
                <td><?php echo $daysoforder ?></td>
            </tr>
            <?php
            if ($orderdeliverystatus != 'customerst') {
                if ($orderdeliverystatus != 'deliveryboyac1') {
                    if ($orderdeliverystatus != 'tailordel') {
                        if ($orderdeliverystatus != 'tailorst') {
            ?>
                            <tr>
                                <th align="left">Delivery Boy Id</th>
                                <td><?php echo $deliveryboyid ?></td>
                            </tr>
            <?php
                        }
                    }
                }
            }
            ?>
            <?php
            if ($typeoforder == 'bycustomer') {
                if ($orderdeliverystatus != 'customerst') {
            ?>
                    <tr>
                        <th align="left">Raw Fabric Delivery Boy Id</th>
                        <td><?php echo $rawfabricdeliboyid ?></td>
                    </tr>
            <?php
                }
            }
            ?>
            <tr>
                <th align="left">Order Delivery Status</th>
                <td><?php echo $orderdeliverystatus ?></td>
            </tr>
            <?php
            if ($typeoforder == 'bytailor') {
            ?>
                <tr>
                    <th align="left">Fabric Name by Tailor</th>
                    <td><?php echo $tfabricname ?></td>
                </tr>
                <tr>
                    <th align="left">Meter of Fabric By Tailor</th>
                    <td><?php echo $fmeter ?></td>
                </tr>
            <?php
            }
            if ($typeoforder == 'bycustomer') {
            ?>
                <tr>
                    <th align="left">Fabric By Customer Details</th>
                    <td><?php echo $cfabricdet ?></td>
                </tr>
            <?php
            }
            ?>
            <tr>
                <th align="left">Type Of Order</th>
                <td><?php echo $typeoforder ?></td>
            </tr>
            <tr>
                <th align="left">Measurement Id</th>
                <td><?php echo $measurementid ?></td>
            </tr>
            <?php
            if ($orderdeliverystatus == 'custend') {
            ?>
                <tr>
                    <th align="left">Rating For Order</th>
                    <td><?php echo $rating ?></td>
                </tr>
                <tr>
                    <th align="left">Feedback For Order</th>
                    <td><?php echo $feedback ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
    <?php }
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