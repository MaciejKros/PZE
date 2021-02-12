<?php

require('header.php');

function showCategory($category_id=null)
{
	global $pdo;
	
	if($category_id)
	{
		$stmt = $pdo->prepare("SELECT * FROM products WHERE category_id= :cid");
		$stmt -> bindValue(':cid',$category_id,PDO::PARAM_INT);
		$stmt -> execute();
	}
	else
	{
		$stmt = $pdo->prepare("SELECT * FROM products");
		$stmt -> execute();
	}
		
		
	
	echo "<table>";	
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			echo "<tr><td>";
			$indeks=$row['indeks'];
			$id=$row['product_id'];
			
			// zdjecie
			
			$images=getProductPictures($indeks);
			if(!empty($images))
			{
				$image=$images[0];
			}
			else
			{
				$image = 'no-photo.jpg';
			}
			echo "<img src='foto/mini/$image'>";
			
			echo "</td><td>";
			// nazwa towaru
			echo "<a href='product.php?product_id=$id'>";
			echo "<h3>".$row['name']."</h3>";
			echo "</a>";
			
			echo "</td><td>";
			// cena netto
			echo $row['net_price']." zł netto";
			echo "</td><tr>";

		}
	echo "</table>";
	
}




if (isset($_GET['cat_id']))
{
$category_id=$_GET['cat_id'];
}
else{
	$category_id=null;
}
showCategory($category_id);

require('footer.php');


