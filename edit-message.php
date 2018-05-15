<?php
    $message_id = $_GET['id'];
    
    // MySQLサーバ接続に必要な値を変数に代入
    $username = 'root';
    $password = '';

    // PDO のインスタンスを生成して、MySQLサーバに接続
    $database = new PDO('mysql:host=localhost;dbname=messageboard;charset=UTF8;', $username, $password);

    // 実行するSQLを作成
    $sql = 'SELECT * FROM messages WHERE id = '.$message_id;
    // SQLを実行する
    $statement = $database->query($sql);
    // 結果レコード（ステートメントオブジェクト）を配列に変換する
    $records = $statement->fetchAll();

    // MySQLを使った処理が終わると、接続は不要なので切断する
    $database = null;
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
<?php
            if ($records) {
                foreach ($records as $record) {
                    $id = $record['id'];
                    $message_title = $record['message_title'];
                    $message = $record['message'];
                    
?>
            <h1>id = <?php print $id; ?> のメッセージ編集ページ</h1>
            <div class="row">
                <div class="col-xs-6">
                    <form method="POST" action="https://56f26c7d8a464701a9825339832bbe83.vfs.cloud9.us-east-2.amazonaws.com/message-board/update-message.php?id=<?php print $id; ?>" accept-charset="UTF-8">
                        <div class="form-group">
                            <label for="title">タイトル:</label>
                            <input class="form-control" name="title" type="text" value="<?php print $message_title; ?>" id="title">
                        </div>
                        <div class="form-group">
                            <label for="content">メッセージ:</label>
                            <input class="form-control" name="content" type="text" value="<?php print $message; ?>" id="content">
                        </div>
                        <input class="btn btn-default" type="submit" value="更新">
                    </form>
                </div>
            </div>
<?php
                }
            }
?>           
        </div>
    </body>
</html>