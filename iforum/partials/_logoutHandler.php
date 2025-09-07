<?php
session_start();
session_encode();
session_destroy();

header("location: /php_tut/iforum/index.php");
exit();
?>