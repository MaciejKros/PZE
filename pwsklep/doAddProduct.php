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

		
		$indeks = $_POST['indeks'];
		$name = $_POST['name'];
		$net_price = $_POST ['net_price'];
		$description = $_POST['description'];
		$category_id = $_POST['category'];
				
		// zapis do DB
		
		$stmt = $pdo->prepare('INSERT INTO products (product_id, indeks ,name, net_price, description, category_id) VALUES (null, :indeks,:name, :net_price, :description, :category_id)');
		$stmt->bindValue(':indeks', $indeks, PDO::PARAM_STR);
		$stmt->bindValue(':name', $name, PDO::PARAM_STR);
		$stmt->bindValue(':net_price', $net_price, PDO::PARAM_STR);
		$stmt->bindValue(':description', $description, PDO::PARAM_STR);
		$stmt->bindValue(':category_id', $category_id, PDO::PARAM_INT);
		$stmt->execute();
		
		header('Location: admin.php');
		
		
		
	}
}

?>

<?php
require('footer.php');
?>