<?php
    session_start();

    if(isset($_SESSION["name"])) {
        header('Location: logout.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
</head>
<body>
    <header>
        <h2>TG Shopへようこそ</h2>
        <p>ログインまたはアカウント作成からお願い致します！</p>
    </header>
    <main>
        <h3>ログイン</h3>
        <div class="loginForm">
            <form action="controller.php" method="post">
                <input type="text" name="name" required="required">
                <input type="email" name="mail" required="required">
                <input type="password" name="pass" required="required">
                <input type="hidden" name="mode" value="A">
                <input type="submit" value="ログイン">
            </form>
        </div>
        <p>アカウント新規作成は<a href="addUser.html">こちら</a></p>
    </main>
    <footer>
        <h4>Copyright</h4>
    </footer>
</body>
</html>