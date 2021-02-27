<?php
if(!(isset($_SESSION['user']) && !empty($_SESSION['user']))){
    header("location: index.php");
    exit;
}
$error = '';
$polecenie = $pdo->prepare('Select email, imie, nazwisko, city, adres, zip, phone from users where login = ?');
$polecenie->execute([$_SESSION['user']]);
$daneosobowe = $polecenie->fetch(PDO::FETCH_ASSOC);
$email = $daneosobowe['email'];
$imie = $daneosobowe['imie'];
$nazwisko = $daneosobowe['nazwisko'];
$city = $daneosobowe['city'];
$adres = $daneosobowe['adres'];
$zip = $daneosobowe['zip'];
$phone = $daneosobowe['phone'];

if(isset($_POST['usrupdate'])){
    $email = validate($_POST['email']);
    $imie = validate($_POST['imie']);
    $nazwisko = validate($_POST['nazwisko']);
    $city = validate($_POST['city']);
    $adres = validate($_POST['adres']);
    $zip = validate($_POST['zip']);
    $phone = validate($_POST['phone']);
    
    /// dać tą samą walidację danych co przy rejestracji w usrlogin.php
    
    $polecenie = $pdo->prepare('Update users SET email=?, imie=?, nazwisko=?, city=?, adres=?, zip=?, phone=? WHERE login = ?');
    $polecenie->execute([$email, $imie, $nazwisko, $city, $adres, $zip, $phone, $_SESSION['user']]);
    header('location: index.php?page=editdo');
    exit;
}
?>

<?=template_header('Edytuj dane osobowe')?>
<div class="admlogin content-wrapper usrpanel">
    <br>
    <div class="usrbuttons">
        <div style="width: 49%;"><a href="index.php?page=usrpanel">Wróć do panelu użytkownika</a></div>
        <div style="width: 49%;"><a href="index.php?usrlogout=1">Wyloguj</a></div>
    </div><br>
    <h1>Edytuj dane osobowe.</h1>
    <form action="index.php?page=editdo" method="post">
        <div>
            <label>Email:</label>
            <input type="email" name="email" value="<?= $email;?>" size="30" required>
        </div>
        <div>
            <label>Imie:</label>
            <input type="text" name="imie" pattern="[a-zA-Z-]+" size="20" value="<?= $imie;?>" required>
        </div>
        <div>
            <label>Nazwisko:</label>
            <input type="text" name="nazwisko" pattern="[a-zA-Z-]+" size="20" value="<?= $nazwisko;?>" required>
        </div>
        <div>
            <label>Miasto:</label>
            <input type="text" name="city" value="<?= $city;?>" size="30" required>
        </div>
        <div>
            <label>Adres:</label>
            <input type="text" name="adres" value="<?= $adres;?>" size="30" required>
        </div>
        <div>
            <label>Kod pocztowy:</label>
            <input type="text" name="zip" value="<?= $zip;?>" pattern="[0-9\-]*" required>
        </div>
        <div>
            <label>Numer telefonu:</label>
            <input type="tel" name="phone" value="<?= $phone;?>" pattern="[0-9]{9}" required>
        </div>
        <div class="error">
            <?=$error ?>
        </div><br>
        <div>
            <button type="submit" name="usrupdate">Potwierdz</button>
        </div>        
    </form>
</div>
<?=template_footer()?>