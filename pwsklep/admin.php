<?php

require('header.php');
?>

<?php

if ($session->getUser()->isAnonymous())
{
	require('login.php');
}
else
{
	if($session->getUser()->isAdmin())
	{
		echo "Witaj, admin";
		echo "<br><br>";
		
		echo "<a href='addProducts.php'>Dodaj produkt</a>";
	}
}

?>

<?php
require('footer.php');
?>