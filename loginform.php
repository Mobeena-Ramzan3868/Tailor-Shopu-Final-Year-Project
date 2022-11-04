<?php
// session_start();
// session_destroy();
session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loginform.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Andada+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

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
    if (!isset($_GET["user"]) and !isset($_POST["user"])) {
        echo "Nothing Found";
        header('location:categorylogin.html');
        exit;
    }
    if (isset($_POST["submit"])) {
        processForm();
    } else {
        displayForm(array(), false);
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
        $requiredFields = array("email", "password");
        $missingFields = array();
        $wrongfield = false;

        foreach ($requiredFields as $requiredField) {
            if (!isset($_POST[$requiredField]) or !$_POST[$requiredField]) {
                $missingFields[] = $requiredField;
            }
        }



        $db = new mysqli('localhost', 'root', '', 'final year project');
        if (mysqli_connect_errno()) {
            echo 'connection error: ' . $db->connect_errno;
            exit;
        }
        if (isset($_POST["user"])) {
            $user = $_POST["user"];
        }
        if (isset($_GET["user"])) {
            $user = $_GET["user"];
        }
        if ($user == "customer") {
            $query = "SELECT id, name, phone, password, email FROM users WHERE password=? AND email=?";
        }
        if ($user == "tailor") {
            $query = "SELECT tid, tname, phone, tpassword, email FROM tailoruser WHERE tpassword=? AND email=?";
        }
        if ($user == "delivery") {
            $query = "SELECT id, name, phone, password, email FROM deliveryboy WHERE password=? AND email=?";
        }
        if ($user == "admin") {
            $query = "SELECT aid, aname, aphone, apassword, aemail FROM admindetail WHERE apassword=? AND aemail=?";
        }
        $stmt = $db->prepare($query);
        $stmt->bind_param('ss', $_POST['password'], $_POST['email']);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $cname, $phone, $password, $email);
        while ($stmt->fetch()) {
            if ($user == "delivery") {
                $deliveryboyid = $id;
            }
            if ($user == "customer") {
                $_SESSION['cid'] = $id;
                $_SESSION['custname'] = $cname;
                // $_SESSION['custphone'] = $phone;
            }
        }

        // echo '<h2 align=center>number of product found'.$stmt->num_rows.'</h2>';
        if ($stmt->num_rows <= 0) {
            $wrongfield = true;
        }
        if ($missingFields) {
            displayForm($missingFields, $wrongfield);
        } elseif ($wrongfield == true) {
            displayForm($missingFields, $wrongfield);
        } else {
            if ($user == "customer") {
                if (isset($_POST['messfrom'])) {
                    header('Location: chatbox.php?tid='.$_POST['tid'].'&cid='.$id.'&messfrom='.$_POST['messfrom']);
                }else if(isset($_GET['statuscont'])){
                    header('Location: middlepage.php');
                } else {
                    header("Location:recordprocessing.php?custid=" . $id);
                }
            }
            if ($user == "tailor") {
                $_SESSION["tailorid"] = $id;
                $_SESSION["tailoremail"] = $_POST["email"];
                $_SESSION["tailorpassword"] = $_POST["password"];
                $_SESSION["tailoruse"] = $_POST["user"];
                header('Location: mainprofile.php');
            }
            if ($user == "delivery") {
                header('Location: deliveryboyorders.php?deliveryboyid=' . $deliveryboyid);
            }
            if ($user == "admin") {
                header('Location: admin.php');
            }
        }
    }


    function displayForm($missingFields, $wrongfield)
    {
        if (isset($_POST["user"])) {
            $user = $_POST["user"];
        }
        if (isset($_GET["user"])) {
            $user = $_GET["user"];
        }
    ?>
        <div class="bgimg">
            <div class="container">
                <h1>LOGIN DETAILS</h1>
                <form action="loginform.php<?php if (isset($_GET['statuscont'])) { ?>?statuscont=checkoutcont <?php } ?>" method="post">
                    <?php if ($missingFields) { ?>
                        <p class="error">Entering name email and password is mandatory in the fields</p>
                    <?php }
                    if ($wrongfield == true) { ?>
                        <p class="error">Password or email is wrong</p>
                    <?php } ?>
                    <div class="form">
                        <input type="email" name="email" id="" placeholder="Enter your email address " <?php validateField("email", $missingFields) ?> value="<?php setValue("email"); ?>">
                    </div>
                    <div class="formpass">
                        <input type="password" name="password" id="id_password" placeholder="Enter your password " <?php validateField("password", $missingFields) ?> value="<?php setValue("password"); ?>">
                        <i class="far fa-eye" id="togglePassword" style="margin-left: 2%; cursor: pointer;"></i>
                    </div>
                    <input type="hidden" name="user" id="user" value="<?php echo $user; ?>">
                    <?php if(isset($_GET['messfrom'])){ ?>
                        <input type="hidden" name="tid" id="tid" value="<?php echo $_GET['tid']; ?>">
                        <input type="hidden" name="messfrom" id="messfrom" value="<?php echo $_GET['messfrom']; ?>">
                        <?php }?>
                    <input type="hidden" name="user" id="user" value="<?php echo $user; ?>">
                    <input class="submit" type="submit" name="submit" value="LOGIN">
                    <?php if ($user != 'admin') { ?>
                        <div class="alreadyacc">Don't have an account? <a style="text-decoration: none; color: red;" href="registerfoam.php?user=<?php echo $user ?>">Sign Up</a></div>
                    <?php } ?>
                </form>
            </div>
        </div>
    <?php
    }
    ?>
    <script>
        function topFunction() {
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        }

        function leftFunction() {
            document.getElementById("navbar").style.display = "none";
            document.getElementById("Closenavbar").style.display = "flex";
        }

        function closeFunction() {
            document.getElementById("navbar").style.display = "flex";
            document.getElementById("Closenavbar").style.display = "none";
        }
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#id_password');

        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>