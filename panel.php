<?php
$polecenie = $pdo->prepare('SELECT * FROM produkty');
$polecenie->execute();
$produkty = $polecenie->fetchAll(PDO::FETCH_ASSOC);

//dodawanie produktów do bazy
if(isset($_POST['add'])){
    if(isset($_FILES['img'])){
        $filename = $_FILES['img']['name'];
        $filetmp =$_FILES['img']['tmp_name'];
        move_uploaded_file($filetmp,"imgs/".$filename);
    } else 
        $filename = '';
    $polecenie = $pdo->prepare('INSERT INTO `produkty`(`nazwa`, `cena`, `opis`, `img`) VALUES (?,?,?,?)');
    $input=array($_POST['nazwa'], $_POST['cena'], $_POST['opis'], $filename);
    $polecenie->execute($input);
    unset($_POST);
    unset($_FILES);
    header('location: index.php?page=panel');
    exit;
}
//zapisywanie edycji do bazy
if(isset($_POST['update']) && is_numeric($_POST['update'])){
    $polecenie = $pdo->prepare('UPDATE `produkty` SET `nazwa`=?,`cena`=?,`opis`=?,`img`=? WHERE id=? ');
    $input=array($_POST['nazwa'], $_POST['cena'], $_POST['opis'], $_POST['img'], $_POST['update']);
    $polecenie->execute($input);
    unset($_POST);
    header('location: index.php?page=panel');
    exit;
}
//usuwanie elementu z bazy
if(isset($_GET['remove']) && is_numeric($_GET['remove'])){
    $polecenie = $pdo->prepare('DELETE FROM `produkty` WHERE id=? ');
    $polecenie->execute([$_GET['remove']]);
    $polecenie = $pdo->prepare('UPDATE `produkty` SET `id`=id-1 where `id`>?');
    $polecenie->execute([$_GET['remove']]);
    $polecenie = $pdo->prepare('ALTER TABLE `produkty` AUTO_INCREMENT=0 ');
    $polecenie->execute();
    header('location: index.php?page=panel');
    exit;
}

?>

<?=template_header_adm('Panel administracyjny')?>
<div class='content-wrapper panel'>
    <table>
        <thead>
            <tr>
                <td>Id</td>
                <td>Nazwa</td>
                <td>Cena</td>
                <td>Opis</td>
                <td>Img</td>
                <td>Data dodania</td>
                <td class="zaktualizuj"></td>
                <td class="usun"></td>
            </tr>
        </thead>
        <tbody>
    <?php foreach($produkty as $produkt): ?>
            <tr>
                <form method="post" action="index.php?page=panel">
                <td><?=$produkt['id'] ?></td>
                <td><input type="text" name="nazwa" value="<?=$produkt['nazwa'] ?>"></td>
                <td><input type="number" name="cena" value="<?=$produkt['cena'] ?>" placeholder="<?=$produkt['cena'] ?>" step="0.01"></td>
                <td><input type="text" name="opis" value="<?=$produkt['opis'] ?>"></td>
                <td><input type="text" name="img" value="<?=$produkt['img'] ?>"></td>
                <td><?=$produkt['data'] ?></td>
                <td><button type="submit" name="update" value="<?=$produkt['id'] ?>">Zaktualizuj</button></td>
                </form>
                <td><a class="button" href="index.php?page=panel&remove=<?=$produkt['id'] ?>">Usuń</a></td>
            </tr>
    <?php endforeach; ?>
            <tr>
            <form method="post" action="index.php?page=panel" enctype="multipart/form-data">
                <td></td>
                <td><input type="text" name="nazwa" required></td>
                <td><input type="number" name="cena" step="0.01" required></td>
                <td><input type="text" name="opis" ></td>
                <td><input type="file" name="img" ></td>
                <td></td>
                <td><button type="submit" name="add">Dodaj</button></td>
                </form>
                <td></td>
            </tr>        
        </tbody>
    </table>
</div>
<?=template_footer()?>