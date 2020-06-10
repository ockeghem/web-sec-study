<?php
session_start();
header('Content-Type: application/pdf');
// $_SESSION['reportid'] = 'R1000000301';
require_once 'idiorm.php';

ORM::configure('mysql:host=127.0.0.1;dbname=wasbook;charset=utf8');
ORM::configure('username', 'wasbook');
ORM::configure('password', 'wasbook');
ORM::configure('logging', true);
$report = ORM::for_table('reports')->where('reportid', $_SESSION['reportid'])->find_one()->as_array();
// var_dump($report);
header('Content-Disposition: inline; filename="' . $report['filename'] . '"');
readfile('wp-content/uploads/' . $report['filename']);
error_log(ORM::get_last_query());
