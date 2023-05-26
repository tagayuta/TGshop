<?php
    session_start();
    $stmt = $_SESSION["stmt"];

    if(empty($stmt[0])) {
        $dns = 'mysql:host=localhost; dbname=TGshop; charset=utf8';
        $user = 'root';
        $pass = '';

        try {
            $db = new PDO($dns, $user, $pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $SQL = "SELECT p.product_id, p.name, p.price, s.count FROM product p, stock s WHERE p.product_id = s.product_id";

            $stmt = $db->prepare($SQL);
            $stmt->execute();
        } catch(PDOException $e) {
            echo "アクセスできませんでした";
            echo $e->getMessage();
        }
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>トップページ</title>
</head>
<body>
    <h2>TGshopの管理ページです</h2>
    <h1>商品登録</h1>
    <form action="insert.php" method="post">
        <table>
            <tr>
                <td>商品名：</td>
                <td><input type="text" name="name" required="required"></td>
            </tr>
            <tr>
                <td class="tg">値段：</td>
                <td><input type="text" name="price" required="required"></td>
            </tr>
            <tr>
                <td>在庫数：</td>
                <td><input type="text" name="stock" required="required"></td>
            </tr>
        </table>
        <input type="submit" value="登録">
    </form>

    <h1>商品一覧</h1>
        <table class="tb-2">
            <tr>
                <td>商品名</td>
                <td>値段</td>
                <td>在庫数</td>
                <td>在庫数追加</td>
                <td>編集</td>
                <td>削除</td>
            </tr>

            <?php foreach($stmt as $key):?>
                <tr>
                    <td><?php echo $key['name'];?></td>
                    <td><?php echo $key['price'];?></td>
                    <td><?php echo $key['count'];?></td>
                    <td>
                        <form action="addStock.php" method="post">
                            <input type="text" name="add" required="required">
                            <input type="hidden" name="id" value="<?= $key["product_id"];?>">
                            <input type="hidden" name="name" value="<?= $key["name"];?>">
                            <input type="hidden" name="stock" value="<?= $key["count"];?>">
                            <input type="submit" class="sub-t" value="追加">
                        </form>
                    </td>

                    <td>
                        <form action="update.php" method="post">
                            <input type="hidden" name="id" value="<?=  $key["product_id"];?>">
                            <input type="hidden" name="name" value="<?= $key["name"];?>">
                            <input type="hidden" name="price" value="<?= $key["price"];?>">
                            <input type="hidden" name="stock" value="<?=  $key["count"];?>">
                            <input type="submit" class="sub-a" value="編集" >
                        </form>
                    </td>
                    <td>
                        <form action="delete.php" method="post">
                            <input type="hidden" name="delete" value="<?= $key["product_id"]?>">
                            <input type="submit" value="削除">
                        </form>
                    </td>
                </tr>
            <?php endforeach;?>
        </table>
</body>
</html>