<?php
$polecenie = $pdo->prepare('SELECT * FROM produkty WHERE staracena IS NOT NULL ');
$polecenie->execute();
$produkty = $polecenie->fetchAll(PDO::FETCH_ASSOC);
?>

<?=template_header('Promocje')?>
<div class="recentlyadded content-wrapper">
    <h1>Promocje</h1>
	<h2>Poniższe promocje ważne są do 2021-05-20 lub do wyczerpania zapasów</h2><br>
    <div class="products">
		<?php foreach ($produkty as $produkt): ?>
        <a href="index.php?page=produkt&id=<?=$produkt['id']?>" class="product">
            <img src="imgs/<?=isset($produkt['img'])&&!empty($produkt['img']) ? $produkt['img']:'default.jpg'?>" width="200" height="200" alt="<?=$produkt['nazwa']?>">
            <span class="name"><?=$produkt['nazwa']?></span>
            <span class="price"><del><?=$produkt['staracena'] ?></del> <?=$produkt['cena']?>&#122;&#322;</span>
        </a>
        <?php endforeach; ?>
    </div>
</div>

<?=template_footer()?>