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
    $orderid = $_GET["orderid"];
    if (isset($_GET['deliveryid'])) {
        $deliveryid = $_GET['deliveryid'];
    }
    @$db = new mysqli('localhost', "root", "", "final year project");
    if (mysqli_connect_errno()) {
        echo 'Connection error: ' . $db->connect_errno;
        exit;
    }
    $query1 = "SELECT orderid, tailorname, custname, deliveryboyid, rawfabricdeliboyid, orderdeliverystatus, typeoforder FROM custorder WHERE orderid=$orderid";
    $stmto = $db->prepare($query1);
    $stmto->execute();
    $stmto->store_result();
    $stmto->bind_result($orderid, $tailorname, $custname, $deliveryboyid, $rawfabricdeliboyid, $orderdeliverystatus, $typeoforder);
    // echo "<h6>Number of persons found " . $stmto->num_rows . "</h6>";
    if ($stmto->num_rows == 0) {
        echo "not found in db";
    }
    while ($stmto->fetch()) {
    if (isset($_GET['deliveryid'])) {
        $deliveryid = $_GET['deliveryid'];
        if ($typeoforder == "bycustomer") {
            if ($orderdeliverystatus == 'customerst') {
                $query = "UPDATE custorder SET rawfabricdeliboyid=? WHERE orderid=$orderid";
                $stmt = $db->prepare($query);
                $stmt->bind_param('s', $deliveryid);
                $stmt->execute();
                // if ($stmt->affected_rows > 0) {
                // } else {
                //     echo "<p>An error has occurred.<br/> the id of delivery boy not added.</p>";
                //     exit;
                // }
            }
        }
        if ($orderdeliverystatus == 'tailorst') {
            echo $query = "UPDATE custorder SET deliveryboyid=? WHERE orderid=$orderid";
            $stmt = $db->prepare($query);
            $stmt->bind_param('s', $deliveryid);
            $stmt->execute();
            // if ($stmt->affected_rows > 0) {
            // } else {
            //     echo "<p>An error has occurred.<br/> the id of delivery boy not added.</p>";
            //     exit;
            // }
        }
    }
        if ($typeoforder == "bycustomer") {
            if ($orderdeliverystatus == 'customerst') {
                $query = "UPDATE custorder SET orderdeliverystatus='deliveryboyac1' WHERE orderid=$orderid";
                $stmt = $db->prepare($query);
                // $stmt->bind_param('s', );
                $stmt->execute();
                if (isset($_GET['deliveryid'])) {
                    header("Location:deliveryboyorders.php?deliveryboyid=" . $deliveryid);
                } else {
                    // header("Location:deliveryboyorders.php");
                }
            }
            if ($orderdeliverystatus == 'deliveryboyac1') {
                $query = "UPDATE custorder SET orderdeliverystatus='tailordel' WHERE orderid=$orderid";
                $stmt = $db->prepare($query);
                // $stmt->bind_param('s', );
                $stmt->execute();
                    header("Location:deliveryboyorders.php");
            }
        }
        if ($orderdeliverystatus == 'tailorst') {
            $query = "UPDATE custorder SET orderdeliverystatus='deliveryboyac' WHERE orderid=$orderid";
            $stmt = $db->prepare($query);
            // $stmt->bind_param('s', );
            $stmt->execute();
            if (isset($_GET['deliveryid'])) {
                header("Location:deliveryboyorders.php?deliveryboyid=" . $deliveryid);
            } else {
                // header("Location:deliveryboyorders.php");
            }
        }
        if ($orderdeliverystatus == 'deliveryboyac') {
            $query = "UPDATE custorder SET orderdeliverystatus='custend' WHERE orderid=$orderid";
            $stmt = $db->prepare($query);
            // $stmt->bind_param('s', );
            $stmt->execute();
                header("Location:deliveryboyorders.php");
        }
    }
    ?>
</body>

</html>