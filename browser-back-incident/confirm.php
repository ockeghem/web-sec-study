<body>
<?php
session_start();
 var_dump($_SESSION['reportid']);
?>
<a href="done.php">確認</a><br>
<!-- <iframe src="showpdf.php"></iframe><br> -->
<embed src="showpdf.php" type="application/pdf" width="50%" height="30%">>
</body>
