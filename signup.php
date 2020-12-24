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
    （全角カナ　氏名間スペース必須）<br>氏名　　<input type="text" name="name" value="<?php echo $_SESSION['name'] ?>"><br>
    （半角英数字）<br>
    E メール<input type="email" name="email" value="<?php echo $_SESSION['email'] ?>"><br>
    <input type ="submit" name="confirm" value=" 確認">
    <input type ="submit" name="back" value="リセット">
    </form>
    
  <?php } else if( $mode == 'confirm') { ?>
    <form action="./registration.php" method="post">
      氏名　　  <?php echo $_SESSION['name'] ?><br>
      E メール　<?php echo $_SESSION['email'] ?><br>
      <input type="submit" name="back" value="修正">
      <input type="submit" name="send" value="完了">
    </form>
  <?php } else { ?>
      ご登録完了致しました。<br>
  <?php } ?>
    
</body>
</html>