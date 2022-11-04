<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="registerformcss.css" rel="stylesheet">
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
        header("Location: category.html");
        exit;
    }
    if (isset($_POST["submit"])) {
        processForm();
    } else {
        displayForm(array());
    }

    function validateField($fieldName, $missingFields)
    {
        if (in_array($fieldName, $missingFields)) {
            echo ' class="error"';
        }
    }

    function setValue($fieldName)
    {
        if (isset($_POST[$fieldName])) {
            echo $_POST[$fieldName];
        }
    }

    function setChecked($fieldName, $fieldValue)
    {
        if (isset($_POST[$fieldName]) and $_POST[$fieldName] == $fieldValue) {
            echo ' checked="checked"';
        }
    }

    function processForm()
    {
        $missingFields = array();
        $requiredFields = array("name", "phone", "password", "email", "dob", "check");
        if ($_POST["user"] == "tailor") {
            array_push($requiredFields, "cnic", "country", "city", "province", "postal", "address" , "abouttailor", "tdesc", "daysorder", "tprice");
        }
        if ($_POST["user"] == "delivery") {
            array_push($requiredFields, "vtype", "vno", "cnic", "gender", "country", "city", "province", "postal", "address");
        }
        foreach ($requiredFields as $requiredField) {
            if (!isset($_POST[$requiredField]) or !$_POST[$requiredField]) {
                $missingFields[] = $requiredField;
            } elseif ($requiredField == 'password') {
                $password = $_POST['password'];
                $number = preg_match('@[0-9]@', $password);
                $uppercase = preg_match('@[A-Z]@', $password);
                $lowercase = preg_match('@[a-z]@', $password);
                $specialChars = preg_match('@[^\w]@', $password);
                if (strlen($password) < 8 || !$number || !$uppercase || !$lowercase || !$specialChars) {
                    $missingFields[] = $requiredField;
                }
            }
        }
        if ($missingFields) {
            displayForm($missingFields);
        } else {
            if (isset($_FILES['image'])) {
                $file_name = $_FILES['image']['name'];
                // $file_size=$_FILES['image']['size'];
                $file_tmp = $_FILES['image']['tmp_name'];
                // $file_type=$_FILES['image']['type'];
                if (move_uploaded_file($file_tmp, "images/" . $file_name)) {
                    echo "successfully uploaded";
                } else {
                    echo "could not upload the file";
                }
                // print_r($_FILES['image']);
            }
            if (isset($_FILES['sample1'])) {
                $file_name = $_FILES['sample1']['name'];
                $file_tmp = $_FILES['sample1']['tmp_name'];
                if (move_uploaded_file($file_tmp, "images/" . $file_name)) {
                    echo "successfully uploaded";
                } else {
                    echo "could not upload the file";
                }
            }
            if (isset($_FILES['sample2'])) {
                $file_name = $_FILES['sample2']['name'];
                $file_tmp = $_FILES['sample2']['tmp_name'];
                if (move_uploaded_file($file_tmp, "images/" . $file_name)) {
                    echo "successfully uploaded";
                } else {
                    echo "could not upload the file";
                }
            }
            if (isset($_FILES['sample3'])) {
                $file_name = $_FILES['sample3']['name'];
                $file_tmp = $_FILES['sample3']['tmp_name'];
                if (move_uploaded_file($file_tmp, "images/" . $file_name)) {
                    echo "successfully uploaded";
                } else {
                    echo "could not upload the file";
                }
            }
            if (isset($_FILES['sample4'])) {
                $file_name = $_FILES['sample4']['name'];
                $file_tmp = $_FILES['sample4']['tmp_name'];
                if (move_uploaded_file($file_tmp, "images/" . $file_name)) {
                    echo "successfully uploaded";
                } else {
                    echo "could not upload the file";
                }
            }
            if (isset($_FILES['sample5'])) {
                $file_name = $_FILES['sample5']['name'];
                $file_tmp = $_FILES['sample5']['tmp_name'];
                if (move_uploaded_file($file_tmp, "images/" . $file_name)) {
                    echo "successfully uploaded";
                } else {
                    echo "could not upload the file";
                }
            }
            if (isset($_FILES['sample6'])) {
                $file_name = $_FILES['sample6']['name'];
                $file_tmp = $_FILES['sample6']['tmp_name'];
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
            if ($_POST["user"] == 'customer') {
                $query = "INSERT INTO users (name, phone, password, email, dob) VALUES (?, ?, ?, ?, ?)";
                $stmt = $db->prepare($query);
                $stmt->bind_param('sssss', $_POST["name"], $_POST["phone"], $_POST["password"], $_POST["email"], $_POST["dob"]);
                $stmt->execute();
                if ($stmt->affected_rows > 0) {
                    header('Location: profiletailor.php');
                } else {
                    echo "<p>An error has occurred.<br/> The item was not added.</p>";
                }
            } elseif ($_POST["user"] == 'tailor') {
                // name, phone, password, email, dob, cnic, country, city, province, postal, address, category, image
                $query = "INSERT INTO tailoruser (tname, tpassword, email, dob, cnic, country, city, province, postal, address, tprice, tdesc, timg, abouttailor, phone, daysoforder, img1, img2, img3, img4, img5, img6, whatincluded) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $db->prepare($query);
                $stmt->bind_param('sssssssssssssssssssssss', $_POST["name"], $_POST["password"], $_POST["email"], $_POST["dob"],  $_POST["cnic"], $_POST["country"], $_POST["city"], $_POST["province"], $_POST["postal"], $_POST["address"], $_POST["tprice"], $_POST["tdesc"], $_FILES['image']['name'], $_POST["abouttailor"], $_POST["phone"], $_POST["daysorder"], $_FILES['sample1']['name'], $_FILES['sample2']['name'], $_FILES['sample3']['name'], $_FILES['sample4']['name'], $_FILES['sample5']['name'], $_FILES['sample6']['name'], $_POST["whatsincluded"]);
                $stmt->execute();
                if ($stmt->affected_rows > 0) {
                    header('Location: mainprofile.php?trname='.$_POST["name"].'&user='.$_POST["user"]);
                } else {
                    echo "<p>An error has occurred.<br/> The details was not added.</p>";
                }
            } elseif ($_POST["user"] == 'delivery') {
                $query = "INSERT INTO deliveryboy (name, phone, password, email, dob, vehicletype, vehicleno, cnic, gender, country, city, province, postal, address, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $db->prepare($query);
                $stmt->bind_param('sssssssssssssss', $_POST["name"], $_POST["phone"], $_POST["password"], $_POST["email"], $_POST["dob"], $_POST["vtype"], $_POST["vno"], $_POST["cnic"], $_POST["gender"], $_POST["country"], $_POST["city"], $_POST["province"], $_POST["postal"], $_POST["address"], $_FILES['image']['name']);
                $stmt->execute();
                if ($stmt->affected_rows > 0) {
                    $last_id = $db->insert_id;
                    header('Location: deliveryboyorders.php?deliveryboyid='.$last_id);
                } else {
                    echo "<p>An error has occurred.<br/> The item was not added.</p>";
                }
            }
        }
    }

    function displayForm($missingFields)
    {
        if (isset($_POST["user"])) {
            $user = $_POST["user"];
        }
        if (isset($_GET["user"])) {
            $user = $_GET["user"];
        } ?>

        <div class="bgimg">

            <div class="container">
                <h1>Registration for
                    <?php if ($user == "customer") { ?>
                        Customer
                    <?php } ?>
                    <?php if ($user == "tailor") { ?>
                        Tailor
                    <?php } ?>
                    <?php if ($user == "delivery") { ?>
                        Delivery Boy
                    <?php } ?>
                </h1>

                <?php if ($missingFields) { ?>
                    <p class="error">Filling Highlighted fields are mandatory</p>
                <?php } ?>

                <form action="registerfoam.php" method="post" enctype="multipart/form-data">
                    <?php if ($user == "delivery" or $user == "tailor") { ?>
                        <div class="formimg">
                            <p>Profile Image</p>
                            <input type="file" name="image" id="">
                        </div>
                    <?php } ?>
                    <div class="form">
                        <input type="text" name="name" placeholder="Enter your Name " <?php validateField("name", $missingFields) ?> value="<?php setValue("name"); ?>">
                    </div>
                    <div class="formpass">
                        <input type="password" name="password" id="id_password" placeholder="Enter your password" <?php if ($missingFields) echo ' class="error"' ?>>
                        <i class="far fa-eye" id="togglePassword" style="margin-left: 2%; cursor: pointer;"></i>
                        <?php if ($missingFields) { ?><p style="font-size: 63%; color:red; margin: 0 7.4%; ">* Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.</p><?php } ?>
                    </div>
                    <div class="form">
                        <input type="text" name="phone" pattern="^92[0-9]{10}$" placeholder="Enter your Phone NO (92xxxxxxxxxx)" <?php validateField("phone", $missingFields) ?> value="<?php setValue("phone"); ?>">
                    </div>
                    <div class="form">
                        <input type="email" name="email" placeholder="Enter your Email" <?php validateField("email", $missingFields) ?> value="<?php setValue("email"); ?>">
                    </div>

                    <?php if ($user == "delivery") { ?>
                        <div class="form1">
                            <input style="margin-bottom: 0px;" type="text" name="vtype" placeholder="Vehicle Type" <?php validateField("vtype", $missingFields) ?> value="<?php setValue("ctype"); ?>">
                        </div>
                        <div class="form1">
                            <input style="margin-bottom: 0px;" type="text" name="vno" placeholder="Vehicle Number" <?php validateField("vno", $missingFields) ?> value="<?php setValue("vno"); ?>">
                        </div>
                    <?php } ?>

                    <?php if ($user == "delivery" or $user == "tailor") { ?>
                        <div class="form">
                            <input type="text" name="cnic" pattern="^[0-9]{5}-[0-9]{7}-[0-9]$" placeholder="Enter your CNIC" <?php validateField("cnic", $missingFields) ?> value="<?php setValue("cnic"); ?>">
                        </div>
                    <?php } ?>

                    <div class="form">
                        <input type="text" name="dob" pattern="^[0-9]{2}-[0-9]{2}-[0-9]{4}$" placeholder="Enter your Date of Birth (date-month-year)" <?php validateField("dob", $missingFields) ?> value="<?php setValue("dob"); ?>">
                    </div>

                    <?php if ($user == "delivery") { ?>
                        <div class="form">
                            <input type="text" name="gender" placeholder="Enter your Gender" <?php validateField("gender", $missingFields) ?> value="<?php setValue("gender"); ?>">
                        </div>
                    <?php } ?>

                    <?php if ($user == "delivery" or $user == "tailor") { ?>
                        <div class="form1">
                            <input type="text" name="country" placeholder="Enter your Country" <?php validateField("country", $missingFields) ?> value="<?php setValue("country"); ?>">
                        </div>
                        <div class="form1">
                            <input type="text" name="city" placeholder="Enter your City" <?php validateField("city", $missingFields) ?> value="<?php setValue("city"); ?>">
                        </div>
                        <div class="form1">
                            <input type="text" name="province" placeholder="Enter your Province" <?php validateField("province", $missingFields) ?> value="<?php setValue("province"); ?>">
                        </div>
                        <div class="form1">
                            <input type="text" name="postal" placeholder="Enter your Postal Code" <?php validateField("postal", $missingFields) ?> value="<?php setValue("postal"); ?>">
                        </div>
                        <div class="form">
                            <textarea name="address" id="address" cols="30" rows="2" <?php validateField("address", $missingFields) ?> placeholder="Enter your Address"><?php setValue("address"); ?></textarea>
                        </div>
                    <?php } ?>
                    <?php if ($user == "tailor") { ?>
                        <h3 class="headh3">About Profile:</h3>
                        <div class="form">
                            <input type="text" name="tprice" placeholder="Enter your charges for service" <?php validateField("tprice", $missingFields) ?> value="<?php setValue("tprice"); ?>">
                        </div>
                        <div class="form">
                            <input type="text" name="daysorder" placeholder="Enter Total Days to Get Order Done" <?php validateField("daysorder", $missingFields) ?> value="<?php setValue("daysorder"); ?>">
                        </div>
                        <div class="form">
                            <textarea name="tdesc" id="tdesc" cols="30" rows="2" <?php validateField("tdesc", $missingFields) ?> placeholder="Enter your Profile Title"><?php setValue("tdesc"); ?></textarea>
                        </div>
                        <div class="form" style="margin-top: 2%;">
                            <textarea name="abouttailor" id="abouttailor" cols="30" rows="2" <?php validateField("abouttailor", $missingFields) ?> placeholder="Enter your Profile Description"><?php setValue("abouttailor"); ?></textarea>
                        </div>
                        <div class="form" style="margin-top: 2%;">
                            <textarea name="whatsincluded" id="whatsincluded" cols="30" rows="4" <?php validateField("whatsincluded", $missingFields) ?> placeholder="Enter Sevices Included"><?php setValue("whatsincluded"); ?></textarea>
                        </div>
                        <h3 class="headh3">Give Sample Of Your Work:</h3>
                        <div class="sampleimg">
                            <h4>Sample 1</h4>
                            <input type="file" name="sample1" id="">
                        </div>
                        <div class="sampleimg">
                            <h4>Sample 2</h4>
                            <input type="file" name="sample2" id="">
                        </div>
                        <div class="sampleimg">
                            <h4>Sample 3</h4>
                            <input type="file" name="sample3" id="">
                        </div>
                        <div class="sampleimg">
                            <h4>Sample 4</h4>
                            <input type="file" name="sample4" id="">
                        </div>
                        <div class="sampleimg">
                            <h4>Sample 5</h4>
                            <input type="file" name="sample5" id="">
                        </div>
                        <div class="sampleimg">
                            <h4>Sample 6</h4>
                            <input type="file" name="sample6" id="">
                        </div>
                    <?php } ?>
                    <input type="hidden" name="user" id="user" value="<?php echo $user; ?>">
                    <div class="formch">
                        <input type="checkbox" name="check" id="check" value="yes" <?php setChecked("check", "yes") ?>>
                        <label for="check" <?php validateField("check", $missingFields) ?>>I have read and accept the <a href="termsandconditions.html" style="color: red;">Terms & Conditions</a></label>
                    </div>
                    <input class="submit" type="submit" name="submit" value="Register Now">
                    <div class="alreadyacc">Already have an account? <a style="text-decoration: none; color: red;" href="loginform.php?user=<?php echo $user ?>">Sign In</a></div>
                </form>

            </div>
        </div>

    <?php
    }
    ?>

    <!-- <script src="extra.js"></script> -->
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