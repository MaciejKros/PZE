<?php

require('header.php');

if ($session -> getUser() -> isAnonymous()){
	$result=user::checkPasswords($_POST['login'], $_POST['password']);
	
	if($result instanceof user){
		//zalogowany
		$session->updateSession($result);
	}

	header('Location: admin.php');

}

require('footer.php');
?>