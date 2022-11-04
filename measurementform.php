<?php session_start();
$_SESSION['tid'];
$_SESSION['custname'];
$_SESSION['cid']; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="measurementformcss.css" rel="stylesheet">
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









    </div>

    <?php
    if (!isset($_POST["gender"]) or !isset($_SESSION['custname'])) {
        echo "Nothing Found";
        exit;
    }
    $_SESSION["custgenderorder"] = $_POST["gender"];
    if (isset($_POST["submit"])) {
        processForm();
    } else {
        displayForm(array());
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
        $missingFields = array();
        $requiredFields = array("waist", "hips", "crotch", "plength", "cuff", "thigh");

        if ($_POST["gender"] == "male") {
            array_push($requiredFields, "fullshoulder", "sleeves", "chest", "stomach", "length", "front", "back", "neck");
        }
        if ($_POST["gender"] == "female") {
            array_push($requiredFields, "wshoulder", "wfrontlength", "wjacketlength", "wskirt", "wdresslength", "wbacklength", "wcuff", "wcenters", "warmhole", "wupperchest");
        }

        foreach ($requiredFields as $requiredField) {
            if (!isset($_POST[$requiredField]) or !$_POST[$requiredField]) {
                $missingFields[] = $requiredField;
            }
        }

        if ($missingFields) {
            displayForm($missingFields);
        } else {
            @$db = new mysqli('localhost', "root", "", "final year project");
            if (mysqli_connect_errno()) {
                echo 'Connection error: ' . $db->connect_errno;
                exit;
            }
            if ($_POST["gender"] == 'male') {
                // echo $_POST["gender"];
                $query = "INSERT INTO measurement (custname, gender, fullshoulder, sleeves, chest, stomach, length, front, back, neck, waist, hips, crotch, plength, cuff, thigh) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $db->prepare($query);
                $stmt->bind_param('ssssssssssssssss', $_SESSION["custname"], $_POST["gender"], $_POST["fullshoulder"], $_POST["sleeves"], $_POST["chest"], $_POST["stomach"], $_POST["length"], $_POST["front"], $_POST["back"], $_POST["neck"], $_POST["waist"], $_POST["hips"], $_POST["crotch"], $_POST["plength"], $_POST["cuff"], $_POST["thigh"]);
                $stmt->execute();
                if ($stmt->affected_rows > 0) {
                    $last_id = $db->insert_id;
                    echo "New record created successfully. Last inserted ID is: " . $last_id;
                    $_SESSION["measurementidcust"] = $last_id;
                    header('Location: fabricselect.php');
                } else {
                    echo "<p>An error has occurred.<br/> The item was not added.</p>";
                }
            } elseif ($_POST["gender"] == 'female') {
                $query = "INSERT INTO measurement (custname, gender, waist, hips, crotch, plength, cuff, thigh, wshoulder, wfrontlenfth, wjacketlength, wskirt, wdresslength, wbacklength, wcuff, wcenters, warmhole, wupperchest) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $db->prepare($query);
                $stmt->bind_param('ssssssssssssssssss', $_SESSION["custname"], $_POST["gender"], $_POST["waist"], $_POST["hips"], $_POST["crotch"], $_POST["plength"], $_POST["cuff"], $_POST["thigh"], $_POST["wshoulder"], $_POST["wfrontlength"], $_POST["wjacketlength"], $_POST["wskirt"], $_POST["wdresslength"], $_POST["wbacklength"], $_POST["wcuff"], $_POST["wcenters"], $_POST["warmhole"], $_POST["wupperchest"]);
                $stmt->execute();
                if ($stmt->affected_rows > 0) {
                    $last_id = $db->insert_id;
                    echo "New record created successfully. Last inserted ID is: " . $last_id;
                    $_SESSION["measurementidcust"] = $last_id;
                    header('Location: fabricselect.php');
                } else {
                    echo "<p>An error has occurred.<br/> The item was not added.</p>";
                }
            }
        }
    }

    function displayForm($missingFields)
    {
        $gender = $_POST['gender']; ?>
        <div class="container">
            <h1>DRESS MEASUREMENTS
                <?php if ($gender == "male") { ?>
                    FOR MALE
                <?php }
                if ($gender == "female") { ?>
                    FOR FEMALE
                <?php } ?>
            </h1>
            <?php if ($missingFields) { ?>
                <p class="error">Filling in all the fields are mandatory</p>
            <?php } ?>
            <form action="measurementform.php" method="post" class="formmea">
                <?php if ($gender == "male") { ?>
                    <div class="form">
                        <table width="100%">
                            <tr>
                                <td rowspan="2" width="22%"><img src="fullShoulder.gif" alt="picture error"></td>
                                <td class="descrip">Measure back at end of shoulders.</td>
                            </tr>
                            <tr>
                                <td><input type="number" min="0" step="0.1" name="fullshoulder" <?php validateField("fullshoulder", $missingFields) ?> placeholder="Full Shoulder" value="<?php setValue("fullshoulder"); ?>"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="form">
                        <table width="100%">
                            <tr>
                                <td rowspan="2" width="22%"><img src="sleaves.gif" alt="picture error"></td>
                                <td class="descrip">Measure sleeves from shoulder seam to length desired.</td>
                            </tr>
                            <tr>
                                <td><input type="number" min="0" step="0.1" name="sleeves" id="" <?php validateField("sleeves", $missingFields) ?> placeholder="Sleeves" value="<?php setValue("sleeves"); ?>"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="form">
                        <table width="100%">
                            <tr>
                                <td rowspan="2" width="22%"><img src="chest.gif" alt="picture error"></td>
                                <td class="descrip">Measure around Body well up under arm holes.</td>
                            </tr>
                            <tr>
                                <td><input type="number" min="0" step="0.1" name="chest" id="" <?php validateField("chest", $missingFields) ?> placeholder="Chest" value="<?php setValue("chest"); ?>"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="form">
                        <table width="100%">
                            <tr>
                                <td rowspan="2" width="22%"><img src="stomach.gif" alt="picture error"></td>
                                <td class="descrip">Measure around stomach line.</td>
                            </tr>
                            <tr>
                                <td><input type="number" min="0" step="0.1" name="stomach" id="" <?php validateField("stomach", $missingFields) ?> placeholder="Stomach" value="<?php setValue("stomach"); ?>"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="form">
                        <table width="100%">
                            <tr>
                                <td rowspan="2" width="22%"><img src="length.gif" alt="picture error"></td>
                                <td class="descrip">Measure from lower collar seam to length desired.</td>
                            </tr>
                            <tr>
                                <td><input type="number" min="0" step="0.1" name="length" id="" <?php validateField("length", $missingFields) ?> placeholder="Length" value="<?php setValue("length"); ?>"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="form">
                        <table width="100%">
                            <tr>
                                <td rowspan="2" width="22%"><img src="front.gif" alt="picture error"></td>
                                <td class="descrip">Measure from one armhole to other armhole in front.</td>
                            </tr>
                            <tr>
                                <td><input type="number" min="0" step="0.1" name="front" id="" <?php validateField("front", $missingFields) ?> placeholder="Front" value="<?php setValue("front"); ?>"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="form">
                        <table width="100%">
                            <tr>
                                <td rowspan="2" width="22%"><img src="back.gif" alt="picture error"></td>
                                <td class="descrip">Measure from one armhole to other armhole at Back.</td>
                            </tr>
                            <tr>
                                <td><input type="number" min="0" step="0.1" name="back" id="" <?php validateField("back", $missingFields) ?> placeholder="Back" value="<?php setValue("back"); ?>"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="form">
                        <table width="100%">
                            <tr>
                                <td rowspan="2" width="22%"><img src="neck.gif" alt="picture error"></td>
                                <td class="descrip">Measure around the Neck.</td>
                            </tr>
                            <tr>
                                <td><input type="number" min="0" step="0.1" name="neck" id="" <?php validateField("neck", $missingFields) ?> placeholder="Neck" value="<?php setValue("neck"); ?>"></td>
                            </tr>
                        </table>
                    </div>

                <?php } ?>






                <?php if ($gender == "female") { ?>
                    <div class="form">
                        <table width="100%">
                            <tr>
                                <td rowspan="2" width="22%"><img src="wshoulder.gif" alt="picture error"></td>
                                <td class="descrip">From shoulder seam to bust.</td>
                            </tr>
                            <tr>
                                <td><input type="number" min="0" step="0.1" name="wshoulder" id="" <?php validateField("wshoulder", $missingFields) ?> placeholder="Shoulder/Bust" value="<?php setValue("wshoulder"); ?>"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="form">
                        <table width="100%">
                            <tr>
                                <td rowspan="2" width="22%"><img src="wfrontlength.gif" alt="picture error"></td>
                                <td class="descrip">From shoulder seam to waist.</td>
                            </tr>
                            <tr>
                                <td><input type="number" min="0" step="0.1" name="wfrontlength" id="" <?php validateField("wfrontlength", $missingFields) ?> placeholder="Front Length" value="<?php setValue("wfrontlength"); ?>"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="form">
                        <table width="100%">
                            <tr>
                                <td rowspan="2" width="22%"><img src="wjacketlength.gif" alt="picture error"></td>
                                <td class="descrip">Shoulder seam to jacket length.</td>
                            </tr>
                            <tr>
                                <td><input type="number" min="0" step="0.1" name="wjacketlength" id="" <?php validateField("wjacketlength", $missingFields) ?> placeholder="Jacket Length" value="<?php setValue("wjacketlength"); ?>"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="form">
                        <table width="100%">
                            <tr>
                                <td rowspan="2" width="22%"><img src="wskirt.gif" alt="picture error"></td>
                                <td class="descrip">From waist to skirt length.</td>
                            </tr>
                            <tr>
                                <td><input type="number" min="0" step="0.1" name="wskirt" id="" <?php validateField("wskirt", $missingFields) ?> placeholder="Skirt" value="<?php setValue("wskirt"); ?>"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="form">
                        <table width="100%">
                            <tr>
                                <td rowspan="2" width="22%"><img src="wdresslength.gif" alt="picture error"></td>
                                <td class="descrip">From shoulder seam to bottom.</td>
                            </tr>
                            <tr>
                                <td><input type="number" min="0" step="0.1" name="wdresslength" id="" <?php validateField("wdresslength", $missingFields) ?> placeholder="Dress Length" value="<?php setValue("wdresslength"); ?>"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="form">
                        <table width="100%">
                            <tr>
                                <td rowspan="2" width="22%"><img src="wbacklenght.gif" alt="picture error"></td>
                                <td class="descrip">Center shoulder to back waist.</td>
                            </tr>
                            <tr>
                                <td><input type="number" min="0" step="0.1" name="wbacklength" id="" <?php validateField("wbacklength", $missingFields) ?> placeholder="BackLength" value="<?php setValue("wbacklength"); ?>"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="form">
                        <table width="100%">
                            <tr>
                                <td rowspan="2" width="22%"><img src="wcuff.gif" alt="picture error"></td>
                                <td class="descrip">Measure width around cuff.</td>
                            </tr>
                            <tr>
                                <td><input type="number" min="0" step="0.1" name="wcuff" id="" <?php validateField("wcuff", $missingFields) ?> placeholder="Cuff" value="<?php setValue("wcuff"); ?>"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="form">
                        <table width="100%">
                            <tr>
                                <td rowspan="2" width="22%"><img src="wcenters.gif" alt="picture error"></td>
                                <td class="descrip">Measure busts center to center.</td>
                            </tr>
                            <tr>
                                <td><input type="number" min="0" step="0.1" name="wcenters" id="" <?php validateField("wcenters", $missingFields) ?> placeholder="Centers" value="<?php setValue("wcenters"); ?>"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="form">
                        <table width="100%">
                            <tr>
                                <td rowspan="2" width="22%"><img src="warmhole.gif" alt="picture error"></td>
                                <td class="descrip">Measure around the armhole.</td>
                            </tr>
                            <tr>
                                <td><input type="number" min="0" step="0.1" name="warmhole" id="" <?php validateField("warmhole", $missingFields) ?> placeholder="Armhole" value="<?php setValue("warmhole"); ?>"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="form">
                        <table width="100%">
                            <tr>
                                <td rowspan="2" width="22%"><img src="wupperchest.gif" alt="picture error"></td>
                                <td class="descrip">Around snug-up the armholes.</td>
                            </tr>
                            <tr>
                                <td><input type="number" min="0" step="0.1" name="wupperchest" id="" <?php validateField("wupperchest", $missingFields) ?> placeholder="Upper Chest" value="<?php setValue("wupperchest"); ?>"></td>
                            </tr>
                        </table>
                    </div>

                <?php } ?>

                <div class="form">
                    <table width="100%">
                        <tr>
                            <td rowspan="2" width="22%"><img src="waist.gif" alt="picture error"></td>
                            <td class="descrip">Measure around Waist Line.</td>
                        </tr>
                        <tr>
                            <td><input type="number" min="0" step="0.1" name="waist" id="" placeholder="Waist" <?php validateField("waist", $missingFields) ?> value="<?php setValue("waist"); ?>"></td>
                        </tr>
                    </table>
                </div>
                <div class="form">
                    <table width="100%">
                        <tr>
                            <td rowspan="2" width="22%"><img src="hips.gif" alt="picture error"></td>
                            <td class="descrip">Measure around Hips at widest poit of seat but not tight.</td>
                        </tr>
                        <tr>
                            <td><input type="number" min="0" step="0.1" name="hips" id="" <?php validateField("hips", $missingFields) ?> placeholder="Hips" value="<?php setValue("hips"); ?>"></td>
                        </tr>
                    </table>

                </div>
                <div class="form">
                    <table width="100%">
                        <tr>
                            <td rowspan="2" width="22%"><img src="crotch.gif" alt="picture error"></td>
                            <td class="descrip">Measure from center front Waist under legs to center back Waist.</td>
                        </tr>
                        <tr>
                            <td><input type="number" min="0" step="0.1" name="crotch" id="" <?php validateField("crotch", $missingFields) ?> placeholder="Crotch" value="<?php setValue("crotch"); ?>"></td>
                        </tr>
                    </table>

                </div>
                <div class="form">
                    <table width="100%">
                        <tr>
                            <td rowspan="2" width="22%"><img src="plength.gif" alt="picture error"></td>
                            <td class="descrip">Measure from top of Waist band to bottom of cuff.</td>
                        </tr>
                        <tr>
                            <td><input type="number" min="0" step="0.1" name="plength" id="" <?php validateField("plength", $missingFields) ?> placeholder="Length" value="<?php setValue("plength"); ?>"></td>
                        </tr>
                    </table>

                </div>
                <div class="form">
                    <table width="100%">
                        <tr>
                            <td rowspan="2" width="22%"><img src="cuff.gif" alt="picture error"></td>
                            <td class="descrip">Measure width around cuff.</td>
                        </tr>
                        <tr>
                            <td><input type="number" min="0" step="0.1" name="cuff" id="" <?php validateField("cuff", $missingFields) ?> placeholder="Cuff" value="<?php setValue("cuff"); ?>"></td>
                        </tr>
                    </table>

                </div>
                <div class="form">
                    <table width="100%">
                        <tr>
                            <td rowspan="2" width="22%"><img src="thigh.gif" alt="picture error"></td>
                            <td class="descrip">Measure width around thigh.</td>
                        </tr>
                        <tr>
                            <td><input type="number" min="0" step="0.1" name="thigh" id="" <?php validateField("thigh", $missingFields) ?> placeholder="Thigh" value="<?php setValue("thigh"); ?>"></td>
                        </tr>
                    </table>
                </div>


                <input type="hidden" name="gender" id="gender" value="<?php echo $_POST['gender'] ?>">
                <input class="submit" type="submit" name="submit" value="SUBMIT">
            </form>
        </div>

    <?php
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