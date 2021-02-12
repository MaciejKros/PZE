<?php

require('header.php');
?>



<?php
	
	// zapisz informajce o zamówieniu do DB
	
	$stmt=$pdo->prepare("INSERT INTO orders(order_id, customer, address, email) VALUES (null, :customer, :address, :email)");
	$stmt->bindValue(':customer',$_POST['customer'], PDO::PARAM_STR);
	$stmt->bindValue(':email',$_POST['email'], PDO::PARAM_STR);
	$stmt->bindValue(':address', $_POST['address'], PDO::PARAM_STR);
	$stmt->execute();
	
	$orderId = $pdo->lastInsertId();

	$orderedProducts = $cart->getProducts();
	
	foreach($orderedProducts as $product)
	{
	$pid = $product['product_id'];
	$qty = $product['quantity'];
	
	$stmt = $pdo->prepare("INSERT INTO ordersproducts (ordersproducts_id, order_id, product_id, quantity) VALUES (null, :orderId, :pid, :qty)");
	$stmt->bindValue(':orderId', $orderId, PDO::PARAM_INT);
	$stmt->bindValue(':pid', $pid, PDO::PARAM_INT);
	$stmt->bindValue(':qty', $qty, PDO::PARAM_INT);
	$stmt->execute();
	}
	
	$cart->clear();
	
	echo"<h1>Dziękujemy za złożenie zamówienia</h1>";
	
	//wyślij maila potwierdzającego
	mail($_POST['address'], "Zamówienie numer $orderId", "Potwierdzamy złożenie zamówienia");

?>


<?php
require('footer.php');
?>