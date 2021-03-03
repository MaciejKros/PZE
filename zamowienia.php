<?php
$polecenie = $pdo->prepare('SELECT * FROM zamowienia');
$polecenie->execute();
$zamowienia = $polecenie->fetchAll(PDO::FETCH_ASSOC);
//wyciągamy z bazy najwyższy indeks produktów, by przy edycji bądź dodawaniu produktu do zamówienia nie można było wybrać nieistniejących produktów
$polecenie = $pdo->prepare('SELECT MAX(id) FROM produkty');
$polecenie->execute();
$max_id = $polecenie->fetch(PDO::FETCH_ASSOC);
$max_id = array_pop($max_id);
//dodawanie zamówienia
if(isset($_POST['add'])){
    $polecenie = $pdo->prepare('INSERT INTO `zamowienia`(login, `imie`, `nazwisko`, city, `adres`, zip, `email`, `telefon`, status) VALUES (?,?,?,?,?,?,?,?,?)');
    $input=array($_POST['login'], $_POST['imie'], $_POST['nazwisko'], $_POST['city'], $_POST['adres'], $_POST['zip'], $_POST['email'], $_POST['telefon'], $_POST['status']);
    $polecenie->execute($input);
    unset($_POST);
    header('location: index.php?page=zamowienia');
    exit;
}
//edycja zamówienia
if(isset($_POST['update']) && is_numeric($_POST['update'])){
    $polecenie = $pdo->prepare('UPDATE `zamowienia` SET login=?, `imie`=?,`nazwisko`=?, city=?, `adres`=?, zip=?, `email`=?,`telefon`=?, status=? WHERE id=? ');
    $input=array($_POST['login'], $_POST['imie'], $_POST['nazwisko'], $_POST['city'], $_POST['adres'], $_POST['zip'], $_POST['email'], $_POST['telefon'], $_POST['status'], $_POST['update']);
    $polecenie->execute($input);
    unset($_POST);
    header('location: index.php?page=zamowienia');
    exit;
}
//usunięcie zamówienia
if(isset($_GET['remove']) && is_numeric($_GET['remove'])){
    $polecenie = $pdo->prepare('DELETE FROM `zamowienia` WHERE id=? ');
    $polecenie->execute([$_GET['remove']]);
    $polecenie = $pdo->prepare('UPDATE `zamowienia` SET `id`=id-1 where `id`>?');
    $polecenie->execute([$_GET['remove']]);
    $polecenie = $pdo->prepare('ALTER TABLE `zamowienia` AUTO_INCREMENT=0 ');
    $polecenie->execute();
    header('location: index.php?page=zamowienia');
    exit;
}
//dodanie produktu do zamówienia
if(isset($_POST['add_prod']) && isset($_POST['zam_id']) && is_numeric($_POST['zam_id']) && isset($_POST['prod_id']) && is_numeric($_POST['prod_id'])){
    //sprawdzamy czy produkt już istnieje w tym zamówieniu i jeżeli nie to dodajemy produkt
    $polecenie = $pdo->prepare('SELECT count(*) FROM zamowienia_produkty WHERE prod_id=? and zam_id=? ');
    $input=array($_POST['prod_id'], $_POST['zam_id']);
    $polecenie->execute($input);
    $znalezione = $polecenie->fetchColumn();
    if($znalezione==0){
        $polecenie = $pdo->prepare('INSERT INTO `zamowienia_produkty`(zam_id, prod_id, ilosc_prod) VALUES (?,?,?)');
        $input=array($_POST['zam_id'], $_POST['prod_id'], $_POST['ilosc_prod']);
        $polecenie->execute($input);
    }
    unset($_POST);
    header('location: index.php?page=zamowienia');
    exit;
}
//edycja produktu w zamówieniu
if(isset($_POST['update_prod']) && is_numeric($_POST['update_prod']) && isset($_POST['zam_id']) && is_numeric($_POST['zam_id']) && isset($_POST['prod_id']) && is_numeric($_POST['prod_id'])){
    //sprawdzamy czy produkt na który ma być zmiana już istnieje w tym zamówieniu i jeżeli nie to zmieniamy produkt, a jeżeli istnieje to zmieniamy jego ilosc
    $polecenie = $pdo->prepare('SELECT * FROM zamowienia_produkty WHERE prod_id=? and zam_id=? ');
    $input=array($_POST['prod_id'], $_POST['zam_id']);
    $polecenie->execute($input);
    $znalezione = $polecenie->fetchAll();
    if(count($znalezione)==0 || ((count($znalezione)==1) && ($_POST['update_prod'] == $_POST['prod_id']) && ($znalezione['ilosc_prod']) != $_POST['ilosc_prod'])){
    $polecenie = $pdo->prepare('UPDATE `zamowienia_produkty` SET prod_id=?, ilosc_prod=? WHERE prod_id=? AND zam_id=?');
    $input=array($_POST['prod_id'], $_POST['ilosc_prod'], $_POST['update_prod'], $_POST['zam_id']);
    $polecenie->execute($input);
    }
    unset($_POST);
    header('location: index.php?page=zamowienia');
    exit;
}
//usunięcie produktu z zamówienia
if(isset($_GET['remove_prod']) && is_numeric($_GET['remove_prod']) && isset($_GET['zam_id']) && is_numeric($_GET['zam_id'])){
    $polecenie = $pdo->prepare('DELETE FROM `zamowienia_produkty` WHERE prod_id=? AND zam_id=? ');
    $input = array($_GET['remove_prod'], $_GET['zam_id']);
    $polecenie->execute($input);
    header('location: index.php?page=zamowienia');
    exit;
}
?>

