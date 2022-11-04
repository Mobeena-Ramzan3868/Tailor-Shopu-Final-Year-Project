<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $orderid=$_GET['orderid'];
    $custid=$_GET["custid"];
    $db = new mysqli('localhost', 'root', '', 'final year project');
    if (mysqli_connect_errno()) {
        echo 'connection error: ' . $db->connect_errno;
        exit;
    }
    // $query1 = "SELECT orderid, tailorname, custname, status, phone, totalprice, email, country, province, city, postal, address, additonal, custage, custgender, dateoforder, timeoforder, daysoforder, deliveryboyid, orderdeliverystatus, typeoforder, rating, feedback FROM custorder WHERE orderid=$orderid";
    // $stmto = $db->prepare($query1);
    // $stmto->execute();
    // $stmto->store_result();
    // $stmto->bind_result($orderid, $tailorname, $custname, $status, $phone, $totalprice, $email, $country, $province, $city, $postal, $address, $additonal, $custage, $custgender, $dateoforder, $timeoforder, $daysoforder, $deliveryboyid, $orderdeliverystatus, $typeoforder, $rating, $feedback);
    $query = "DELETE FROM custorder WHERE orderid=$orderid";
    $stmt = $db->prepare($query);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        header('Location: recordprocessing.php?custid='.$custid);
    } else {
        echo 'an error has been occur <br>';
        exit;
    }
    ?>
</body>

</html>