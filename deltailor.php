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
    $tid = $_GET['tid'];
    @$db = new mysqli('localhost', "root", "", "final year project");
    if (mysqli_connect_errno()) {
        echo 'Connection error: ' . $db->connect_errno;
        exit;
    }
    echo "not found in db";
    $query = "DELETE FROM tailoruser WHERE tid=$tid";
    $stmt = $db->prepare($query);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        header('Location: admintailors.php');
    } else {
        echo 'an error has been occur <br>';
        exit;
    }
    ?>
</body>

</html>