<?=template_header_adm('Panel administracyjny')?>
<div class='zamowienia' style="margin: 0 100px">
    <table>
            <tr class='naglowek_tabeli'>
                <th>Id</th>
                <th>Login</th>
                <th>Imie</th>
                <th>Nazwisko</th>
                <th>Miasto</th>
                <th>Adres</th>
                <th>ZIP</th>
                <th>Email</th>
                <th>Telefon</th>
                <th>Status</th>
                <th>Data złożenia zamówienia</th>
                <th class="zaktualizuj"></th>
                <th class="usun"></th>
            </tr>
    </table>
    <?php foreach($zamowienia as $zamowienie): ?>
    <table>
            <tr>
                <form method="post" action="index.php?page=zamowienia">
                <td><?=$zamowienie['id'] ?></td>
                <td><input type="text" name="login" value="<?=$zamowienie['login'] ?>"></td>
                <td><input type="text" name="imie" value="<?=$zamowienie['imie'] ?>"></td>
                <td><input type="text" name="nazwisko" value="<?=$zamowienie['nazwisko'] ?>"></td>
                <td><input type="text" name="city" value="<?=$zamowienie['city'] ?>"></td>
                <td><input type="text" name="adres" value="<?=$zamowienie['adres'] ?>"></td>
                <td><input type="text" name="zip" value="<?=$zamowienie['zip'] ?>"></td>
                <td><input type="email" name="email" value="<?=$zamowienie['email'] ?>"></td>
                <td><input type="number" name="telefon" value="<?=$zamowienie['telefon'] ?>"></td>
                <td>
                    <select name="status" id="status">
                        <option value="pending" <?=status_zam($zamowienie['status'], 'pending') ?>>W trakcie realizacji</option>
                        <option value="sent" <?=status_zam($zamowienie['status'], 'sent') ?>>Wysłane</option>
                        <option value="done" <?=status_zam($zamowienie['status'], 'done') ?>>Zakończone</option>
                    </select>       
                </td>
                <td><?=$zamowienie['data'] ?></td>
                <td><button type="submit" name="update" value="<?=$zamowienie['id'] ?>">Zaktualizuj</button></td>
                </form>
                <td><a class="button" href="index.php?page=zamowienia&remove=<?=$zamowienie['id'] ?>">Usuń</a></td>
            </tr>
    </table>
    <table class='produkty'>
        <tr class='naglowek_tabeli'>
            <th>Id</th>
            <th>Nazwa</th>
            <th>Cena</th>
            <th>Stara cena</th>
            <th>Ilość</th>
            <th>W sumie</th>
            <th class="zaktualizuj"></th>
            <th class="usun"></th>
        </tr>
        <?php 
        $polecenie = $pdo->prepare('SELECT * FROM zamowienia_produkty WHERE zam_id=?');
        $polecenie->execute([$zamowienie['id']]);
        $produkty = $polecenie->fetchAll(PDO::FETCH_ASSOC);
        $wSumie = 0;
        ?>
        <?php foreach($produkty as $produkt):?>
            <?php 
            $polecenie = $pdo->prepare('SELECT * FROM produkty WHERE id=?');
            $polecenie->execute([$produkt['prod_id']]);
            $reszta_produktow = $polecenie->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php foreach($reszta_produktow as $reszta_produktu): ?>
            <tr>
                <form method="post" action="index.php?page=zamowienia">
                <input type="hidden" name="zam_id" value="<?= $zamowienie['id']?>">
                <td><input type="number" name="prod_id" min="1" max="<?=$max_id ?>" value="<?= $produkt['prod_id']?>"></td>
                <td><?= $reszta_produktu['nazwa']?></td>
                <td><?= $reszta_produktu['cena']?></td>
                <td><?= $reszta_produktu['staracena']?></td>
                <td><input type="number" name="ilosc_prod" min="1" value="<?= $produkt['ilosc_prod']?>"></td>
                <td><?php echo $produkt['ilosc_prod']*$reszta_produktu['cena'];
                $wSumie += $produkt['ilosc_prod']*$reszta_produktu['cena'];?>&#122;&#322;</td>
                <td><button type="submit" name="update_prod" value="<?=$produkt['prod_id'] ?>">Zaktualizuj</button></td>
                </form>
                <td><a class="button" href="index.php?page=zamowienia&remove_prod=<?=$produkt['prod_id'] ?>&zam_id=<?= $zamowienie['id'] ?>">Usuń</a></td>
            </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
            <tr>
                <form method="post" action="index.php?page=zamowienia">
                <input type="hidden" name="zam_id" value="<?= $zamowienie['id']?>">
                <td><input type="number" name="prod_id" max="<?=$max_id ?>" min="1"></td>
                <td></td>
                <td></td>
                <td></td>
                <td><input type="number" name="ilosc_prod" min="1"></td>
                <td></td>
                <td><button type="submit" name="add_prod">Dodaj</button></td>
                </form>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Razem:</td>
                <td><?= $wSumie; ?>&#122;&#322;</td>
                <td></td>
                <td></td>
            </tr>
    </table>
    <?php endforeach; ?>
    <table>
            <tr>
                <form method="post" action="index.php?page=zamowienia">
                <td></td>
                <td><input type="text" name="login" value=""></td>
                <td><input type="text" name="imie" value=""></td>
                <td><input type="text" name="nazwisko" value=""></td>
                <td><input type="text" name="city" value=""></td>
                <td><input type="text" name="adres" value=""></td>
                <td><input type="text" name="zip" value=""></td>
                <td><input type="text" name="email" value=""></td>
                <td><input type="number" name="telefon" value=""></td>
                <td>
                    <select name="status" id="status">
                        <option value="pending">W trakcie realizacji</option>
                        <option value="sent">Wysłane</option>
                        <option value="done">Zakończone</option>
                    </select>       
                </td>
                <td></td>
                <td><button type="submit" name="add">Dodaj</button></td>
                </form>
                <td></td>
            </tr>
    </table>
</div>    
<?=template_footer()?>