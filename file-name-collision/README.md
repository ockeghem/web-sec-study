# 大抵の解説記事に存在するファイル名重複チェック時のTOCTOU脆弱性

- import.sql をmysqlコマンドかphpMyAdminで実行
- /var/www/html/44 にupload.phpを配置
- abコマンドで下記を実行
```

$ sudo mkdir /var/www/html/44/uploads
$ sudo chown www-data:www-data /var/www/html/44/uploads
$ ab -c 10 -n 50 "http://127.0.0.1:88/44/upload.php?file=a.jpg
```
動画はこちら
[大抵の解説記事に存在するファイル名重複チェック時のTOCTOU脆弱性]()
