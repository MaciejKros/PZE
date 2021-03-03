<?php
if(!(isset($_SESSION['user']) && !empty($_SESSION['user']))){
    header("location: index.php");
    exit;
}

$newpassword1 = $newpassword2 = $password = $error = '';
if(isset($_POST['passupdate'])){
    $newpassword1 = validate($_POST['newpassword1']);
    $newpassword2 = validate($_POST['newpassword2']);
    $password = validate($_POST['password']);
    if(empty($newpassword1) || empty($newpassword2) || empty($password))
        $error = 'Jedno z pól jest puste.';
    else if($newpassword1 != $newpassword2)
        $error = 'Podane hasła nie są takie same.';
    else if(strlen($newpassword1)<6)
        $error = 'Hasło jest za krótkie. Przynajmniej 6 znaków.';
    else if($newpassword1 == $password)
        $error = 'Nowe i stare hasła są takie same.';
    else{
        $polecenie = $pdo->prepare('Select login FROM users WHERE login = ? AND password = ?');
        $polecenie->execute([$_SESSION['user'], $password]);
        $oldpass = $polecenie->fetch(PDO::FETCH_ASSOC);
        if(!empty($oldpass) && isset($oldpass)){
            $polecenie = $pdo->prepare('Update users SET password = ? WHERE login = ?');
            $polecenie->execute([$newpassword1, $_SESSION['user']]);
            header('location: index.php?page=usrpanel');
            exit;
        } else{
            $error = 'Błędne stare hasło.';
        }
    }
}
?>

<?=template_header('Zmień hasło')?>

<div class="admlogin content-wrapper usrpanel">
    <?=usrpanel_menubar(); ?>
    <form action="index.php?page=editpass" method="post">
        <div>
            <label>Nowe Hasło:</label>
            <input type="password" name="newpassword1" size="20" required>
        </div>
        <div>
            <label>Powtórz nowe hasło:</label>
            <input type="password" name="newpassword2" size="20" required>
        </div>
        <div>
            <label>Stare hasło:</label>
            <input type="password" name="password" size="20" required>
        </div>
        <div>
            <button type="submit" name="passupdate">Zmień hasło</button>
        </div><br>      
        <div class="error">
            <?=$error ?>
        </div>  
    </form>
</div>

<?=template_footer()?>