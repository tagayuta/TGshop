<?php
    session_start();
    $_SESSION = array();
    session_destroy();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログアウトしました</title>
    <link rel="stylesheet" href="style.css">

</head>
<body class="bg">
    <h1 class="title">みんなの在庫管理！！</h1>
    <p>ログアウトしました</p>
    <p>ログインは<a href="index.php">こちら</a>からどうぞ！</p>
</body>
</html>