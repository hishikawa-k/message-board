<?php
    session_start();
    $_SESSION["insert_title"] = $_POST["title"];
    $_SESSION["insert_message"] = $_POST["content"];
    $id = $_GET['id'];
    // MySQLサーバ接続に必要な値を変数に代入
    $username = 'root';
    $password = '';

    // PDO のインスタンスを生成して、MySQLサーバに接続
    $database = new PDO('mysql:host=localhost;dbname=messageboard;charset=UTF8;', $username, $password);

    // フォームに必要な情報が入力されていれば
    if (isset($_SESSION["insert_title"]) && isset($_SESSION["insert_message"]) && isset($id)) {
        // 実行するSQLを作成
        $sql = 'UPDATE messageboard.messages SET message_title=:title,message=:content WHERE id = :id';
        
        // ユーザ入力に依存するSQLを実行するので、セキュリティ対策をする
        $statement = $database->prepare($sql);
        
        // ユーザ入力データ($_POST['book_title'])をVALUES(?)の?の部分に代入する
        $statement->bindParam(':id', $id);
        $statement->bindParam(':title', $_SESSION["insert_title"]);
        $statement->bindParam(':content', $_SESSION["insert_message"]);
        
        // SQL文を実行する
        $statement->execute();
        
        // ステートメントを破棄する
        $statement = null;
    }
    header( "Location:./index.php" ) ;
?>