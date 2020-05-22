# 会員登録が混雑するとIDが重複してしまうサイトを作ってみた

- import.sql をmysqlコマンドかphpMyAdminで実行
- /var/www/html/wp にregister2.phpを配置
- abコマンドで下記を実行
```
$ ab -c 10 -n 50 "http://127.0.0.1:88/wp/register2.php?user=taku"
```
動画はこちら
[会員登録が混雑するとIDが重複してしまうサイトを作ってみた - YouTube](https://www.youtube.com/watch?v=VfGrpX3V6j8)
