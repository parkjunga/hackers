<?php
session_start();
session_destroy();
header("Location:http://test.hackers.com/member/index.php");
?>