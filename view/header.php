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
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
</head>

<body>
	<header>
	    <section class="header">
    		<p class="title"> Data Center League </p>
	    </section>
	    <!--<nav>
	        <ul>
	            <a href="/"> <li> Home </li> </a>
	            <a href="/rules.php"> <li> Rules </li> </a>
	            <a href="/scoring.php"> <li> Scoring </li> </a>
	            <a href="/prizes.php"> <li> Prizes </li> </a>
	            <a href="/schedule.php"> <li> Schedule </li> </a>
	        </ul>
	    </nav> -->
	    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		  <a class="navbar-brand" href="#">Data Center League</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		    <div class="navbar-nav">
		      <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
		      <a class="nav-item nav-link" href="#">Rules</a>
		      <a class="nav-item nav-link" href="#">Scoring</a>
		      <a class="nav-item nav-link" href="#">Prizes</a>
		      <a class="nav-item nav-link" href="#">Schedule</a>
		    </div>
		  </div>
		</nav>
	</header>