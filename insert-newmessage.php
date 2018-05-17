<?php
    session_start();
    $_SESSION["insert_title"] = $_POST["message_title"];
    $_SESSION["insert_message"] = $_POST["message"];
    $file_name = $_FILES['add_message_image']['name'];
    $image_path = './upload/' . $file_name;
    move_uploaded_file($_FILES['add_message_image']['tmp_name'], $image_path);
    
    // MySQLサーバ接続に必要な値を変数に代入
    $username = 'root';
    $password = '';

    // PDO のインスタンスを生成して、MySQLサーバに接続
    $database = new PDO('mysql:host=localhost;dbname=messageboard;charset=UTF8;', $username, $password);

// フォームに必要な情報が入力されていれば
    if (isset($_SESSION["insert_title"]) && isset($_SESSION["insert_message"]) && $_FILES['add_message_image']) {
        // 実行するSQLを作成
        $sql = 'INSERT INTO messageboard.messages (message_title,message,link) VALUES(:title,:content,:link)';
        
        // ユーザ入力に依存するSQLを実行するので、セキュリティ対策をする
        $statement = $database->prepare($sql);
        
        // ユーザ入力データ($_POST['book_title'])をVALUES(?)の?の部分に代入する
        $statement->bindParam(':title', $_SESSION["insert_title"]);
        $statement->bindParam(':content', $_SESSION["insert_message"]);
        $statement->bindParam(':link', $image_path);
        
        // SQL文を実行する
        $statement->execute();
        
        // ステートメントを破棄する
        $statement = null;
   
    }

  header( "Location:./index.php" ) ;
?>