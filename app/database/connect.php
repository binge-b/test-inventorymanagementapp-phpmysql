<?php

$user = 'root';
$pass = '';

// DBと接続
// PDOExceptionクラスは、PHPのPDO (PHP Data Objects) クラスがデータベース操作中にエラーが発生した場合にスローする例外です。例外とは、プログラムの実行中に予期しない状態が発生したときにスローされる特別なオブジェクトで、これによりプログラムはエラーを適切に処理することができます。
// $eオブジェクトのgetMessageメソッドの呼び出し：$eは、catchブロック内でキャッチされた例外オブジェクトを参照するための変数です。この変数を使用して、例外がスローされた原因やエラーメッセージなどの情報を取得することができます。
try {
    $pdo = new PDO('mysql:host=localhost;dbname=re-2chan-bbs', $user, $pass);
    // echo "DBとの接続に成功しました!わっしょーい!";
} catch (PDOException $error) {
    echo $error->getMessage();
}
