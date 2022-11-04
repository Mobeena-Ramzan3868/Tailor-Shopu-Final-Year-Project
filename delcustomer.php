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
    $cid = $_GET['cid'];
    @$db = new mysqli('localhost', "root", "", "final year project");
    if (mysqli_connect_errno()) {
        echo 'Connection error: ' . $db->connect_errno;
        exit;
    }
    $query = "DELETE FROM users WHERE id=$cid";
    $stmt = $db->prepare($query);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        header('Location: admincustomers.php');
    } else {
        echo 'an error has been occur <br>';
        exit;
    }
    ?>
</body>

</html>