<?php
$polecenie = $pdo->prepare('SELECT * FROM kategorie');
$polecenie->execute();
$kategorie = $polecenie->fetchAll(PDO::FETCH_ASSOC);
//wyciągamy z bazy najwyższy indeks produktów, by przy edycji bądź dodawaniu produktu do zamówienia nie można było wybrać nieistniejących produktów
$polecenie = $pdo->prepare('SELECT MAX(id) FROM produkty');
$polecenie->execute();
$max_id = $polecenie->fetch(PDO::FETCH_ASSOC);
$max_id = array_pop($max_id);

//dodawanie kategorii
if(isset($_POST['add'])){
    $polecenie = $pdo->prepare('INSERT INTO `kategorie`(nazwa) VALUES (?)');
    $input=array($_POST['nazwa']);
    $polecenie->execute($input);
    unset($_POST);
    header('location: index.php?page=kategorie');
    exit;
}
//edycja kategorii
if(isset($_POST['update']) && is_numeric($_POST['update'])){
    $polecenie = $pdo->prepare('UPDATE `kategorie` SET `nazwa`=? WHERE id=? ');
    $input=array($_POST['nazwa'], $_POST['update']);
    $polecenie->execute($input);
    unset($_POST);
    header('location: index.php?page=kategorie');
    exit;
}
//usunięcie kategorii
if(isset($_GET['remove']) && is_numeric($_GET['remove'])){
    $polecenie = $pdo->prepare('DELETE FROM `kategorie` WHERE id=? ');
    $polecenie->execute([$_GET['remove']]);
    $polecenie = $pdo->prepare('UPDATE `kategorie` SET `id`=id-1 where `id`>?');
    $polecenie->execute([$_GET['remove']]);
    $polecenie = $pdo->prepare('ALTER TABLE `kategorie` AUTO_INCREMENT=0 ');
    $polecenie->execute();
    header('location: index.php?page=kategorie');
    exit;
}
//dodanie produktu do kategorii
if(isset($_POST['add_prod']) && isset($_POST['kat_id']) && is_numeric($_POST['kat_id'])){
    //sprawdzamy czy produkt już istnieje w tej kategorii i jeżeli nie to dodajemy produkt
    $polecenie = $pdo->prepare('SELECT count(*) FROM kategorie_produkty WHERE prod_id=? and kat_id=? ');
    $input=array($_POST['prod_id'], $_POST['kat_id']);
    $polecenie->execute($input);
    $znalezione = $polecenie->fetchColumn();
    if($znalezione==0){
        $polecenie = $pdo->prepare('INSERT INTO `kategorie_produkty`(kat_id, prod_id) VALUES (?,?)');
        $input=array($_POST['kat_id'], $_POST['prod_id']);
        $polecenie->execute($input);
    }
    unset($_POST);
    header('location: index.php?page=kategorie');
    exit;
}
//edycja produktu w kategorii
if(isset($_POST['update_prod']) && is_numeric($_POST['update_prod']) && isset($_POST['kat_id']) && is_numeric($_POST['kat_id'])){
    //sprawdzamy czy produkt na który ma być zmiana już istnieje w tej kategorii i jeżeli nie to zmieniamy produkt
    $polecenie = $pdo->prepare('SELECT count(*) FROM kategorie_produkty WHERE prod_id=? and kat_id=? ');
    $input=array($_POST['prod_id'], $_POST['kat_id']);
    $polecenie->execute($input);
    $znalezione = $polecenie->fetchColumn();
    if($znalezione==0){
        $polecenie = $pdo->prepare('UPDATE `kategorie_produkty` SET prod_id=? WHERE prod_id=? AND kat_id=?');
        $input=array($_POST['prod_id'], $_POST['update_prod'], $_POST['kat_id']);
        $polecenie->execute($input);
    } 
    unset($_POST);
    header('location: index.php?page=kategorie');
    exit;
}
//usunięcie produktu z kategorii
if(isset($_GET['remove_prod']) && is_numeric($_GET['remove_prod']) && isset($_GET['kat_id']) && is_numeric($_GET['kat_id'])){
    $polecenie = $pdo->prepare('DELETE FROM `kategorie_produkty` WHERE prod_id=? AND kat_id=? ');
    $input = array($_GET['remove_prod'], $_GET['kat_id']);
    $polecenie->execute($input);
    header('location: index.php?page=kategorie');
    exit;
}
?>

<?=template_header_adm('Panel administracyjny')?>
<div class='content-wrapper kategorie'>
    <table>
            <tr class='naglowek_tabeli'>
                <th>Id</th>
                <th>Nazwa</th>
                <th class="zaktualizuj"></th>
                <th class="usun"></th>
            </tr>
    </table>
    <?php foreach($kategorie as $kategoria): ?>
    <table>
            <tr>
                <form method="post" action="index.php?page=kategorie">
                <td><?=$kategoria['id'] ?></td>
                <td><input type="text" name="nazwa" value="<?=$kategoria['nazwa'] ?>"></td>
                <td><button type="submit" name="update" value="<?=$kategoria['id'] ?>">Zaktualizuj</button></td>
                </form>
                <td><a class="button" href="index.php?page=kategorie&remove=<?=$kategoria['id'] ?>">Usuń</a></td>
            </tr>
    </table>
    <table class='produkty'>
        <tr class='naglowek_tabeli'>
            <th>Id</th>
            <th>Nazwa</th>
            <th class="zaktualizuj"></th>
            <th class="usun"></th>
        </tr>
        <?php 
        $polecenie = $pdo->prepare('SELECT * FROM kategorie_produkty WHERE kat_id=?');
        $polecenie->execute([$kategoria['id']]);
        $produkty = $polecenie->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <?php foreach($produkty as $produkt):?>
            <?php 
            $polecenie = $pdo->prepare('SELECT * FROM produkty WHERE id=?');
            $polecenie->execute([$produkt['prod_id']]);
            $reszta_produktow = $polecenie->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php foreach($reszta_produktow as $reszta_produktu): ?>
            <tr>
                <form method="post" action="index.php?page=kategorie">
                <input type="hidden" name="kat_id" value="<?= $kategoria['id']?>">
                <td><input type="number" name="prod_id" min="1" max="<?=$max_id ?>" value="<?= $produkt['prod_id']?>"></td>
                <td><?= $reszta_produktu['nazwa']?></td>
                <td class="zaktualizuj"><button type="submit" name="update_prod" value="<?=$produkt['prod_id'] ?>">Zaktualizuj</button></td>
                </form>
                <td class="usun"><a class="button" href="index.php?page=kategorie&remove_prod=<?=$produkt['prod_id'] ?>&kat_id=<?= $kategoria['id'] ?>">Usuń</a></td>
            </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
            <tr>
                <form method="post" action="index.php?page=kategorie">
                <input type="hidden" name="kat_id" value="<?= $kategoria['id']?>">
                <td><input type="number" name="prod_id" max="<?=$max_id ?>" min="1"></td>
                <td></td>
                <td><button type="submit" name="add_prod">Dodaj</button></td>
                </form>
                <td></td>
            </tr>
    </table>
    <?php endforeach; ?>
    <table>
            <tr>
                <form method="post" action="index.php?page=kategorie">
                <td></td>
                <td><input type="text" name="nazwa" value="" required></td>
                <td><button type="submit" name="add">Dodaj</button></td>
                </form>
                <td></td>
            </tr>
    </table>
</div>  
<?=template_footer()?>