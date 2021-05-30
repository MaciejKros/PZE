<?php

$polecenie = $pdo->prepare('SELECT * FROM zamowienia WHERE login = ? AND status = ? ORDER BY data DESC');
$polecenie->execute([$_SESSION['user'], 'done']);
$zamowienia = $polecenie->fetchAll(PDO::FETCH_ASSOC);

if(empty($zamowienia)){
    
}
?>


<?=template_header('Historia zamówień')?>

<div class="content-wrapper usrpanel zamowienia">
    <?=usrpanel_menubar(); ?>
    <?php 
    if(!empty($zamowienia)){
        echo '<h1>Historia zamówień</h1>';
    } else {
        echo '<h2>Historia zamówień jest pusta.</h2>';
    }
    ?>
    <?php foreach($zamowienia as $zamowienie): ?>
        <u><h3>Zamówienie nr <?=$zamowienie['id'] ?></h3></u>
        <strong>Status: </strong><?php 
        if($zamowienie['status'] == 'done')
            echo 'Zakończone';
        ?>
        <br>
		<br>
        <strong>Dane do przesyłki</strong>:
        <br>
        <?=$zamowienie['imie'] ?> <?=$zamowienie['nazwisko'] ?>
        <br>
        <?=$zamowienie['telefon'] ?>
        <br>
        <?=$zamowienie['zip'] ?> <?=$zamowienie['city'] ?>
        <br>
        <?=$zamowienie['adres'] ?>
        <br>
		<br>
        <strong>Data złożenia zamówienia:</strong> <?=$zamowienie['data'] ?>
        <br>
		<br>
        <table class='produkty'>
            <tr class='naglowek_tabeli'>
                <th>Id</th>
                <th>Nazwa</th>
                <th>Cena</th>
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
                    <td><?= $produkt['prod_id']?></td>
                    <td><?= $reszta_produktu['nazwa']?></td>
                    <td><?= $reszta_produktu['cena']?></td>
                    <td><?= $produkt['ilosc_prod']?></td>
                    <td><?php echo $produkt['ilosc_prod']*$reszta_produktu['cena'];
                    $wSumie += $produkt['ilosc_prod']*$reszta_produktu['cena'];?>&#122;&#322;</td>
                </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
                <tr>
                    <td colspan="4" style="text-align: right"><strong>Razem:</strong></td>
                    <td><strong><?= $wSumie; ?>&#122;&#322;</strong></td>
                   
                </tr>
        </table>
    <?php endforeach; ?>
    
    
</div>


<?=template_footer()?>