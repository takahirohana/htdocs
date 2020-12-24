<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>新規登録画面</title>
</head>
<body>
    <form action="./registration.php" method="post">
    （全角カナ　氏名間スペース必須）<br>氏名　　<input type="text" name="fullname" value=""><br>
    （半角英数字）<br>
    E メール<input type="email" name="email" value=""><br>
    <input type ="submit" name="confirm" value=" 確認">
    <input type ="submit" name="reset" value="リセット">
    </form>
</body>
</html>