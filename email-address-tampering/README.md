# 徳丸本VMに1行追加するだけでメールアドレス改ざんの実習環境を作ろう

- 本日お伝えしたいこと
    - 認可制御不備にてメールアドレスが変更できる脆弱性
    - その実習環境の作り方
    - 実習の方法

- 前提となる環境
    - 徳丸本VM
    - OWASP ZAP (Burp Suite等でも可）

# 徳丸本VMに追加する1行(ターミナルで編集)

/var/www/html/todo/changemail.php: 41行目追加
```
    <input type="hidden" name="<?php e(TOKENNAME); ?>" value="<?php e($token); ?>">
+   <input type="hidden" name="id" value="<?php e($reqid); ?>">
    <?php if ($reqid !== $id) : ?>
```

# ブラウザでの操作

- 徳丸本VMのトップページから「7 Bad Todo」をクリック
- ログインページに遷移して「初めての方はこちら」をクリック
- 以下の内容を入力して、確認、登録
  - ユーザID: alice
  - パスワード: alice
  - メールアドレス: carol@example.jp  （なんでもよい）
  - アイコン画像: 適当なもの　（なんでもよい）
- ログイン画面で、alice / alice でログイン
- マイページに遷移
- メールアドレス変更を選択
- alice@example.jpを入力するが、まだ「変更」は押さない
- OWASP ZAPでブレークポイントを設定する
- ブラウザで「変更」ボタンを押す
- OWASP ZAPで、POSTパラメータ id の値を 3 から 1 に変更する
- ブレークポイントを解除して流す
- ログアウトする
- ログイン画面から、「パスワードを忘れた方」をクリック
- メールアドレスをalice@example.jpを入力して、変更ボタンを押す
- Roundcube で、alice / wasbook でログイン
- Roundcube で alice@example.jpのメールを受信してパスワードの情報(passwd)を得る
- Bad Todo で admin / passwd でログインする



# 参考記事

- [お名前.com Naviで発生した事象につきまして](https://www.onamae.com/news/domain/20200603_1/)


動画URL : []()

YouTubeチャンネル　[徳丸浩のウェブセキュリティ講座](https://www.youtube.com/channel/UCLNW6Bo_YU3TxnzsII2gEDA)
