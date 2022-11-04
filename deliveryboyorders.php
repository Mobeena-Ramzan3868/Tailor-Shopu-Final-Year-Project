<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="deliveryboyorderss.css">
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
    <link rel="stylesheet" href="extra.css"></head>

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
    if (isset($_GET['deliveryboyid'])) {
        $deliveryid = $_GET['deliveryboyid'];
        @$db = new mysqli('localhost', "root", "", "final year project");
        if (mysqli_connect_errno()) {
            echo 'Connection error: ' . $db->connect_errno;
            exit;
        }
        $query1 = "SELECT orderid, tailorname, custname, status, phone, totalprice, email, country, province, city, postal, address, additonal, custage, custgender, dateoforder, timeoforder, daysoforder, deliveryboyid, orderdeliverystatus, typeoforder FROM custorder";
        $stmto = $db->prepare($query1);
        $stmto->execute();
        $stmto->store_result();
        $stmto->bind_result($orderid, $tailorname, $custname, $status, $phone, $totalprice, $email, $country, $province, $city, $postal, $address, $additonal, $custage, $custgender, $dateoforder, $timeoforder, $daysoforder, $deliveryboyid, $orderdeliverystatus, $typeoforder);
        // echo "<h6>Number of persons found " . $stmto->num_rows . "</h6>";
        if ($stmto->num_rows == 0) {
            echo "not found in db";
        }
        while ($stmto->fetch()) {
            // echo '<div style="padding:4% 0%; padding-bottom:0%"></div>';
            // $tempdelboy = 'no';
            // $tempdelboy = 'no';
            // if ($orderdeliverystatus == 'deliveryboyac') {
            //     $queryac = "SELECT orderid, tailorname, custname, deliveryboyid, rawfabricdeliboyid, orderdeliverystatus, typeoforder FROM custorder WHERE deliveryboyid=$deliveryid";
            //     $stmtac = $db->prepare($queryac);
            //     $stmtac->execute();
            //     $stmtac->store_result();
            //     $stmtac->bind_result($orderid, $tailorname, $custname, $deliveryboyid, $rawfabricdeliboyid, $orderdeliverystatus, $typeoforder);
            //     if ($stmtac->num_rows == 0) {
            //         echo "not found in db";
            //     }
            //     else{
            //         $tempdelboy='yes'
            //     }
            // }
            // if ($orderdeliverystatus == 'deliveryboyac1') {
            // }





            if ($orderdeliverystatus == 'tailordel' and $status == 'done') {
                echo "<br>ndwebfhvwe<br>";
                $queryup = "UPDATE custorder SET orderdeliverystatus='tailorst' WHERE orderid=$orderid";
                $stmtup = $db->prepare($queryup);
                // $stmtup->bind_param('s', );
                $stmtup->execute();
                if ($stmtup->affected_rows > 0) {
                } else {
                    echo "<p>An error has occurred.<br/> The item was not added.</p>";
                }
            }
            // echo '<br>' . $status . '<br>';
            // echo $orderdeliverystatus . '<br>';
            // echo $orderid . '<br>';
            if ($orderdeliverystatus != 'custend') {
                if ($orderdeliverystatus != 'tailordel') {
    ?>
                    <!-- <table border="1">
            <tr>
                <th>SOURCE</th>
                <th>DESTINATION</th>
            </tr>
            <tr>
                <td>
                    <table border="1"> -->
                    <?php if ($status == "done") { ?>
                        <table class="tabledonemain">
                            <tr>
                                <th width="50%" class="thdessrc">SOURCE</th>
                                <th width="50%" class="thdessrc">DESTINATION</th>
                            </tr>
                            <tr>
                                <td>
                                    <table class="innertabledone">
                                        <?php
                                        $query = "SELECT tid, tname, email, country, city, province, postal, address, phone, tprice FROM tailoruser WHERE tname='$tailorname'";
                                        $stmt = $db->prepare($query);
                                        $stmt->execute();
                                        $stmt->store_result();
                                        $stmt->bind_result($tid, $tname, $temail, $tcountry, $tcity, $tprovince, $tpostal, $taddress, $tphone, $tprice);
                                        while ($stmt->fetch()) { ?>
                                            <tr>
                                                <td class="tdall">Name</td>
                                                <td><?php echo $tname ?></td>
                                            </tr>
                                            <tr>
                                                <td class="tdall">Phone Number</td>
                                                <td><?php echo $tphone ?></td>
                                            </tr>
                                            <tr>
                                                <td class="tdall">Country</td>
                                                <td><?php echo $tcountry ?></td>
                                            </tr>
                                            <tr>
                                                <td class="tdall">City</td>
                                                <td><?php echo $tcity ?></td>
                                            </tr>
                                            <tr>
                                                <td class="tdall">Province</td>
                                                <td><?php echo $tprovince ?></td>
                                            </tr>
                                            <tr>
                                                <td class="tdall">Postal Code</td>
                                                <td><?php echo $tpostal ?></td>
                                            </tr>
                                            <tr>
                                                <td class="tdall">Address</td>
                                                <td><?php echo $taddress ?></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </td>
                                <td>
                                    <table class="tableacceptsour">
                                        <?php }
                                    if ($status == "accept") {
                                        if ($typeoforder == "bycustomer") { ?>
                                            <table class="tableaccept">
                                                <tr>
                                                    <th width="50%" class="thdessrc">SOURCE</th>
                                                    <th width="50%" class="thdessrc">DESTINATION</th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table class="tableacceptinner">
                                                            <tr>
                                                                <td class="tdall">Name</td>
                                                                <td><?php echo $custname ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="tdall">Phone</td>
                                                                <td><?php echo $phone ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="tdall">Country</td>
                                                                <td><?php echo $country ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="tdall">Province</td>
                                                                <td><?php echo $province ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="tdall">City</td>
                                                                <td><?php echo $city ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="tdall">Postal Code</td>
                                                                <td><?php echo $postal ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="tdall">Address</td>
                                                                <td><?php echo $address ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table class="tablelastinner">
                                                        <?php }
                                                        ?>
                                                        <!-- </table>
                                        </td>
                                        <td>
                                            <table border="1"> -->
                                                        <?php if ($status == "accept") {
                                                            if ($typeoforder == "bycustomer") {
                                                                $query = "SELECT tid, tname, email, country, city, province, postal, address, phone, tprice FROM tailoruser WHERE tname='$tailorname'";
                                                                $stmt = $db->prepare($query);
                                                                $stmt->execute();
                                                                $stmt->store_result();
                                                                $stmt->bind_result($tid, $tname, $temail, $tcountry, $tcity, $tprovince, $tpostal, $taddress, $tphone, $tprice);
                                                                while ($stmt->fetch()) { ?>
                                                                    <tr>
                                                                        <td class="tdall">Name</td>
                                                                        <td><?php echo $tname ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="tdall">Phone Number</td>
                                                                        <td><?php echo $tphone ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="tdall">Country</td>
                                                                        <td><?php echo $tcountry ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="tdall">City</td>
                                                                        <td><?php echo $tcity ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="tdall">Province</td>
                                                                        <td><?php echo $tprovince ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="tdall">Postal Code</td>
                                                                        <td><?php echo $tpostal ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="tdall">Address</td>
                                                                        <td><?php echo $taddress ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="tdall">Amount</td>
                                                                        <td>20$</td>
                                                                    </tr>
                                                                <?php } ?>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <?php if ($orderdeliverystatus == "customerst") { ?>
                                                            <a href="acceptdeliveryorder.php?orderid=<?php echo $orderid ?>&deliveryid=<?php echo $deliveryid; ?>"><button>Accept Order</button></a>
                                                        <?php } ?>
                                                        <?php if ($orderdeliverystatus == "deliveryboyac1") { ?>
                                                            <a href="acceptdeliveryorder.php?orderid=<?php echo $orderid ?>"><button>Order Delivered</button></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        <?php }
                                                        }
                                                        if ($status == "done") {
                                        ?>
                                        <tr>
                                            <td class="tdall">Name</td>
                                            <td><?php echo $custname ?></td>
                                        </tr>
                                        <tr>
                                            <td class="tdall">Phone</td>
                                            <td><?php echo $phone ?></td>
                                        </tr>
                                        <tr>
                                            <td class="tdall">Country</td>
                                            <td><?php echo $country ?></td>
                                        </tr>
                                        <tr>
                                            <td class="tdall">Province</td>
                                            <td><?php echo $province ?></td>
                                        </tr>
                                        <tr>
                                            <td class="tdall">City</td>
                                            <td><?php echo $city ?></td>
                                        </tr>
                                        <tr>
                                            <td class="tdall">Postal</td>
                                            <td><?php echo $postal ?></td>
                                        </tr>
                                        <tr>
                                            <td class="tdall">Address</td>
                                            <td><?php echo $address ?></td>
                                        </tr>
                                        <tr>
                                            <td class="tdall">Amount</td>
                                            <td><?php echo $totalprice + 20 ?>$</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <?php if ($orderdeliverystatus == "tailorst") { ?>
                                        <a href="acceptdeliveryorder.php?orderid=<?php echo $orderid ?>&deliveryid=<?php echo $deliveryid; ?>"><button>Accept order</button></a>
                                    <?php } ?>
                                    <?php if ($orderdeliverystatus == "deliveryboyac") { ?>
                                        <a href="acceptdeliveryorder.php?orderid=<?php echo $orderid ?>"><button>Order Delivered</button></a>
                                    <?php } ?>
                                </td>
                            </tr>
                        </table>
                    <?php }
                    ?>
                    <!-- </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <a href=""><button>Accept order</button></a>
                                        </td>
                                    </tr>
                                </table> -->
    <?php }
            }
        }
    }
    else{
        header("Location:loginform.php?user=delivery");
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