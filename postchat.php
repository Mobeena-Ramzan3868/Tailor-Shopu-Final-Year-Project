<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailor Shopu</title>
</head>

<body>
    <?php echo "postchat";
    if (isset($_POST["submit"])) {
        if (isset($_GET['tid']) and isset($_GET['cid']) and isset($_GET['messfrom'])) {
            $gtid = $_GET['tid'];
            $gcid = $_GET['cid'];
            $getmessfrom = $_GET['messfrom'];
            echo "submit";
            echo $_POST['message'];
            @$db = new mysqli('localhost', "root", "", "final year project");
            if (mysqli_connect_errno()) {
                echo 'Connection error: ' . $db->connect_errno;
                exit;
            }
            $date=date('d-m-y');
            $time=date('h:i');
            $query = "INSERT INTO chat (tailorid, custid, message, messagefrom,date, time) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($query);
            $stmt->bind_param('ssssss', $gtid, $gcid, $_POST['message'], $getmessfrom, $date, $time);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                header('Location: chatbox.php?tid='.$gtid.'&cid='.$gcid.'&messfrom='.$getmessfrom);
            } else {
                echo "<p>An error has occurred.<br/> The chat was not added.</p>";
            }
        }
    } else {
        echo "failed to get submit";
    } ?>
</body>

</html>