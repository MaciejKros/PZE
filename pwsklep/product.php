<?php

require('header.php');
?>

<?php
function showProduct($id)
{
	global $pdo;
	
	$stmt=$pdo->prepare("SELECT * FROM products WHERE product_id = :id");
	$stmt->bindValue(':id',$id,PDO::PARAM_INT);
	$stmt->execute();
	
	while($row=$stmt->fetch(PDO::FETCH_ASSOC))
	{
		echo'<div id = "item">';
		echo"<h2>".$row['name']."</h2>";
		echo"<h3>Cena netto: ".$row['net_price']."</h3>";
		$indeks=$row['indeks'];
		
		foreach (getProductPictures($indeks) as $image)
		{
			echo "<a href='foto/$image' data-lightbox='$indeks'>";
			echo "<img src='foto/thumbs/$image'>";
			echo "</a>";
			echo "<br>";
		}
		echo $row['description'];
		echo"<br><br>";
		$id=$row['product_id'];
		echo "<a href='addtocart.php?id=$id'><i class='demo-icon icon-cart-arrow-down'></i>Dodaj do koszyka</a>";
		
		echo"</div>";
	}
}		
		
if(isset($_GET['product_id']))
{
	showProduct($_GET['product_id']);
}

		
?>		

<?php
require('footer.php');
?>