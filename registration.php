<?php
  session_start();
  $mode = 'input';
  $errmessage = array();
  if( isset($_POST['back']) && $_POST['bacd'] ){
    //　何もしない
  } else if( isset($_POST['confirm']) && $_POST['confirm'] ){
    if( !$_POST['fullname'] ) {
      $errmessage[] = "氏名を入力してください";
    } else if( mb_strlen($_POST['fullname']) > 40 ){
      $errmessage[] = "氏名は40文字以内にしてください";
    } if(!preg_match('/^[[ァ-ン]|ー]+$/u', $_POST['fullname'])){
      $errmessage[] = "カタカナのみ";
    }
    $_SESSION['fullname'] = htmlspecialchars($_POST['fullname'], ENT_QUOTES);

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
              . "名前: " . $_SESSION['fullname'] . "\r\n"
              . "email: " . $_SESSION['email'] . "\r\n";
    mail($_SESSION['email'], '登録ありがとうございます。', $message);
    $mode = 'send';
  } else {
    $_SESSION['fullname'] = "";
    $_SESSION['email']    = "";
  }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>新規登録画面</title>
</head>
<body>
  <?php if( $mode == 'input' ) { ?>
    <?php
      if( $errmessage ){
        echo '<div style="color:red;">';
        echo implode('<br>', $errmessage );
        echo '</div>';
      }
    ?>

    <form action="./registration.php" method="post">
    （全角カナ　氏名間スペース必須）<br>氏名　　<input type="text" name="fullname" value="<?php echo $_SESSION['fullname'] ?>"><br>
    （半角英数字）<br>
    E メール<input type="email" name="email" value="<?php echo $_SESSION['email'] ?>"><br>
    <input type ="submit" name="confirm" value=" 確認">
    <input type ="submit" name="back" value="リセット">
    </form>
    
  <?php } else if( $mode == 'confirm') { ?>
    <form action="./registration.php" method="post">
      氏名　　  <?php echo $_SESSION['fullname'] ?><br>
      E メール　<?php echo $_SESSION['email'] ?><br>
      <input type="submit" name="back" value="修正">
      <input type="submit" name="send" value="完了">
    </form>
  <?php } else { ?>
      ご登録完了致しました。<br>
  <?php } ?>
    
</body>
</html>