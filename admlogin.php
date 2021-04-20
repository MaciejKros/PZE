<?php 
$login = $password = $login_error = '';
if(isset($_POST['admlogin'])){
    $login = validate($_POST['login']);
    $password = validate($_POST['password']);
    if(empty($password) && empty($login)){
        $login_error = 'Podane złe hasło lub login';
    }
    $polecenie = $pdo->prepare('SELECT * FROM admin WHERE login = ?');
    $polecenie->execute([$login]);
    $admin = $polecenie->fetch(PDO::FETCH_ASSOC);
    if(!empty($admin) && isset($admin)){
        $password = md5($admin['salt'].$password);
        if($password == $admin['password']){
            $_SESSION['admin']=$admin['login'];
            header('location: index.php?page=panel');
            exit;
        }
    } else{
        $login_error = 'Podane złe hasło lub login'; 
    }
}
if(isset($_SESSION['admin']) && !empty($_SESSION['admin'])){
    header('location: index.php?page=panel');
    exit;
}

?>

<?=template_header_adm('Zaloguj się')?>

<div class="admlogin content-wrapper">
	<h1>Content Management System</h1>
	<h2>Zaloguj się do Systemu Zarządzania Treścią</h2>
    <form action="index.php?page=admlogin" method="post">
		<div>
			<!-- <label>Login:</label> -->
			<input class="inputlogin" type="text" name="login" required placeholder="Login">
		</div>
		<div>
			<!-- <label>Hasło:</label> -->
			<input class="inputlogin" type="password" name="password" required placeholder="Hasło">
		</div>
		<div>
			<?=$login_error ?>
		</div>
		<div>
			<button type="submit" name="admlogin">Zaloguj się</button>
		</div>        
    </form>
</div>

<?=template_footer()?>