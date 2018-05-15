<?php
    session_start();
    $_SESSION["insert_title"] = $_POST["message_title"];
    $_SESSION["insert_message"] = $_POST["message"];
    // MySQLサーバ接続に必要な値を変数に代入
    $username = 'root';
    $password = '';

    // PDO のインスタンスを生成して、MySQLサーバに接続
    $database = new PDO('mysql:host=localhost;dbname=messageboard;charset=UTF8;', $username, $password);

    // フォームに必要な情報が入力されていれば
    if (isset($_SESSION["insert_title"]) && isset($_SESSION["insert_message"])) {
        // 実行するSQLを作成
        $sql = 'INSERT INTO messageboard.messages (message_title,message) VALUES(:title,:content)';
        
        // ユーザ入力に依存するSQLを実行するので、セキュリティ対策をする
        $statement = $database->prepare($sql);
        
        // ユーザ入力データ($_POST['book_title'])をVALUES(?)の?の部分に代入する
        $statement->bindParam(':title', $_SESSION["insert_title"]);
        $statement->bindParam(':content', $_SESSION["insert_message"]);
        
        // SQL文を実行する
        $statement->execute();
        
        // ステートメントを破棄する
        $statement = null;
    }
    header( "Location:https://56f26c7d8a464701a9825339832bbe83.vfs.cloud9.us-east-2.amazonaws.com/message-board/index.php" ) ;
?>