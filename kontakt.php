<?php
$imie = $nazwisko = $email = $temat = $wiadomosc = '';
$imieerr = $nazwiskoerr = $emailerr = $tematerr = $wiadomoscerr = '';
$polishRegex = "#^[A-Ża-ż]+$#u";
$errNum=0;

if(isset($_POST['send'])){
    $imie = validate($_POST['imie']);
    $nazwisko = validate($_POST['nazwisko']);
    $email = validate($_POST['email']);
    $temat = validate($_POST['temat']);
    $wiadomosc = validate($_POST['wiadomosc']);
    
    if(empty($imie)){
        $imieerr = 'Nie podano imienia';
        $errNum++;
    }else{
        if(!preg_match($polishRegex, $imie)){
            $imieerr = 'Dozwolone tylko polskie znaki';
            $errNum++;
        }
    }    
    if(empty($nazwisko)){
        $nazwiskoerr = 'Nie podano nazwiska';
        $errNum++;
    }else{
        if(!preg_match($polishRegex, $nazwisko)){
            $nazwiskoerr = 'Dozwolone tylko polskie znaki';
            $errNum++;
        }
    }    
    if(empty($email)){
        $emailerr = 'Nie podano emailu zwrotnego';
        $errNum++;
    }else{
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $iemailerr = 'Błędny email';
            $errNum++;
        }
    }    
    if(empty($temat)){
        $tematerr = 'Nie podano tematu';
        $errNum++;
    }else if(strlen($temat)<5){
            $tematerr = 'Temat musi mieć przynajmniej 5 znaków';
            $errNum++;
    }    
    if(empty($wiadomosc)){
        $wiadomoscerr = 'Wiadomość jest pusta';
        $errNum++;
    }
}


if($errNum==0 && isset($_POST['send'])){
    $wiadomosc = $wiadomosc.'<br>'.$imie.' '.$nazwisko.'<br>'.$email;
    $to='zamowienia@pseudosklep.com';
    mail($to, $temat, $wiadomosc);
    header('Location: index.php?page=kontkatpodziekowanie');
}
?>

<?=template_header('Kontakt')?>
<br>
TO DO: zrobić dobrze działające pole tekstowe wiadmości oraz enter nie wysyła formy
<br>
<div class="kontakt content-wrapper">
    <form method="post" action="index.php?page=kontakt" class="daneosobowe">
        <div>
            <h1>
                Skontaktuj się z naszym zespołem.
            </h1>
        </div>
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
            <label>Email zwrotny: </label>
            <input type="text" name="email" value="<?=$email ?>">
            <span class="error">*<?=$emailerr ?></span>
        </div>
        <div>
            <label>Temat: </label>
            <input type="text" name="temat" value="<?=$temat ?>">
            <span class="error">*<?=$tematerr ?></span>
        </div>
        <div>
            <label>Wiadomość:<span class="error">*<?=$wiadomoscerr ?></span><br></label>
            <input type="text" name="wiadomosc" value="<?=$wiadomosc ?>">
            
        </div>
        <div>
            <button type="submit" name="send">Wyślij</button>
        </div>
    </form>
</div>

<?=template_footer()?>