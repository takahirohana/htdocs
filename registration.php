<?php
  require_once('dbc.php');
  session_start();
  $mode = 'input';
  $errmessage = array();
  if( isset($_POST['back']) && $_POST['back'] ){
    //　何もしない
  } else if( isset($_POST['confirm']) && $_POST['confirm'] ){
    if( !$_POST['name'] ) {
      $errmessage[] = "氏名を入力してください";
    } else if( mb_strlen($_POST['name']) > 40 ){
      $errmessage[] = "氏名は40文字以内にしてください";
    } if(!preg_match('/^[[ァ-ン]|ー]+$/u', $_POST['name'])){
      $errmessage[] = "氏名はカタカナのみにしてください";
    }
    $_SESSION['name'] = htmlspecialchars($_POST['name'], ENT_QUOTES);

    if( !$_POST['email'] ) {
      $errmessage[] = "Eメールを入力してください";
    } else if( mb_strlen($_POST['email']) > 100 ){
      $errmessage[] = "Eメールは100文字以内にしてください";
    } else if( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $errmessage[] = "メールアドレスが不正です";
    }
    $_SESSION['email'] = htmlspecialchars($_POST['email'], ENT_QUOTES);

    if( $errmessage ){
      $mode = 'input';
    } else {
      $mode = 'confirm';
    }
    
  } else if( isset($_POST['send']) && $_POST['send']) {
    $message = "登録完了いたしました。\r\n"
              . "名前: " . $_SESSION['name'] . "\r\n"
              . "email: " . $_SESSION['email'] . "\r\n";
    mail($_SESSION['email'], '登録ありがとうございます。', $message);
    $mode = 'send';
  } else {
    $_SESSION['name'] = "";
    $_SESSION['email']    = "";
  }

  $users = $_SESSION;

$sql = 'INSERT INTO
          user(name, email)
        VALUES
          (:name, :email)';

$dbh = dbConnect();
$dbh->beginTransaction();

try {
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':name',$users['name'],PDO::PARAM_STR);
    $stmt->bindValue(':email',$users['email'],PDO::PARAM_STR);
    $stmt->execute();
    $dbh->commit();
} catch(PDOException $e){
    $dbh->rollBack();
    exit($e);
}
?>

<?php

require_once("signup.php");
?>
