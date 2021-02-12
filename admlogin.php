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
    <form action="index.php?page=admlogin" method="post">
        <div>
            <label>Login:</label>
            <input type="text" name="login" required>
        </div>
        <div>
            <label>Hasło:</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <?=$login_error ?>
        </div>
        <div>
            <button type="submit" name="admlogin">Login</button>
        </div>        
    </form>
</div>

<?=template_footer()?>