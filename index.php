
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
$dateOfBirth = '04-06-2000';
$today = date("Y-m-d");
$diff = date_diff(date_create($dateOfBirth), date_create($today));
$custager = $diff->format('%y');
echo $custager;
?>
</body>
</html>