<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$doc_root = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT', FILTER_SANITIZE_STRING);
//require_once($doc_root . "/model/database.php");
//require_once($doc_root . "/model/category_db.php");
//require_once($doc_root . "/model/product_db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Fantasy Football</title>
	<meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/main.css">
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
</head>

<body>
	<header>
	    <section class="header">
    		<p class="title"> Data Center League </p>
	    </section>
	    <nav>
	        <ul>
	            <a href="/"> <li> Home </li> </a>
	            <a href="/rules.php"> <li> Rules </li> </a>
	            <a href="/scoring.php"> <li> Scoring </li> </a>
	            <a href="/prizes.php"> <li> Prizes </li> </a>
	            <a href="/schedule.php"> <li> Schedule </li> </a>
	        </ul>
	    </nav>
	</header>