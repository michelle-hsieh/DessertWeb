<?php
    session_start();
	$_SESSION['user_email']="";
	session_destroy();
	header('location:../betty/index.php'); //位置待改
?>