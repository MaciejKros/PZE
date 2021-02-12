<?php

require('header.php');
?>

<?php
	$cart->add($_GET['id']);
	header('Location: showcart.php');

?>

<?php
require('footer.php');
?>