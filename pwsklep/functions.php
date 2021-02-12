<?php

define('SESSION_COOKIE','cookiesklep');
define('SESSION_ID_LENGHT',40);
define('SESSION_COOKIE_EXPIRE',3600);

function showMenu()
{
	global $pdo, $session;
	$stmt=$pdo->prepare("SELECT * FROM categories");
	$stmt->execute();
	
	echo '<div id="menu">';
	echo "<a href='index.php'>Strona główna</a><br/>";
	echo "-----------------------<br/>";
	echo"<a href='showcart.php'><i class='demo-icon icon-basket-1'></i>Koszyk</a><br>";
	echo "-----------------------<br/>";
	echo "Kategorie<br/>";
	
	while($row=$stmt->fetch(PDO::FETCH_ASSOC))
	{
		$name= $row['name'];
		$id=$row['category_id'];
		echo"<a href='index.php?cat_id=$id'>$name</a>";
		echo"<br/>";
	}
	
	echo "-----------------------<br/>";
	
	echo "<a href='admin.php'>Panel admina</a><br>";
	
	echo "-----------------------<br/>";
	
	if(!$session->getUser()->isAnonymous()){
		echo "<a href='logout.php'>Wyloguj</a>";
	}
	
	echo"</div>";

}

function getProductPictures($indeks)
{
	$image=array();
	
	for($i=0;$i<10;$i++)
	{
		$filename=$indeks."-".$i.".jpg";
		$filepath="foto/$filename";
		if(file_exists($filepath))
		{
			$image[]=$filename;
		}
		
	}
	return $image;
}

function random_session_id()
{
	$utime=time();
	$id= random_salt(40-strlen($utime)).$utime;
	return $id;
}

function random_salt($len)
{
	return random_text($len);
}

function random_text($len)
{
	$base = 'QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm1234567890';
	$max = strlen($base)-1;
	$rstring = '';
	mt_srand((double)microtime()*1000000);
	while(strlen($rstring)<$len)
		$rstring.=$base[mt_rand(0, $max)];
	return $rstring;
}

?>