<?php
    // MySQLサーバ接続に必要な値を変数に代入
    $username = 'root';
    $password = '';

    // PDO のインスタンスを生成して、MySQLサーバに接続
    $database = new PDO('mysql:host=localhost;dbname=messageboard;charset=UTF8;', $username, $password);

    // フォームに必要な情報が入力されていれば
    if (isset($_POST["message_title"]) && isset($_POST["message"])) {
        // 実行するSQLを作成
        $sql = 'INSERT INTO messageboard.messages (message_title,message) VALUES(:title,:content)';
        
        // ユーザ入力に依存するSQLを実行するので、セキュリティ対策をする
        $statement = $database->prepare($sql);
        
        // ユーザ入力データ($_POST['book_title'])をVALUES(?)の?の部分に代入する
        $statement->bindParam(':title', $_POST["message_title"]);
        $statement->bindParam(':content', $_POST["message"]);
        
        // SQL文を実行する
        $statement->execute();
        
        // ステートメントを破棄する
        $statement = null;
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>MessageBoard</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <header>
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="https://56f26c7d8a464701a9825339832bbe83.vfs.cloud9.us-east-2.amazonaws.com/message-board">MessageBoard</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="https://56f26c7d8a464701a9825339832bbe83.vfs.cloud9.us-east-2.amazonaws.com/message-board/create-newmessage.php">新規メッセージの投稿</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>        
        <div class="container">
                        
            
    <h1>メッセージ新規作成ページ</h1>
    
    <div class="row">
        <div class="col-xs-6">
            <form method="POST" action="https://56f26c7d8a464701a9825339832bbe83.vfs.cloud9.us-east-2.amazonaws.com/message-board/create-newmessage.php" accept-charset="UTF-8">
                <div class="form-group">
                    <label for="title">タイトル:</label>
                    <input class="form-control" name="message_title" type="text" id="title">
                </div>
                    
                <div class="form-group">
                    <label for="content">メッセージ:</label>
                    <input class="form-control" name="message" type="text" id="content">
                </div>
                
               <input class="btn btn-primary" type="submit" value="投稿">
            </form>
        </div>
    </div>
    
        </div>
    </body>
</html>