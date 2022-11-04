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
    <link rel="stylesheet" href="faqs.css">
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






    
    <main>

        <div class="wall">
            <img src="faqimg.jpg" alt="wallpaper">
            <div class="imgheading">
                <p>FREQUENTLY ASKED QUESTIONS</p>
            </div>
        </div>
        <!-- <h1 class="faq-heading">FAQ'S</h1> -->
        <section class="faq-container">
            <?php
            @$db = new mysqli('localhost', "root", "", "final year project");
            if (mysqli_connect_errno()) {
                echo 'Connection error: ' . $db->connect_errno;
                exit;
            }
            $query1 = "SELECT fid, fquestion, fanswer FROM faq";
            $stmto = $db->prepare($query1);
            $stmto->execute();
            $stmto->store_result();
            $stmto->bind_result($fid, $fquestion, $fanswer);
            // echo "<h6>Number of persons found " . $stmto->num_rows . "</h6>";
            if ($stmto->num_rows == 0) {
                echo "not found in db";
            }
            while ($stmto->fetch()) {
            ?>
                    <!-- faq question -->
                    <h1 class="faq-page"><?php echo $fquestion ?></h1>

                    <!-- faq answer -->
                    <div class="faq-body">
                        <p><?php echo $fanswer ?></p>
                    </div>
                <hr class="hr-line">
            <?php } ?>
        </section>
    </main>
    <script>
        var faq = document.getElementsByClassName("faq-page");
        var i;

        for (i = 0; i < faq.length; i++) {
            faq[i].addEventListener("click", function() {
                /* Toggle between adding and removing the "active" class,
                to highlight the button that controls the panel */
                this.classList.toggle("active");

                /* Toggle between hiding and showing the active panel */
                var body = this.nextElementSibling;
                if (body.style.display === "block") {
                    body.style.display = "none";
                } else {
                    body.style.display = "block";
                }
            });
        }
    </script>






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