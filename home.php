<?php
$polecenie = $pdo->prepare('SELECT * FROM produkty ORDER BY data DESC LIMIT 4');
$polecenie->execute();
$produkty = $polecenie->fetchAll(PDO::FETCH_ASSOC);
?>

<?=template_header('Home')?>

<div class="featured">
    <h2>Pseudosklep</h2>
</div>
<div class="recentlyadded content-wrapper">
    <h2>Nowości:</h2>
    <div class="products">
        <?php foreach ($produkty as $produkt): ?>
        <a href="index.php?page=produkt&id=<?=$produkt['id']?>" class="product">
            <img src="imgs/<?=isset($produkt['img'])&&!empty($produkt['img']) ? $produkt['img']:'default.jpg'?>" width="200" height="200" alt="<?=$produkt['nazwa']?>">
            <span class="name"><?=$produkt['nazwa']?></span>
            <span class="price"><?=$produkt['cena']?>&#122;&#322;</span>
        </a>
        <?php endforeach; ?>
    </div>
</div>

<?=template_footer()?>