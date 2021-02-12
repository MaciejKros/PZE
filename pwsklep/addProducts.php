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
		echo "<form action='doAddProduct.php' method='post'>";
		echo "Indeks:<br> <input type='text' name='indeks'><br>";
		echo "Nazwa:<br> <input type='text' name='name'><br>";
		echo "Cena netto:<br> <input type ='text' name='net_price'><br>";
		echo "Opis:<br> <textarea name='description'></textarea><br>";
		
		$stmt = $pdo->prepare("SELECT * FROM categories");
		$stmt->execute();
		
		$rows= $stmt->fetchAll(PDO::FETCH_ASSOC);
		echo "Kategoria:<br> <select name='category'>";
		foreach ($rows as $category){
			$category_id=$category['category_id'];
			$name = $category['name'];
			echo "<option value='$category_id'>$name</option>";
			
		}
		echo "</select>";
		
		echo "<input type='submit' value='Dodaj'>";
	}
}

?>

<?php
require('footer.php');
?>