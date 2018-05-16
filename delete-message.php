<?php
    $id = $_GET['id'];
    // MySQLサーバ接続に必要な値を変数に代入
    $username = 'root';
    $password = '';

    // PDO のインスタンスを生成して、MySQLサーバに接続
    $database = new PDO('mysql:host=localhost;dbname=messageboard;charset=UTF8;', $username, $password);

    // フォームに必要な情報が入力されていれば
    if (isset($id)) {
        // 実行するSQLを作成
        $sql = 'DELETE FROM messageboard.messages WHERE id = :id';
        
        // ユーザ入力に依存するSQLを実行するので、セキュリティ対策をする
        $statement = $database->prepare($sql);
        
        // ユーザ入力データ($_POST['book_title'])をVALUES(?)の?の部分に代入する
        $statement->bindParam(':id', $id);
        
        // SQL文を実行する
        $statement->execute();
        
        // ステートメントを破棄する
        $statement = null;
    }
    header( "Location:./index.php" ) ;
?>