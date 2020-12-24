<?php

  $dsn = 'mysql:host=localhost;dbname=registration_app;charset=utf8';
  $user = 'registration_user';
  $pass = '111111';

  try {
      $dbh = new  PDO($dsn,$user,$pass,[
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      ]);
      echo '接続成功';
      $dbh = null;
  } catch(PDOException $e) {
      echo '接続失敗'. $e->getMessage();
      exit();
  };


?>