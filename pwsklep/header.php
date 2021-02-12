<?php
    ob_start(); // Initiate the output buffer
?>
<?php
require('sessions.php');
require('functions.php');
require('request.php');
require('user.php');
require('cart.php');
?>

<?php
$pdo=new PDO('mysql:host=localhost;port=3306;dbname=zadanie2','root','');
//$pdo=new PDO('mysql:host=localhost;dbname=32182190_baza','32182190_baza','3vyy8os2A,');

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec("SET NAMES 'utf8'");

$request = new userRequest;
$session = new session;
$cart=new cart;

?>



<!DOCTYPE HTML>
<html lang="pl">
<head>
	<title>Zadanie zaliczeniowe</title>
	<meta charset='utf-8'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="stylesheet" href="styles.css" type="text/css"/>
	<link rel="stylesheet" href="css/ok.css" type="text/css"/>
	<link rel="stylesheet" href="css/lightbox.css" />
	<script src="js/lightbox-plus-jquery.js"></script>
</head>

<body>

<div id="container">
	<div id="logo"><h1>Sklep z programami komputerowymi</h1></div>
	<div id="box">


<?php
showMenu();
?>


<div id='products'>
