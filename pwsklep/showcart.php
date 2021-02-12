<?php

require('header.php');
?>
<h1>Zawartość koszyka</h1>
<table border>
<?php

	$inCart = $cart->getProducts();

	echo"<tr><td>Indeks</td><td>Nazwa produktu</td><td>Cena netto</td><td>Ilość</td><td>Wartość netto</td><tr>";
	
	$sum=0;
	foreach ($inCart as $product)
	{
		$productCartId = $product['id'];
		$net_price=$product['net_price'];
		$quantity = $product['quantity'];
		$indeks=$product['indeks'];
		$name=$product['name'];
		$total = $quantity * $net_price;
		$sum+=$total;
		$id=$product['product_id'];

		
		$plus = "<a href='addtocart.php?id=$id'>+</a>";
		$minus = "<a href='remfromcart.php?id=$id'>-</a>";
		
		echo"<tr><td>$indeks</td><td>$name</td><td>$net_price</td><td>$quantity $plus $minus</td><td>".$quantity * $net_price."</td><tr>";
	}
	//var_dump($cart->getProducts());

?>
</table>

<h4>Wartość koszyka <?php echo $sum?> zł netto</h4>
<h4>Wartość koszyka <?php echo $sum * 1.23?> zł brutto</h4>


<h4><a href='order.php'><i class="demo-icon icon-ok"></i>Złóż zamówienie </a></h4>
<?php
require('footer.php');
?>