# 間違ったSQLインジェクション対策の攻略法

- 本日お伝えしたいこと
  - 間違ったSQLインジェクション対策でhtmlspecialcharsを使う人がいます
  - htmlspecialcharsでも一見大丈夫そうですが、実はだめなことを紹介します
- 前提となる環境
  - PHPとMySQLが動く環境

# PoC

```
正常なログイン:
http://example.jp/login.php?id=yamada&pwd=sn6s3n

よく見かける攻撃（うまくいかない）
http://example.jp/login.php?id=yamada&pwd='OR'a'='a


```


動画URL : []()

YouTubeチャンネル　[徳丸浩のウェブセキュリティ講座](https://www.youtube.com/channel/UCLNW6Bo_YU3TxnzsII2gEDA)
