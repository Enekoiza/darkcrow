<?php
    session_start();

    if($_SESSION['dashboard'] == 'dashboardAdmin.php')
    {
        header("Location: dashboardAdmin.php");

    }
    else if(!isset($_COOKIE['login']) and !isset($_SESSION['dashboard']))
    {
        header("Location: index.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <form method="post" action="cookieDelete.php" id="form1">       
        <button type="submit" form="form1" >Run my PHP code</button>
    </form>
</body>
</html>