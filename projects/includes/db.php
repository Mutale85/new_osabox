<?php
	session_start();
	session_name();
	$PASS = "MutaleMulenga@19@85";
	$USER = "root";
	$dbname = "MoneyMatters";
	$connect = new PDO("mysql:host=localhost;dbname=MoneyMatters;", "root", "");
	// $connect = new PDO("mysql:host=localhost;dbname=$dbname;", $USER, $PASS);
	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	include 'functions.php';
	ini_set("pcre.jit", "0");

	// $query = $connec->prepare("SELECT * FROM sessions WHERE cookie_id = ? AND user_location = ?"); 
?>