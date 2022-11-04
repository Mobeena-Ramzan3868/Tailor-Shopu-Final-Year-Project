<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admintailorcs.css">
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
    @$db = new mysqli('localhost', "root", "", "final year project");
    if (mysqli_connect_errno()) {
        echo 'Connection error: ' . $db->connect_errno;
        exit;
    }
    $query = "SELECT tid, tname, email, dob, cnic, country, city, province, postal, address, phone, tprice, tdesc, timg, rating, noofcust, abouttailor, daysoforder, img1, img2, img3, img4, img5, img6, whatincluded FROM tailoruser";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($tid, $tname, $email, $dob, $cnic, $country, $city, $province, $postal, $address, $phone, $tprice, $tdesc, $timg, $rating, $noofcust, $abouttailor, $daysoforder, $img1, $img2, $img3, $img4, $img5, $img6, $whatincluded);
    // echo "<h6>Number of persons found " . $stmt->num_rows . "</h6>";
    if ($stmt->num_rows == 0) {
        echo "not found in db";
    }
    while ($stmt->fetch()) { ?>
        <div style="margin: 0% 0%; padding:4% 0%; padding-bottom:0%;">
            <table class="tableout">
                <tr>
                    <!-- <th>Tailor Image</th> -->
                    <td rowspan="17"><img src="images/<?php echo $timg ?>" alt="" height="900" width="400"></td>
                    <!-- </tr> -->
                    <!-- <tr> -->
                    <th class="thtd">Tailor Name</th>
                    <td class="thtd"><?php echo $tname ?></td>
                </tr>
                <tr>
                    <th class="thtd">Tailor Email</th>
                    <td class="thtd"><?php echo $email ?></td>
                </tr>
                <tr>
                    <th class="thtd">Tailor DOB</th>
                    <td class="thtd"><?php echo $dob ?></td>
                </tr>
                <tr>
                    <th class="thtd">Tailor CNIC</th>
                    <td class="thtd"><?php echo $cnic ?></td>
                <tr>
                    <th class="thtd">Tailor Country</th>
                    <td class="thtd"><?php echo $country ?></td>
                </tr>
                <tr>
                    <th class="thtd">Tailor City</th>
                    <td class="thtd"><?php echo $city ?></td>
                </tr>
                <tr>
                    <th class="thtd">Tailor Province</th>
                    <td class="thtd"><?php echo $province ?></td>
                </tr>
                <tr>
                    <th class="thtd">Tailor Postal</th>
                    <td class="thtd"><?php echo $postal ?></td>
                </tr>
                <tr>
                    <th class="thtd">Tailor Address</th>
                    <td class="thtd"><?php echo $address ?></td>
                </tr>
                <tr>
                    <th class="thtd">Tailor Phone No</th>
                    <td class="thtd"><?php echo $phone ?></td>
                </tr>
                <tr>
                    <th class="thtd">Order Price</th>
                    <td class="thtd"><?php echo $tprice ?></td>
                </tr>
                <tr>
                    <th class="thtd">Profile Description</th>
                    <td class="thtd"><?php echo $phone ?></td>
                </tr>
                <tr>
                    <th class="thtd">Tailor Rating</th>
                    <td class="thtd"><?php echo $rating ?></td>
                </tr>
                <tr>
                    <th class="thtd">No of Customers</th>
                    <td class="thtd"><?php echo $noofcust ?></td>
                </tr>
                <tr>
                    <th class="thtd">About Tailor</th>
                    <td class="thtd"><?php echo $abouttailor ?></td>
                </tr>
                <tr>
                    <th class="thtd">Total Days of Order</th>
                    <td class="thtd"><?php echo $daysoforder ?></td>
                </tr>
                <tr>
                    <th class="thtd">What's Included in Order</th>
                    <td class="thtd"><?php echo $whatincluded ?></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <table class="tableinner">
                            <tr>
                                <th>Sample 1</th>
                                <th>Sample 2</th>
                                <th>Sample 3</th>
                                <th>Sample 4</th>
                                <th>Sample 5</th>
                                <th>Sample 6</th>
                            </tr>
                            <tr>
                                <td><img src="images/<?php echo $img1 ?>" alt="" height="200" width="200"></td>
                                <td><img src="images/<?php echo $img2 ?>" alt="" height="200" width="200"></td>
                                <td><img src="images/<?php echo $img3 ?>" alt="" height="200" width="200"></td>
                                <td><img src="images/<?php echo $img4 ?>" alt="" height="200" width="200"></td>
                                <td><img src="images/<?php echo $img5 ?>" alt="" height="200" width="200"></td>
                                <td><img src="images/<?php echo $img6 ?>" alt="" height="200" width="200"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"><a href="deltailor.php?tid=<?php echo $tid ?>"><button>Delete Tailor</button></a></td>
                </tr>
            </table>
        </div>
    <?php }
    ?>






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