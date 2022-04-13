<?php
    session_start();
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: index.php");
        exit;
        }
    require_once "sql/db_credentials.php";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
        $sql = $pdo->prepare("SELECT * FROM note WHERE authorID = ?");
        $sql->execute([ $_SESSION['accountID']]);
        $notes = $sql->fetchAll();

        foreach ($notes as $note) {
            echo $note['title'] . "<br>";

        }
    ?>


    <a href="logout.php""><button>Log out!</button></a>
</body>
</html>