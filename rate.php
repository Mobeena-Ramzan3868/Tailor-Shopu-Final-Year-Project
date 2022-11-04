<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailor Shopu</title>
</head>

<body>
    <?php
    $db = new mysqli('localhost', 'root', '', 'final year project');
    if (mysqli_connect_errno()) {
        echo 'connection error: ' . $db->connect_errno;
        exit;
    }
    // $_POST['rate'];
    // $_POST['texta'];
    $orderid = $_GET["orderid"];
    $custid = $_GET["custid"];
    $tailorname = $_GET["tailorname"];
    $query = "UPDATE custorder SET rating=?, feedback=? WHERE orderid=$orderid";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ss', $_POST['rate'], $_POST['texta']);
    $stmt->execute();

    $queryr = "SELECT tailorname, rating FROM custorder WHERE tailorname='$tailorname'";
    $stmtr = $db->prepare($queryr);
    $stmtr->execute();
    $stmtr->store_result();
    $stmtr->bind_result($tailorname, $rating);
    $rfive = 0;
    $rfour = 0;
    $rthree = 0;
    $rtwo = 0;
    $rone = 0;
    while ($stmtr->fetch()) {
        if ($rating == 5) {
            $rfive = $rfive + 1;
        }
        if ($rating == 4) {
            $rfour = $rfour + 1;
        }
        if ($rating == 3) {
            $rthree = $rthree + 1;
        }
        if ($rating == 2) {
            $rtwo = $rtwo + 1;
        }
        if ($rating == 1) {
            $rone = $rone + 1;
        }
    }
    $ratemp = ($rfive * 5) + ($rfour * 4) + ($rthree * 3) + ($rtwo * 2) + ($rone * 1);
    $countr = $rfive + $rfour + $rthree + $rtwo + $rone;
    $rate = $ratemp / $countr;
    $queryrr = "UPDATE tailoruser SET rating=? WHERE tname='$tailorname'";
    $stmtrr = $db->prepare($queryrr);
    $stmtrr->bind_param('s', $rate);
    $stmtrr->execute();
    $queryad = "SELECT tname, noofcust, rating FROM tailoruser WHERE tname='$tailorname'";
    $stmtad = $db->prepare($queryad);
    $stmtad->execute();
    $stmtad->store_result();
    $stmtad->bind_result($tname, $noofcust, $rating);
    while ($stmtad->fetch()) {
        $totofcust = $noofcust + 1;
        $queryss = "UPDATE tailoruser SET noofcust=? WHERE tname='$tailorname'";
        $stmtss = $db->prepare($queryss);
        $stmtss->bind_param('s', $totofcust);
        $stmtss->execute();
    }
    header("Location:profiletailor.php");
    ?>
</body>

</html>