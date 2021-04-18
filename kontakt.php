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
    $to='zamowienia@softronic.com';
    mail($to, $temat, $wiadomosc);
    header('Location: index.php?page=kontkatpodziekowanie');
}
?>

<?=template_header('Kontakt')?>
<div class="kontakt content-wrapper">
    <form method="post" action="index.php?page=kontakt" class="daneosobowe">
        <div>
            <h1>
                Kontakt
            </h1>
			<h2>
				Zadzwoń, napisz albo przyjedź do nas!
				Jesteśmy do dyspozycji od poniedziałku do piątku w godzinach 8:30 - 16:30.
			</h2>
				<p>
					<strong>Softronic Shop Spółka z ograniczoną odpowiedzialnością</strong><br>
					Aleje Jerozolimskie 135<br>
					02-495 Warszawa
				</p>
				
				<p>
	
				</p>
				<p>
					tel.&nbsp;
					<a href="tel.+48 22 234 74 15">+48 22 234 74 15</a>
					<br>
					kom.
					<a href="tel.+48 604 164 645">+48 604 164 645</a>
					</p>
				<p>
					Dział Handlowy: 
					<a href="mailto:biuro@softronic.pl">
					biuro@softronic.pl
					</a><br>
					Dział Techniczny: 
					<a href="mailto:biuro@softronic.pl">
					biuro@softronic.pl
					</a>
					
				</p>
				
        </div>
		<div>
			<h1>Formularz kontaktowy</h1>
		</div>
		<div>
            <label>Imie</label>
			<span class="error">*<?=$imieerr ?></span>
			<br>
            <input type="text" name="imie" value="<?=$imie ?>">
            </div>
        <div>
            <label>Nazwisko</label>
            <span class="error">*<?=$nazwiskoerr ?></span>
			<br>
            <input type="text" name="nazwisko" value="<?=$nazwisko ?>">
        </div>
        <div>
            <label>Email zwrotny</label>
            <span class="error">*<?=$emailerr ?></span>
			<br>
            <input type="text" name="email" value="<?=$email ?>">
        </div>
        <div>
            <label>Temat</label>
            <span class="error">*<?=$tematerr ?></span>
			<br>
            <input type="text" name="temat" value="<?=$temat ?>">
        </div>
        <div>
            <label>Wiadomość:<span class="error">*<?=$wiadomoscerr ?></span><br></label>
            <textarea name="wiadomosc" rows="8" cols="80"></textarea>
            
        </div>
        <div>
            <button type="submit" name="send">Wyślij</button>
        </div>
    </form>
</div>

<?=template_footer()?>