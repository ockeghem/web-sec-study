<?php
  define('UPLOADPATH', './uploads');
  function get_upload_file_name($tofile) {
    $info = pathinfo($tofile);
    $base  = $info['filename'];
    $ext = $info['extension'];
    // 以下、ユニークなファイル名の生成
    $i = 0;
    $file = sprintf('%s/%s.%s', UPLOADPATH, $base, $ext);
    while (file_exists($file) && $i < 10) {
      $file = sprintf('%s/%s_%d.%s', UPLOADPATH, $base, ++$i, $ext);
    }
    if ($i >= 10) {
      die('cannot generate file name');
    }
    return $file;
  }
  try {
    $mt = microtime();
    $filename = get_upload_file_name($_GET['file']);
    file_put_contents($filename, 'IMAGE FILE');

    $db = new PDO("mysql:host=127.0.0.1;dbname=wasbook;charset=utf8", 'root', 'wasbook');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $sql = "INSERT INTO imagedb (filename, cdate) VALUES(?, ?)";
    $ps = $db->prepare($sql);
    $ps->bindValue(1, $filename);
    $ps->bindValue(2, $mt);
    $ps->execute();
  } catch (PDOException $e) {
    $error = $e->getMessage();
    die($error);
  }
  $db = null;
