<?php
    // 関数一つに一つの機能のみを持たせる
    // 1.データベース接続
    // ひきすう　;
    //　返り値: 接続結果を返す
    function dbConnect() {
        $dsn = 'mysql:host=localhost;dbname=registration_app;charset=utf8';
        $user = 'registration_user';
        $pass = '111111';
    
        try {
            $dbh = new  PDO($dsn,$user,$pass,[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);
        //   echo '接続成功';
        } catch(PDOException $e) {
            echo '接続失敗'. $e->getMessage();
            exit();
        };

        return $dbh;
    }
    


?>