<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <style>
        body {
            font-family: 'Andada Pro', serif;
        }

        /* a{
    display: inline;
} */
        .container {
            display: grid;
            grid-gap: 0%;
            row-gap: 11%;
            /* justify-content: center; */
            grid-template-columns: repeat(auto-fit, minmax(100px, 500px));
            margin-bottom: 8%;
            margin-left: 25%;
            padding-top: 2%;
        }

        .abtn {
            font-size: 200%;
            width: 74%;
            height: 102%;
            padding: 7% 9%;
            margin: 4% 0%;
            color: white;
            border-radius: 12px;
            background-color: #4d9f9d;
            box-shadow: 0 0 18px 2px #097392;
            border: 1px solid #4fafad;
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




    <?php
    // @$db = new mysqli('localhost', "root", "", "final year project");
    // if (mysqli_connect_errno()) {
    //     echo 'Connection error: ' . $db->connect_errno;
    //     exit;
    // }
    // $query = "SELECT aid, aname, aphone, apassword, aemail FROM admindetail";
    // $stmt = $db->prepare($query);
    // $stmt->execute();
    // $stmt->store_result();
    // $stmt->bind_result($aid, $aname, $aphone, $apassword, $aemail);
    // // echo "<h6>Number of persons found " . $stmt->num_rows . "</h6>";
    // if ($stmt->num_rows == 0) {
    //     echo "not found in db";
    // }
    // while ($stmt->fetch()) {
    //     echo $aid, $aname, $apassword, $aemail;
    // }
    ?>
    <div class="container">
        <a href="admineditdetails.php"><button class="abtn">Edit Admin Details</button></a>
        <a href="admintailors.php"><button class="abtn">View Tailors</button></a>
        <a href="admincustomers.php"><button class="abtn">View Customers</button></a>
        <a href="admindeliveryboy.php"><button class="abtn">View Delivery Boys</button></a>
        <a href="generatereport.php"><button class="abtn">Generate Reports</button></a>
        <a href="faqsdelete.php"><button class="abtn">Manage FAQs</button></a>
    </div>






    <script src="extra.js"></script>
</body>

</html>