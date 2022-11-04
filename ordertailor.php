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
    $tgid = $_GET["tgaid"];
    echo $tatype = $_GET['tatype'];
    echo $tgname = $_GET["tgname"];
    $db = new mysqli('localhost', 'root', '', 'final year project');
    if (mysqli_connect_errno()) {
        echo 'connection error: ' . $db->connect_errno;
        exit;
    }
    $query = "SELECT orderid, status FROM custorder WHERE orderid=$tgid";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($orderid, $status);
    echo "<h6>Number of persons found " . $stmt->num_rows . "</h6>";
    if ($stmt->num_rows == 0) {
        echo "not found in db";
        exit;
    }
    while ($stmt->fetch()) {
        if ($tatype == "accept") {
            echo $statuschange = "accepted";
            $query = "UPDATE custorder SET status=? WHERE orderid=$orderid";
            $stmt = $db->prepare($query);
            $stmt->bind_param('s', $tatype);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                header('Location: tailorvieworders.php?tgname='.$tgname);
            } else {
                echo "<p>An error has occurred.<br/> The item was not added.</p>";
            }
        } else if ($tatype == "reject") {
            // echo $statuschange = "rejected";
            $query = "UPDATE custorder SET status=? WHERE orderid=$orderid";
            $stmt = $db->prepare($query);
            $stmt->bind_param('s', $tatype);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                header('Location: tailorvieworders.php?tgname='.$tgname);
            } else {
                echo "<p>An error has occurred.<br/> The item was not added.</p>";
            }
        } else if ($tatype == "done") {
            // echo $statuschange = "done";
            $query = "UPDATE custorder SET status=? WHERE orderid=$orderid";
            $stmt = $db->prepare($query);
            $stmt->bind_param('s', $tatype);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                header('Location: tailorvieworders.php?tgname='.$tgname);
            } else {
                echo "<p>An error has occurred.<br/> The item was not added.</p>";
            }
        }
    }
    ?>
</body>

</html>