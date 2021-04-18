<?php
$login = $password = $login_error = '';
if(isset($_POST['usrlogin'])){
    $login = validate($_POST['login']);
    $password = validate($_POST['password']);
    if(empty($password) && empty($login)){
        $login_error = 'Podane złe hasło lub login';
    }
    $polecenie = $pdo->prepare('SELECT login, password FROM users WHERE login = ?');
    $polecenie->execute([$login]);
    $user = $polecenie->fetch(PDO::FETCH_ASSOC);
    if(!empty($user) && isset($user)){
        
        //////TO DO szyfrowanie hasła w logowaniu i rejestracji chocby md5
        
        if($password == $user['password']){
            $_SESSION['user'] = $user['login'];
            header('location: index.php?page=usrpanel');
            exit;
        } else{
            $login_error = 'Podane złe hasło lub login'; 
        }
    }
}
$newlogin = $password1 = $password2 = $email = $imie = $nazwisko = $city = $adres = $zip = $phone = $register_error = '';
if(isset($_POST['usradd'])){
    $newlogin = validate($_POST['newlogin']);
    $password1 = validate($_POST['password1']);
    $password2 = validate($_POST['password2']);
    $email = validate($_POST['email']);
    $imie = validate($_POST['imie']);
    $nazwisko = validate($_POST['nazwisko']);
    $city = validate($_POST['city']);
    $adres = validate($_POST['adres']);
    $zip = validate($_POST['zip']);
    $phone = validate($_POST['phone']);
    if(empty($newlogin) || empty($password1) || empty($password2) || empty($email) || empty($imie) || empty($nazwisko)
            || empty($city) || empty($adres) || empty($zip) || empty($phone))
        $register_error = 'Jedno z pól jest puste.';
    if($password1 != $password2)
        $register_error = 'Podane hasła nie są takie same.';
    else if(strlen($newlogin)<6)
        $register_error = 'Login jest za krótki. Przynajmniej 6 znaków';
    else if(strlen($password1)<6)
        $register_error = 'Hasło jest za krótkie. Przynajmniej 6 znaków';
    
    ////// TO DO walidacje danych odpowiednie REGEX w pliku zam.php jest jako taki regex i validacja do wzorowania się
    
    else{
        $polecenie = $pdo->prepare('Select login FROM users WHERE login = ?');
        $polecenie->execute([$newlogin]);
        $logincheck = $polecenie->fetch(PDO::FETCH_ASSOC);
        if(!empty($logincheck))
            $register_error = 'Login zajęty';
        else{
            $polecenie = $pdo->prepare('Insert INTO users (login, password, email, imie, nazwisko, city, adres, zip, phone) VALUES (?,?,?,?,?,?,?,?,?)');
            $polecenie->execute([$newlogin, $password1, $email, $imie, $nazwisko, $city, $adres, $zip, $phone]);
            $_SESSION['user'] = $newlogin;
            header('location: index.php?page=usrpanel');
            exit;
        }
    }
}

if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
    header('location: index.php?page=usrpanel');
    exit;
}
?>


<?=template_header('Zaloguj się')?>



<div class="admlogin content-wrapper">
    <div>
	<h1>Zaloguj się</h1>
	</div>
	
	<form action="index.php?page=usrlogin" method="post">
        <div>
            <label>Login</label>
            <input type="text" name="login" required>
        </div>
        <div>
            <label>Hasło</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <?=$login_error ?>
        </div>
        <div>
            <button type="submit" name="usrlogin">Zaloguj</button>
        </div>        
    </form>
    
    <br>
    <h1>Nie masz jeszcze konta? Zarejestruj się!</h1>
    
    
    <form action="index.php?page=usrlogin" method="post">
        <div>
            <label>Login</label><span class="error">*</span>
            <input type="text" name="newlogin" pattern="[a-żA-Ż0-9-]+" size="20" value="<?= $newlogin;?>" required>
            
        </div>
        <div>
            <label>Hasło</label><span class="error">*</span>
            <input type="password" name="password1" size="20" required>
            
        </div>
        <div>
            <label>Powtórz hasło</label><span class="error">*</span>
            <input type="password" name="password2" size="20" required>
            
        </div>
        <div>
            <label>Email</label><span class="error">*</span>
            <input type="email" name="email" value="<?= $email;?>" size="30" required>
            
        </div>
        <div>
            <label>Imie</label><span class="error">*</span>
            <input type="text" name="imie" pattern="[a-żA-Ż0-9-]+" size="20" value="<?= $imie;?>" required>
            
        </div>
        <div>
            <label>Nazwisko</label><span class="error">*</span>
            <input type="text" name="nazwisko" pattern="[a-żA-Ż0-9-]+" size="20" value="<?= $nazwisko;?>" required>
            
        </div>
        <div>
            <label>Miasto</label><span class="error">*</span>
            <input type="text" name="city" value="<?= $city;?>" size="30" required>
            
        </div>
        <div>
            <label>Adres</label><span class="error">*</span>
            <input type="text" name="adres" value="<?= $adres;?>" size="30" required>
          
        </div>
        <div>
            <label>Kod pocztowy</label><span class="error">*</span>
            <input type="text" name="zip" value="<?= $zip;?>" pattern="[0-9\-]*" required>
            
        </div>
        <div>
            <label>Numer telefonu</label><span class="error">*</span>
            <input type="tel" name="phone" value="<?= $phone;?>" pattern="[0-9]{9}" required>
            
        </div>
        <div class="error">
            <?=$register_error ?>
        </div><br>
        <div>
            <button type="submit" name="usradd">Zarejestruj</button>
        </div>        
    </form>
</div>

<?=template_footer()?>