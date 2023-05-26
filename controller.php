<?php
    session_start();

    $mode = $_POST["mode"];
    if($mode == "A") {
        login();
    } else if($mode == "B"){
        addUser();
    }
    

    //アカウントログインの処理
    function login() {
        $dns = 'mysql:host=localhost; dbname=TGshop; charset=utf8';
        $user = 'root';
        $pass = '';

        $name = htmlentities($_POST["name"], ENT_QUOTES, "UTF-8");
        $mail = htmlentities($_POST["mail"], ENT_QUOTES, "UTF-8");
        $password = htmlentities($_POST["pass"], ENT_QUOTES, "UTF-8");

        $password = hash("sha256", $password);

        try {
            $db = new PDO($dns, $user, $pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $SQL = "SELECT name, mail, pass FROM Customer WHERE name = ? AND mail = ? AND pass = ?";

            $stmt = $db->prepare($SQL);
            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $mail);
            $stmt->bindParam(3, $password);
            
            $stmt->execute();
            $list = $stmt->fetchAll();

            if(empty($list[0])) {
                header('Location: Error/loginError.html');
                exit();
            }

            $_SESSION["name"] = $name;

            if($name === "root" && $mail === "rootHuman1111@gmail.com" && $password === "4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2") {
                header('Location: root/rootTop.php');
                exit();
            } else {
                header('Location: user/userTop.php');
                exit();
            }
        } catch(PDOException $e) {
            echo "アクセスできませんでした";
            echo $e->getMessage();
        }
    }


    //アカウント新規追加の処理
    function addUser() {
        $dns = 'mysql:host=localhost; dbname=TGshop; charset=utf8';
        $user = 'root';
        $pass = '';

        $name = htmlentities($_POST["name"], ENT_QUOTES, "UTF-8");
        $mail = htmlentities($_POST["mail"], ENT_QUOTES, "UTF-8");
        $password = htmlentities($_POST["pass"], ENT_QUOTES, "UTF-8"); 
        $adress = htmlentities($_POST["adress"], ENT_QUOTES, "UTF-8");

        $mail = filter_var($mail, FILTER_VALIDATE_EMAIL);
        if($mail === false) {
            header('Location: Error/mailError.html');
            exit();
        }

        $password = hash("sha256", $password);

        try {
            $db = new PDO($dns, $user, $pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $SQL = "INSERT INTO Customer(name, mail, pass, adress) VALUES(?, ?, ?, ?)";

            $stmt = $db->prepare($SQL);
            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $mail);
            $stmt->bindParam(3, $password);
            $stmt->bindParam(4, $adress);

            $stmt->execute();

            $_SESSION["name"] = $name;

            header('Location: user/userTop.php');
            exit();
        } catch(PDOException $e) {
            header('Location: Error/insertError.html');
            exit();
        }
    }
?>