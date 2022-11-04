<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="60">
    </meta>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Tailor Shopu</title>
    <link rel="stylesheet" href="chatboxc.css">
    <script src="https://kit.fontawesome.com/afd6aa68df.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        <!-- <div class="close">
            <button id="Close" onclick="closeFunction()"><img id="imgclose" src="right-chevron.png"></button>
        </div> -->
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
    if (isset($_GET['tid']) and isset($_GET['cid']) and isset($_GET['messfrom'])) { ?>
        <!-- <table class="headtab">
            <tr>
                <th class="head">Tailor</th>
                <th class="head">Customer</th>
            </tr>
        </table> -->
        <?php
        $gtid = $_GET['tid'];
        $gcid = $_GET['cid'];
        $getmessfrom = $_GET['messfrom'];
        @$db = new mysqli('localhost', "root", "", "final year project");
        if (mysqli_connect_errno()) {
            echo 'Connection error: ' . $db->connect_errno;
            exit;
        }
        $query1 = "SELECT id, tailorid, custid, message, messagefrom, date, time FROM chat";
        $stmto = $db->prepare($query1);
        $stmto->execute();
        $stmto->store_result();
        $stmto->bind_result($id, $tailorid, $custid, $message, $messagefrom, $cdate, $ctime);
        echo "<div class='messdiv'>";
        while ($stmto->fetch()) {
            // echo $id, $tailorid, $custid, $message, $messagefrom;
            if (($gcid == $custid) and ($gtid == $tailorid)) {
                // echo $message;
                if ($getmessfrom == "customer") {
                    if ($messagefrom == "tailor") { ?>
                        <div class="tmess">
                            <div class="tinnermess">
                                <?php echo $message ?> <br>
                                <!-- <span class="tmessdate"><?php echo $cdate ?></span> -->
                                <span class="tmesstime"><?php echo $ctime ?></span>
                            </div>
                        </div>
                    <?php }
                    if ($messagefrom == "customer") { ?>
                        <div class="cmess">
                            <div class="cinnermess">
                                <?php echo $message ?> <br>
                                <!-- <span class="cmessdate"><?php echo $cdate ?></span> -->
                                <span class="cmesstime"><?php echo $ctime ?></span>
                            </div>
                        </div>
        <?php
                    }
                }
                if($getmessfrom=="tailor"){
                    if ($messagefrom == "customer") { ?>
                        <div class="tmess">
                            <div class="tinnermess">
                                <?php echo $message ?> <br>
                                <!-- <span class="tmessdate"><?php echo $cdate ?></span> -->
                                <span class="tmesstime"><?php echo $ctime ?></span>
                            </div>
                        </div>
                    <?php }
                    if ($messagefrom == "tailor") { ?>
                        <div class="cmess">
                            <div class="cinnermess">
                                <?php echo $message ?> <br>
                                <!-- <span class="cmessdate"><?php echo $cdate ?></span> -->
                                <span class="cmesstime"><?php echo $ctime ?></span>
                            </div>
                        </div>
        <?php
                    }
                }
            }
        }
        ?>
        </div>
        <form action="postchat.php?tid=<?php echo $gtid; ?>&cid=<?php echo $gcid; ?>&messfrom=<?php echo $getmessfrom; ?>" class="formchat" method="post">
            <input class="inputmess" type="text" name="message" id="message">
            <button class="btnmess" type="submit" name="submit"><i class="material-icons" style="font-size:40px;">send</i></button>
        </form>
    <?php } else {
        echo "failed to get cid or tid";
    } ?>
</body>

</html>