<?php // 脆弱なサンプル

class D {  // 本来シリアライズされるはずのクラス
}
class E {  // 攻撃に悪用されるクラス
  private $func;
  private $args;
  public function __construct($func, $args) {
    $this->func = $func;
    $this->args = $args;
  }
  public function __destruct() {
    call_user_func_array($this->func, $this->args);
  }
}

$cookie = "O:1:\"E\":2:{s:7:\"\0E\0func\";s:6:\"system\";s:7:\"\0E\0args\";a:1:{i:0;s:3:\"ver\";}}"; // $_COOKIE['foo'];
$foo = unserialize($cookie);