<html>
<head><meta charset="utf-8"></head>
<body><?php
  $id = htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');    // ユーザID
  $pwd = htmlspecialchars($_GET['pwd'], ENT_QUOTES, 'UTF-8');  // パスワード
  // データベースに接続
  $dbh = new PDO('mysql:dbname=test', 'test', 'P@ssw0rd!');
  // SQLの組み立て
  $sql = "SELECT * FROM users WHERE id ='$id' AND pwd = '$pwd'";
  echo 'sql= ' . htmlspecialchars($sql, ENT_NOQUOTES, 'UTF-8') . '<br>';
  $stmt = $dbh->query($sql);  // クエリー実行
  if ($stmt->rowCount() > 0) { // SELECTした行が存在する場合ログイン成功
    echo 'ログイン成功です';
  } else {
    echo 'ログイン失敗です';
  }
  $dbh = 0;
?></body>
</html>
