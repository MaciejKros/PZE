<?php
$imie = $nazwisko = $adres = $email = '';
$imieerr = $nazwiskoerr = $adreserr = $emailerr = $telefonerr = '';
(int)$telefon = NULL;

if (isset($_POST) && !empty($_POST)) {
    if (empty($_POST["imie"])) {
        $imieerr = "Nie podano imienia.";
    } else {
        $imie = validate($_POST["imie"]);
        
        if (preg_match("/[^A-Za-ząćęłńóśźżĄĆĘŁŃÓŚŹŻ ]/", $imie)) {
            $imieerr = "Użyto niedozwolonych znaków.";
        }
    }
    
    if (empty($_POST["nazwisko"])) {
        $nazwiskoerr = "Nie podano nazwiska.";
    } else {
        $nazwisko = validate($_POST["nazwisko"]);
        
        if (preg_match("/[^A-Za-ząćęłńóśźżĄĆĘŁŃÓŚŹŻ -]/",$nazwisko)) {
            $nazwiskoerr = "Użyto niedozwolonych znaków.";
        }
    }
    
    if (empty($_POST["adres"])) {
        $adreserr = "Nie podano adresu.";
    } else {
        $adres = validate($_POST["adres"]);
        
        if (preg_match("/[^A-Za-z0-9ąćęłńóśźżĄĆĘŁŃÓŚŹŻ\\.\\,\\/ -]/",$adres)) {
            $adreserr = "Użyto niedozwolonych znaków.";
        }
    }
        
    if (empty($_POST["email"])) {
        $emailerr = "Nie podano emaila.";
    } else {
        $email = validate($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailerr = "Błąd w podany emailu.";
        }
    }
    
    if (empty($_POST["telefon"])) {
        $telefonerr = "Podany numer jest za krótki lub za długi.(9 cyfr)";
    } else {
        $telefon = validate($_POST["telefon"]);    
        if (!preg_match("/^[0-9]+$/",$telefon)) {
            $telefonerr = "Tylko cyfry dozwolone.";
        } else if($telefon<=99999999 || $telefon>999999999){
            $telefonerr = "Podany numer jest za krótki lub za długi.(9 cyfr)";
        }
    }

}

// $liczba_w_koszyku zawiera tablicę z id produktów w koszyku jeżeli koszyk istnieje
$liczba_w_koszyku = isset($_SESSION['koszyk']) ? $_SESSION['koszyk'] : array();
$produkty = array();
$wSumie = 0.00;
// pobieranie produktów znajdujących się w koszyku z bazy danych 
if ($liczba_w_koszyku) {
    //za każdy produkt w koszyku dodajemy '?,' do $znaki_zapytania które potem są dodawane do zapytania SQL do bazy
    $znaki_zapytania = implode(',', array_fill(0, count($liczba_w_koszyku), '?'));
    $polecenie = $pdo->prepare('SELECT * FROM produkty WHERE id IN (' . $znaki_zapytania . ')');
    // każdy klucz koszyk jest id produktu i tylko to jest potrzebne w zapytaniu SQL
    $polecenie->execute(array_keys($liczba_w_koszyku));
    $produkty = $polecenie->fetchAll(PDO::FETCH_ASSOC);
    // obliczamy sumę koszyka
    foreach ($produkty as $produkt) {
        $wSumie += (float)$produkt['cena'] * (int)$liczba_w_koszyku[$produkt['id']];
    }
}

if (isset($_POST['ptw']) && isset($_SESSION['koszyk']) && !empty($_SESSION['koszyk'])) {
    if(empty($imieerr) && empty($nazwiskoerr) && empty($adreserr) && empty($emailerr) && empty($telefonerr)){
        $polecenie = $pdo->prepare('INSERT INTO `zamowienia`(`imie`, `nazwisko`, `adres`, `email`, `telefon`) VALUES (?,?,?,?,?)');
        $polecenie->execute([$imie, $nazwisko, $adres, $email, $telefon]);
        $zam_id = $pdo->lastInsertId();
        $message='';
        foreach($produkty as $produkt){
            $message = $message.$produkt['nazwa'].'  '.$produkt['cena'].'  '.$liczba_w_koszyku[$produkt['id']].'  '.$produkt['cena'] * $liczba_w_koszyku[$produkt['id']].'PLN'.PHP_EOL;
            $polecenie = $pdo->prepare('INSERT INTO `zamowienia_produkty`(zam_id, prod_id, ilosc_prod) VALUES (?,?,?)');
            $polecenie->execute([$zam_id, $produkt['id'], $liczba_w_koszyku[$produkt['id']]]);
        }
        $message = $message.'Razem:  '.$wSumie.'PLN';
        $to='zamowienia@pseudosklep.com';
        $subject='Zamówienie';
        mail($to, $subject, $message);
        unset($_POST);
        unset($_SESSION['koszyk']);
        header('Location: index.php?page=podziekowanie');
        exit;
    }
} 

?>

<?=template_header('Potwierdzenie')?>
<div class="cart content-wrapper">
    <h1>Potwierdzenie zamówienia</h1>
    <table>
        <thead>
            <tr>
                <td colspan="2">Produkt</td>
                <td>Cena</td>
                <td>Ilość</td>
                <td>Razem</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produkty as $produkt): ?>
            <tr>
                <td class="img">
                        <img src="imgs/<?=isset($produkt['img'])&&!empty($produkt['img']) ? $produkt['img']:'default.jpg'?>" width="50" height="50" alt="<?=$produkt['nazwa']?>">
                </td>
                <td><?=$produkt['nazwa']?></td>
                <td class="price"><?=$produkt['cena']?>&#122;&#322;</td>
                <td><?=$liczba_w_koszyku[$produkt['id']]?></td>
                <td class="price"><?=$produkt['cena'] * $liczba_w_koszyku[$produkt['id']]?>&#122;&#322;</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <div class="subtotal">
        <span class="text">Razem:</span>
        <span class="price"><?=$wSumie?>&#122;&#322;</span>
    </div>
    <form action="index.php?page=zam" method="post" class="daneosobowe">
        <div>
            <label>Imie: </label>
            <input type="text" name="imie" value="<?=$imie ?>">
            <span class="error">*<?=$imieerr ?></span>
        </div>
        <div>
            <label>Nazwisko: </label>
            <input type="text" name="nazwisko" value="<?=$nazwisko ?>">
            <span class="error">*<?=$nazwiskoerr ?></span>
        </div>
        <div>
            <label>Adres: </label>
            <input type="text" name="adres" value="<?=$adres ?>">
            <span class="error">*<?=$adreserr ?></span>
        </div>
        <div>
            <label>Email: </label>
            <input type="text" name="email" value="<?=$email ?>">
            <span class="error">*<?=$emailerr ?></span>
        </div>
        <div>
            <label>Numer telefonu: </label>
            <input type="number" name="telefon" value="<?=$telefon ?>">
            <span class="error">*<?=$telefonerr ?></span>
        </div>
        <div>
            <button type="submit" name="ptw">Potwierdz</button>
        </div>
    </form>    
</div>    

<?=template_footer()?>