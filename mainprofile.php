<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<?php
// unset($_SESSION['tailoremail']);
// unset($_SESSION['tailorpassword']);
// unset($_SESSION['tailoruse']);
if (isset($_GET['tid']) or isset($_SESSION['tailoruse']) or isset($_GET['trname'])) {
    $db = new mysqli('localhost', 'root', '', 'final year project');
    if (mysqli_connect_errno()) {
        echo 'connection error: ' . $db->connect_errno;
        exit;
    }
    if (isset($_GET['tid'])) {
        if (isset($_SESSION["tailoruse"])) {
            session_destroy();
        }
        $tid = $_GET['tid'];
        $query = "SELECT tid, tname, tpassword, tprice, tdesc, timg, rating, noofcust, abouttailor, phone, daysoforder, img1, img2, img3, img4, img5, img6, whatincluded FROM tailoruser WHERE tid=$tid";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($tid, $tname, $password, $tprice, $tdesc, $timg, $rating, $noofcust, $abouttailor, $phone, $daysoforder, $img1, $img2, $img3, $img4, $img5, $img6, $whatincluded);
    }
    if (isset($_SESSION['tailoruse'])) {
        $user = $_SESSION['tailoruse'];
        $passcheck = $_SESSION['tailorpassword'];
        $query = "SELECT tid, tname, tpassword,  tprice, tdesc, timg, rating, noofcust, abouttailor, phone, daysoforder, img1, img2, img3, img4, img5, img6, whatincluded FROM tailoruser WHERE tpassword='$passcheck'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($tid, $tname, $password, $tprice, $tdesc, $timg, $rating, $noofcust, $abouttailor, $phone, $daysoforder, $img1, $img2, $img3, $img4, $img5, $img6, $whatincluded);
    }
    if (isset($_GET['trname'])) {
        $trname = $_GET['trname'];
        $user = $_GET['user'];
        $query = "SELECT tid, tname, tpassword,  tprice, tdesc, timg, rating, noofcust, abouttailor, phone, daysoforder, img1, img2, img3, img4, img5, img6, whatincluded FROM tailoruser WHERE tname='$trname'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($tid, $tname, $password, $tprice, $tdesc, $timg, $rating, $noofcust, $abouttailor, $phone, $daysoforder, $img1, $img2, $img3, $img4, $img5, $img6, $whatincluded);
    }
    while ($stmt->fetch()) {
?>

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="mainprofilecss.css">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Andada+Pro&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

            <title>Tailor Shopu</title>
            <script src="https://kit.fontawesome.com/afd6aa68df.js" crossorigin="anonymous"></script>

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <style>
                @import url('https://fonts.googleapis.com/css2?family=Andada+Pro:ital,wght@1,700&display=swap');
            </style>
            <link href="https://fonts.googleapis.com/css2?family=Slabo+27px&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="extrac.css">
            <style>
                #one {
                    background-image: url(images/<?php echo $img1 ?>);
                    background-size: 100% 100%;
                }

                #two {
                    background-image: url(images/<?php echo $img2 ?>);
                    background-size: 100% 100%;
                }

                #three {
                    background-image: url(images/<?php echo $img3 ?>);
                    background-size: 100% 100%;
                }

                #four {
                    background-image: url(images/<?php echo $img4 ?>);
                    background-size: 100% 100%;
                }

                #five {
                    background-image: url(images/<?php echo $img5 ?>);
                    background-size: 100% 100%;
                }

                #six {
                    background-image: url(images/<?php echo $img6 ?>);
                    background-size: 100% 100%;
                }

                #one:checked~.display-image {
                    background-image: url(images/<?php echo $img1 ?>);
                }

                #two:checked~.display-image {
                    background-image: url(images/<?php echo $img2 ?>);
                }

                #three:checked~.display-image {
                    background-image: url(images/<?php echo $img3 ?>);
                }

                #four:checked~.display-image {
                    background-image: url(images/<?php echo $img4 ?>);
                }

                #five:checked~.display-image {
                    background-image: url(images/<?php echo $img5 ?>);
                }

                #six:checked~.display-image {
                    background-image: url(images/<?php echo $img6 ?>);
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







            <!-- <div style="margin: 0%;"> -->
                <div>
                    <div class="sidebox">
                        <div class="heading">Proceed</div>
                        <div class="price">Price: <span class="priceright">$<?php echo $tprice ?></span></div>
                        <div class="orderdays"><span class="fa fa-clock-o"> </span> <?php echo $daysoforder ?> Days Delivery</div>
                        <hr style="margin: 1% 8%; border: 1px solid #ada9a9;">
                        <?php if (!isset($_SESSION['tailoruse']) and !isset($_GET['trname'])) {
                            $_SESSION["tid"] = $tid;
                        ?>
                            <form action="loginform.php?statuscont=checkoutcont" method="post" class="btnpro">
                                <input type="hidden" name="user" value="customer">
                                <button>Continue ($<?php echo $tprice ?>)</button>
                            </form>
                            <!-- <a href="http://wa.me/<?php echo $phone ?>" class="btncontact" target="_blank"><button>Contact Tailor</button></a> -->
                            <a href="loginform.php?tid=<?php echo $tid ?>&messfrom=customer&user=customer" class="btncontact" target="_blank"><button>Contact Tailor</button></a>
                        <?php }
                        if (isset($_SESSION["tailoruse"]) or isset($_GET['trname'])) {
                            if (isset($_GET['trname'])) {
                                $_SESSION["tailorid"] = $tid;
                            } ?>
                            <a href="editprofile.php" class="btnpro"><button>Edit Profile</button></a>
                            <a href="tailorvieworders.php?tgname=<?php echo $tname ?>" class="btncontact"><button>View Orders</button></a>
                        <?php } ?>
                    </div>
                    <div class="sidebox2">
                        <div class="imglogo"><img src="images/<?php echo $timg ?>" alt="<?php echo $tname[0] ?>" width="160" height="160"></div>
                        <div class="logoname"><?php echo $tname ?></div>
                    </div>
                </div>
                <div class="rightside">
                    <div class="tailordesc"><?php echo $tdesc ?></div>
                    <img class="tailorimg" src="images/<?php echo $timg ?>" alt="<?php echo $tname[0] ?>" width="40" height="40">
                    <div class="namedetail">
                        <span class="tailorname"><?php echo $tname ?></span>
                        <span>|</span>
                        <span style="color: orange; cursor: context-menu;">
                            <span class="fa fa-star"></span>
                            <?php echo $rating ?></span>
                        <span class="noofcust" style="margin: 0% 3%;"><?php echo $noofcust ?> Orders Done</span>
                    </div>
                </div>
                <div class="container">
                    <input type="radio" name="image" id="one" class="input" checked>
                    <input type="radio" name="image" id="two" class="input">
                    <input type="radio" name="image" id="three" class="input">
                    <input type="radio" name="image" id="four" class="input">
                    <input type="radio" name="image" id="five" class="input">
                    <input type="radio" name="image" id="six" class="input">
                    <div class="display-image">
                    </div>

                    <div class="headtailor">About the Tailor</div>
                    <div class="abouttailor"><?php echo $abouttailor ?></div>
                    <?php if ($whatincluded) { ?>
                        <div class="includehead">What's included</div>
                        <div class="included"><?php echo $whatincluded ?></div>
                    <?php } ?>
                    <div class="extra"></div>
                </div>
            <!-- </div> -->






            <script src="extra.js"></script>
        </body>

</html>
<?php
    }
} else {
    echo "Nothing Found";
}
?>