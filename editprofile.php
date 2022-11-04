<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="registerform.css" rel="stylesheet">
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
    if (!isset($_SESSION["tailorid"])) {
        echo "Nothing Found";
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
        $requiredFields = array("name", "phone", "password", "email", "dob", "cnic", "country", "city", "province", "postal", "address", "abouttailor", "tdesc", "daysorder", "tprice");
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
                    $_SESSION['stimage'] = $_FILES['image']['name'];
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
                    $_SESSION['stimg1'] = $_FILES['sample1']['name'];
                } else {
                    echo "could not upload the file";
                }
            }
            if (isset($_FILES['sample2'])) {
                $file_name = $_FILES['sample2']['name'];
                $file_tmp = $_FILES['sample2']['tmp_name'];
                if (move_uploaded_file($file_tmp, "images/" . $file_name)) {
                    echo "successfully uploaded";
                    $_SESSION['stimg2'] = $_FILES['sample2']['name'];
                } else {
                    echo "could not upload the file";
                }
            }
            if (isset($_FILES['sample3'])) {
                $file_name = $_FILES['sample3']['name'];
                $file_tmp = $_FILES['sample3']['tmp_name'];
                if (move_uploaded_file($file_tmp, "images/" . $file_name)) {
                    echo "successfully uploaded";
                    $_SESSION['stimg3'] = $_FILES['sample3']['name'];
                } else {
                    echo "could not upload the file";
                }
            }
            if (isset($_FILES['sample4'])) {
                $file_name = $_FILES['sample4']['name'];
                $file_tmp = $_FILES['sample4']['tmp_name'];
                if (move_uploaded_file($file_tmp, "images/" . $file_name)) {
                    echo "successfully uploaded";
                    $_SESSION['stimg4'] = $_FILES['sample4']['name'];
                } else {
                    echo "could not upload the file";
                }
            }
            if (isset($_FILES['sample5'])) {
                $file_name = $_FILES['sample5']['name'];
                $file_tmp = $_FILES['sample5']['tmp_name'];
                if (move_uploaded_file($file_tmp, "images/" . $file_name)) {
                    echo "successfully uploaded";
                    $_SESSION['stimg5'] = $_FILES['sample5']['name'];
                } else {
                    echo "could not upload the file";
                }
            }
            if (isset($_FILES['sample6'])) {
                $file_name = $_FILES['sample6']['name'];
                $file_tmp = $_FILES['sample6']['tmp_name'];
                if (move_uploaded_file($file_tmp, "images/" . $file_name)) {
                    echo "successfully uploaded";
                    $_SESSION['stimg6'] = $_FILES['sample6']['name'];
                } else {
                    echo "could not upload the file";
                }
            }
            // echo '<br>' . $_POST["name"], '<br>' . $_POST["password"], '<br>' . $_POST["email"], '<br>' . $_POST["dob"], '<br>' .  $_POST["cnic"], '<br>' . $_POST["country"], '<br>' . $_POST["city"], '<br>' . $_POST["province"], '<br>' . $_POST["postal"], '<br>' . $_POST["address"], '<br>' . $_POST["tprice"], '<br>' . $_POST["tdesc"], '<br>' . $_SESSION['stimage'], '<br>' . $_POST["abouttailor"], '<br>' . $_POST["phone"], '<br>' . $_POST["daysorder"], '<br>' . $_SESSION['stimg1'], '<br>' . $_SESSION['stimg2'], '<br>' . $_SESSION['stimg3'], '<br>' . $_SESSION['stimg4'], '<br>' . $_SESSION['stimg5'], '<br>' . $_SESSION['stimg6'], '<br>' . $_POST["whatsincluded"];
            //     $stid=$_SESSION['tailorid'];
            //     $query="UPDATE tailoruser SET tname=?, password=?, email=?, dob=?, cnic=?, country=?, city=?, province=?, postal=?, address=?, tprice=?, tdesc=?, timg=?, abouttailor=?, phone=?, daysoforder=?, img1=?, img2=?, img3=?, img4=?, img5=?, img6=?, whatincluded=?  WHERE pid=$stid";
            // $stmt=$db->prepare($query);
            // $stmt->bind_param('sssssssssssssssssssssss', $_POST['name'], $_POST['password'], $_POST['email'], $_POST['dob'], $_POST['cnic'], $_POST['country'], $_POST['city'], $_POST['province'], $_POST['postal'], $_POST['address'], $_POST['tprice'], $_POST['tdesc'], $_FILES['image']['name'], $_POST['abouttailor'], $_POST['phone'], $_POST['daysorder'], $_FILES['sample1']['name'], $_FILES['sample2']['name'], $_FILES['sample3']['name'], $_FILES['sample4']['name'], $_FILES['sample5']['name'], $_FILES['sample6']['name'], $_POST['whatsincluded']);
            // $stmt->execute();
            // if($stmt->affected_rows>0){
            //     echo 'product get updated in the database';
            // // header('Location: mainprofile.php');
            // }
            // else{
            //     echo 'an error has been occur';
            //     exit;
            // }


            @$db = new mysqli('localhost', "root", "", "final year project");
            if (mysqli_connect_errno()) {
                echo 'Connection error: ' . $db->connect_errno;
                exit;
            }
            $query = "INSERT INTO tailoruser (tname, tpassword, email, dob, cnic, country, city, province, postal, address, tprice, tdesc, timg, abouttailor, phone, daysoforder, img1, img2, img3, img4, img5, img6, whatincluded) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($query);
            $stmt->bind_param('sssssssssssssssssssssss', $_POST["name"], $_POST["password"], $_POST["email"], $_POST["dob"],  $_POST["cnic"], $_POST["country"], $_POST["city"], $_POST["province"], $_POST["postal"], $_POST["address"], $_POST["tprice"], $_POST["tdesc"], $_SESSION['stimage'], $_POST["abouttailor"], $_POST["phone"], $_POST["daysorder"], $_SESSION['stimg1'], $_SESSION['stimg2'], $_SESSION['stimg3'], $_SESSION['stimg4'], $_SESSION['stimg5'], $_SESSION['stimg6'], $_POST["whatsincluded"]);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                $stid = $_SESSION['tailorid'];
                $query = "DELETE FROM tailoruser WHERE tid=$stid";
                $stmt = $db->prepare($query);
                $stmt->execute();
                if ($stmt->affected_rows > 0) {
                    header('Location: mainprofile.php');
                } else {
                    echo 'an error has been occur <br>';
                    exit;
                }
            } else {
                echo "<p>An error has occurred.<br/> The details was not added.</p>";
            }
        }
    }

    function displayForm($missingFields)
    {
        @$db = new mysqli('localhost', "root", "", "final year project");
        if (mysqli_connect_errno()) {
            echo 'Connection error: ' . $db->connect_errno;
            exit;
        }
        $stid = $_SESSION['tailorid'];
        $query = "SELECT tid, tname, phone, tpassword, email, dob, cnic, country, city, province, postal, address, tprice, tdesc, abouttailor, daysoforder, whatincluded, timg, img1, img2, img3, img4, img5, img6 FROM tailoruser WHERE tid=$stid";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($dtid, $dtname, $dtphone, $dtpassword, $dtemail, $dtdob, $dtcnic, $dtcountry, $dtcity, $dtprovince, $dtpostal, $dtaddress, $dttprice, $dttdesc, $dtabouttailor, $dtdaysoforder, $dtwhatincluded, $dttimg, $dtimg1, $dtimg2, $dtimg3, $dtimg4, $dtimg5, $dtimg6);
        while ($stmt->fetch()) {
            $_SESSION['stimage'] = $dttimg;
            $_SESSION['stimg1'] = $dtimg1;
            $_SESSION['stimg2'] = $dtimg2;
            $_SESSION['stimg3'] = $dtimg3;
            $_SESSION['stimg4'] = $dtimg4;
            $_SESSION['stimg5'] = $dtimg5;
            $_SESSION['stimg6'] = $dtimg6;
    ?>
            <div class="bgimg">
                <div class="container">
                    <h1>Make changes in profile</h1>
                    <?php if ($missingFields) { ?>
                        <p class="error">Filling Highlighted fields are mandatory</p>
                    <?php } ?>
                    <form action="editprofile.php" method="post" enctype="multipart/form-data">
                        <div class="formimg">
                            <p>Profile Image</p>
                            <input type="file" name="image" id="">
                        </div>
                        <div class="form">
                            <input type="text" name="name" placeholder="Enter your Name " <?php validateField("name", $missingFields) ?> value="<?php echo $dtname ?>">
                        </div>
                        <div class="form">
                            <input type="password" name="password" placeholder="Enter your password" value="<?php echo $dtpassword ?>" <?php if ($missingFields) echo ' class="error"' ?>>
                            <?php if ($missingFields) { ?><p style="font-size: 63%; color:red; margin: 0 7.4%; ">* Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.</p><?php } ?>
                        </div>
                        <div class="form">
                            <input type="text" name="phone" pattern="^92[0-9]{10}$" placeholder="Enter your Phone NO (92xxxxxxxxxx)" <?php validateField("phone", $missingFields) ?> value="<?php echo $dtphone ?>">
                        </div>
                        <div class="form">
                            <input type="email" name="email" placeholder="Enter your Email" <?php validateField("email", $missingFields) ?> value="<?php echo $dtemail ?>">
                        </div>
                        <div class="form">
                            <input type="text" name="cnic" pattern="^[0-9]{5}-[0-9]{7}-[0-9]$" placeholder="Enter your CNIC" <?php validateField("cnic", $missingFields) ?> value="<?php echo $dtcnic ?>">
                        </div>
                        <div class="form">
                            <input type="text" name="dob" pattern="^[0-9]{2}-[0-9]{2}-[0-9]{4}$" placeholder="Enter your Date of Birth (date-month-year)" <?php validateField("dob", $missingFields) ?> value="<?php echo $dtdob ?>">
                        </div>
                        <div class="form1">
                            <input type="text" name="country" placeholder="Enter your Country" <?php validateField("country", $missingFields) ?> value="<?php echo $dtcountry ?>">
                        </div>
                        <div class="form1">
                            <input type="text" name="city" placeholder="Enter your City" <?php validateField("city", $missingFields) ?> value="<?php echo $dtcity; ?>">
                        </div>
                        <div class="form1">
                            <input type="text" name="province" placeholder="Enter your Province" <?php validateField("province", $missingFields) ?> value="<?php echo $dtprovince ?>">
                        </div>
                        <div class="form1">
                            <input type="text" name="postal" placeholder="Enter your Postal Code" <?php validateField("postal", $missingFields) ?> value="<?php echo $dtpostal; ?>">
                        </div>
                        <div class="form">
                            <textarea name="address" id="address" cols="30" rows="2" <?php validateField("address", $missingFields) ?> placeholder="Enter your Address"><?php echo $dtaddress; ?></textarea>
                        </div>
                        <h3 class="headh3">About Profile:</h3>
                        <div class="form">
                            <input type="text" name="tprice" placeholder="Enter your charges for service" <?php validateField("tprice", $missingFields) ?> value="<?php echo $dttprice ?>">
                        </div>
                        <div class="form">
                            <input type="text" name="daysorder" placeholder="Enter Total Days to Get Order Done" <?php validateField("daysorder", $missingFields) ?> value="<?php echo $dtdaysoforder ?>">
                        </div>
                        <div class="form">
                            <textarea name="tdesc" id="tdesc" cols="30" rows="2" <?php validateField("tdesc", $missingFields) ?> placeholder="Enter your Profile Title"><?php echo $dttdesc ?></textarea>
                        </div>
                        <div class="form" style="margin-top: 2%;">
                            <textarea name="abouttailor" id="abouttailor" cols="30" rows="2" <?php validateField("abouttailor", $missingFields) ?> placeholder="Enter your Profile Description"><?php echo $dtabouttailor; ?></textarea>
                        </div>
                        <div class="form" style="margin-top: 2%;">
                            <textarea name="whatsincluded" id="whatsincluded" cols="30" rows="4" <?php validateField("whatsincluded", $missingFields) ?> placeholder="Enter Sevices Included"><?php echo $dtwhatincluded; ?></textarea>
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
                        <input class="submit" type="submit" name="submit" value="Apply Changes">
                    </form>

                </div>
            </div>

    <?php
        }
    }
    ?>







    <script src="extra.js"></script>
</body>

</html>