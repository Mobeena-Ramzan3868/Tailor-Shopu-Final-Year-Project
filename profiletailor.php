<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="profiletailorcss.css">
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

</head>

<body>
    <script src="Homejs.js"></script>
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
                <i class="fas fa-search"></i>
            </form>
        </div>
        <div class="copyright">
            <b> TailorShopu.pk - &copy; 2022 -All Rights Reserved</b>
        </div>
    </div>
    <div class="Closenavbar" id="Closenavbar">
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
    $db = new mysqli('localhost', 'root', '', 'final year project');
    if (mysqli_connect_errno()) {
        echo 'connection error: ' . $db->connect_errno;
        exit;
    } ?>
    <div id="filterdiv">
        <div class="headfil">
            <h1> Apply filters </h1>
        </div>
        <hr>
        <div class="headrat"> Rating </div>
        <div class="rathigh">
            <input name="chhigh" id="chhigh" type="checkbox" onchange="window.location.href='profiletailor.php?filter=yes&namefil=ratehigh'">
            <label for="chhigh">highest</label>
        </div>
        <div class="ratlow">
            <input name="chlow" id="chlow" type="checkbox" onchange="window.location.href='profiletailor.php?filter=yes&namefil=ratelow'">
            <label for="chlow">lowest</label>
        </div>
        <hr>
        <div class="headcust"> No of Customers </div>
        <div class="custhighdiv">
            <input name="custmost" id="custmost" type="checkbox" onchange="window.location.href='profiletailor.php?filter=yes&namefil=custmost'">
            <label for="custmost">Most first</label>
        </div>
        <div class="custlowdiv">
            <input name="custlow" id="custlow" type="checkbox" onchange="window.location.href='profiletailor.php?filter=yes&namefil=custlow'">
            <label for="custlow">Lower first</label>
        </div>
        <hr>
        <div class="headpri"> Price </div>
        <div class="priinput">
            <div class="prihighdiv">
                <input name="prihigh" id="prihigh" type="checkbox" onchange="window.location.href='profiletailor.php?filter=yes&namefil=prihigh'">
                <label for="prihigh">High Price first</label>
            </div>
            <div class="prilowdiv">
                <input name="prilow" id="prilow" type="checkbox" onchange="window.location.href='profiletailor.php?filter=yes&namefil=prilow'">
                <label for="prilow">Lower Price first</label>
            </div>
            <form action="profiletailor.php?filter=yespri" method="post">
                <input class="primaxclass" type="text" name="primax"> <h1 class="middlecla">to</h1>
                <input class="priminclass" type="text" name="primin">
                <input class="pribtn" type="submit" value="GO">
            </form>
        </div>
    </div>
    <?php
    if (!isset($_GET['filter'])) {
        $query = "SELECT tid, tname, tprice, tdesc, timg, rating, noofcust, img1 FROM tailoruser";
    }
    if (isset($_GET['filter'])) {
        if (isset($_GET['namefil'])) {
            if ($_GET['namefil'] == 'ratehigh') {
                $query = "SELECT tid, tname, tprice, tdesc, timg, rating, noofcust, img1 FROM tailoruser ORDER BY rating DESC";
            }
            if ($_GET['namefil'] == 'ratelow') {
                $query = "SELECT tid, tname, tprice, tdesc, timg, rating, noofcust, img1 FROM tailoruser ORDER BY rating";
            }
            if ($_GET['namefil'] == 'custmost') {
                $query = "SELECT tid, tname, tprice, tdesc, timg, rating, noofcust, img1 FROM tailoruser ORDER BY noofcust DESC";
            }
            if ($_GET['namefil'] == 'custlow') {
                $query = "SELECT tid, tname, tprice, tdesc, timg, rating, noofcust, img1 FROM tailoruser ORDER BY noofcust";
            }
            if ($_GET['namefil'] == 'prihigh') {
                $query = "SELECT tid, tname, tprice, tdesc, timg, rating, noofcust, img1 FROM tailoruser ORDER BY tprice DESC";
            }
            if ($_GET['namefil'] == 'prilow') {
                $query = "SELECT tid, tname, tprice, tdesc, timg, rating, noofcust, img1 FROM tailoruser ORDER BY tprice";
            }
        }
        if ($_GET['filter'] == 'yespri') {
            $min = (int)$_POST['primax'];
            $max = (int)$_POST['primin'];
            $query = "SELECT tid, tname, tprice, tdesc, timg, rating, noofcust, img1 FROM tailoruser WHERE tprice>=$min and tprice<=$max";
        }
    }
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($tid, $tname, $tprice, $tdesc, $timg, $rating, $noofcust, $img1);
    // echo '<h2 align=center>number of product found ' . $stmt->num_rows . '</h2>';
    ?>
    <div class="content">
        <?php
        while ($stmt->fetch()) {
        ?>
            <div class="divi">
                <article class="box">
                    <a class="artlink" href="mainprofile.php?tid=<?php echo $tid ?>">
                        <div class="artimgdiv">
                            <img width="600" height="400" class="artimg" src="images/<?php echo $img1 ?>" alt="<?php echo $tname[0] ?>">
                        </div>
                    </a>
                    <div class="artcontent">
                        <header>
                            <h2 class="artconth2">
                                <a href="mainprofile.php?tid=<?php echo $tid ?>"><img style="border-radius: 70%;" width="40" height="40" src="images/<?php echo $timg ?>" alt="<?php echo $tname[0] ?>"></a>
                                <div><a class="artcont3" href="mainprofile.php?tid=<?php echo $tid ?>"><b><?php echo $tname ?></b></a></div>
                            </h2>
                        </header>
                        <div class="artcontp">
                            <p><a href="mainprofile.php?tid=<?php echo $tid ?>"><?php echo $tdesc ?></a></p>
                        </div>
                        <div class="artcontpp">
                            <span class="fa fa-star" style="color: orange; cursor: context-menu;">
                            </span>
                            <p style="color: orange; cursor: context-menu;"><?php echo $rating ?></p>
                            <p>(<?php echo $noofcust ?>)</p>
                        </div>
                    </div>
                    <footer class="artfoot">
                        <div>
                            <p>STARTING AT</p>
                        </div>
                        <div>
                            <a class="artfooterlink" href="mainprofile.php?tid=<?php echo $tid ?>">
                                $<?php echo $tprice ?></a>
                        </div>
                    </footer>
                </article>
            </div>
        <?php
        }
        ?>
    </div>





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