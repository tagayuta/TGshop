<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログアウト</title>
</head>
<body>
    <p>現在<?php echo $_SESSION["name"] ?>さんでログイン中です。</p>
    <p>別のアカウントをご利用される場合はログアウトしてください！</p>
    <p><a href="exeLogout.php">ログアウト</a></p>
</body>
</html>