<?php

session_start();
include 'funkcje.php';
$pdo = pdoConnect();

$page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'home';

if (isset($_GET['logout']) && !empty($_GET['logout']) && is_numeric($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['admin']);
	header("location: index.php");
        exit;
}
if (isset($_GET['usrlogout']) && !empty($_GET['usrlogout']) && is_numeric($_GET['usrlogout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: index.php?kom=1");
        exit;
}
if(($page == 'usrpanel' || $page == 'editdo' || $page == 'editpass' || $page == 'ordershistory')){
    if(!(isset($_SESSION['user']) && !empty($_SESSION['user']))){
        $page = 'home';
	header("location: index.php");
        exit;
    } 
}
if(($page == 'panel' || $page == 'zamowienia' || $page == 'kategorie')){
    if(!(isset($_SESSION['admin']) && !empty($_SESSION['admin']))){
        $page = 'home';
	header("location: index.php");
        exit;
    } 
}

include $page . '.php';
?>