<?php
  $username = $_REQUEST['user'];
  $mysqli = new mysqli('127.0.0.1', 'root', 'wasbook', 'wasbook');
  $result = $mysqli->query("SELECT MAX(id) FROM users2");
  $row = $result->fetch_row();
  $id_max = $row[0];
  $stmt = $mysqli->prepare("INSERT INTO users2 (id, username) VALUES(?, ?)");
  $stmt->bind_param('ds', $max, $username);
  $max = $id_max + 1;
  $stmt->execute();
  $mysqli->close();
