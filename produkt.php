<?php
//sprawdzanie czy produkt istnieje
if (isset($_GET['id'])) {
    $polecenie = $pdo->prepare('SELECT * FROM produkty WHERE id = ?');
    $polecenie->execute([$_GET['id']]);
    $produkt = $polecenie->fetch(PDO::FETCH_ASSOC);
    if (!$produkt) {
        die ('Produkt nie istnieje!');
    }
} else {
    die ('Produkt nie istnieje!');
}
?>

<?=template_header($produkt['nazwa'])?>

<div class="product content-wrapper">
    <img src="imgs/<?=isset($produkt['img'])&&!empty($produkt['img']) ? $produkt['img']:'default.jpg'?>" width="500" height="500" alt="<?=$produkt['nazwa']?>">
    <div>
        <h1 class="name"><?=$produkt['nazwa']?></h1>
    	<span class="price">Cena netto: <del><?=$produkt['staracena'] ?></del> <?=$produkt['cena']?>&#122;&#322;</span>
		<div>
			<strong>Informacje dodatkowe:</strong>	
			<ul>
				<li>Do ceny netto należy doliczyć podatek VAT 23%.</li>
				<li>Licencje na sprzedawane programy są bezterminowe.</li>
				<li>W przypadku większych zamówień prosimy o kontakt z <a href="http://localhost/repo/index.php?page=kontakt">Działem Handlowym</a>.</li>
			</ul>
		</div>
        <form action="index.php?page=koszyk" method="post">
			<div id="addtocart">
            <input type="number" name="ilosc" value="1" min="1" placeholder="Ilość" required>
			&nbsp;
            <input type="hidden" name="produkt_id" value="<?=$produkt['id']?>">
            <input type="submit" value="Dodaj do koszyka">
			</div>
        </form>
        <div class="description" style="clear: both">
			<strong>Opis programu:</strong>
			<br>
			<br>
            <?=$produkt['opis']?>
        </div>
    </div>
</div>

<?=template_footer()?>