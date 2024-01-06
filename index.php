<?php
include_once("./app/database/connect.php");

if (isset($_POST["submitButton"])) {
    //   $username = $_POST["username"];
    //   $quantity = $_POST["quantity"];
    //   $price = $_POST["price"];
    //   $comment = $_POST["comment"];

    if (empty($_POST["username"])) {
        $error_message["username"] = "NULLやめて";
    }
    if (empty($_POST["body"])) {
        $error_message["body"] = "NULLやめて";
    }
    if (empty($error_message)) {
        $post_date = date("Y-m-d H:i:s");

        $sql = "INSERT INTO `comment` (`username`, `body`, `post_date`) VALUES (:username, :body, :post_date);";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(":username", $_POST["username"], PDO::PARAM_STR);
        //   $statement->bindParam(":quantity", $quantity, PDO::PARAM_INT);
        //   $statement->bindParam(":price", $price, PDO::PARAM_STR);
        $statement->bindParam(":body", $_POST["body"], PDO::PARAM_STR);
        $statement->bindParam(":post_date", $post_date, PDO::PARAM_STR);
        $statement->execute();
    }
}

// if (isset($_POST["updateProduct"])) {
//     $productId = $_POST["productId"];
//     $newQuantity = $_POST["newQuantity"];
//     $newPrice = $_POST["newPrice"];
//     $newComment = $_POST["newComment"];

//     $sql = "UPDATE `inventory` SET `quantity` = :quantity, `price` = :price, `comment` = :comment WHERE `id` = :id;";
//     $statement = $pdo->prepare($sql);
//     $statement->bindParam(":quantity", $newQuantity, PDO::PARAM_INT);
//     $statement->bindParam(":price", $newPrice, PDO::PARAM_STR);
//     $statement->bindParam(":comment", $newComment, PDO::PARAM_STR);
//     $statement->bindParam(":id", $productId, PDO::PARAM_INT);
//     $statement->execute();
// }

// if (isset($_POST["deleteProduct"])) {
//     $productId = $_POST["productId"];

//     $sql = "DELETE FROM `inventory` WHERE `id` = :id;";
//     $statement = $pdo->prepare($sql);
//     $statement->bindParam(":id", $productId, PDO::PARAM_INT);
//     $statement->execute();
// }

// 全データ取得するSQL文
$comment_array = array();
$sql = "SELECT * FROM comment";
$statement = $pdo->prepare($sql);
$statement->execute();
$comment_array = $statement;

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>在庫管理アプリ</title>
</head>

<body>
    <div class="listArea">
        <header>
            <h1>在庫管理アプリ</h1>
        </header>
        <section class="commentArea">
            <form method="POST">
                <input type="text" name="username" placeholder="商品名">
                <!-- <input type="number" name="quantity" placeholder="Quantity"> -->
                <!-- <input type="text" name="price" placeholder="Price"> -->
                <input type="text" name="body" placeholder="詳細">
                <input type="submit" value="登録" name="submitButton">
            </form>
        </section>
        <?php foreach ($comment_array as $comment) : ?>
            <article class="productArea">
                <h3><?php echo $comment["username"]; ?></h3>
                <p>詳細: <?php echo $comment["body"]; ?></p>
                <p>登録日: <?php echo $comment["post_date"]; ?></p>
                <form method="POST">
                    <!-- <input type="text" name="body" placeholder="New Comment"> -->
                    <!-- <input type="submit" name="username" value="Name"> -->
                </form>
                <!-- <form method="POST">
                <input type="hidden" name="productId" value="
                <input type="submit" name="deleteProduct" value="Delete Product">
              </form> -->
            </article>
        <?php endforeach ?>
    </div>
</body>

</html>