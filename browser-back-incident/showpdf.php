<?php
session_start();
$reportid = $_SESSION['reportid'];
header('Content-Type: application/pdf');
require_once 'idiorm.php';

ORM::configure('mysql:host=127.0.0.1;dbname=wasbook;charset=utf8');
ORM::configure('username', 'wasbook');
ORM::configure('password', 'wasbook');
ORM::configure('logging', true);
$report = ORM::for_table('reports')->where('reportid', $reportid)->find_one()->as_array();
readfile('wp-content/uploads/' . $report['filename']);
