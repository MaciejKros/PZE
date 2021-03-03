<?php
if(isset($_GET['kat_id']) && is_numeric($_GET['kat_id'])){
    $kat_id = $_GET['kat_id'];
    $polecenie = $pdo->prepare('SELECT * FROM kategorie_produkty WHERE kat_id=?');
    $polecenie->execute([$kat_id]);
    $kategoria_produkty = $polecenie->fetchAll(PDO::FETCH_ASSOC);
    $polecenie = $pdo->prepare('SELECT nazwa FROM kategorie WHERE id=?');
    $polecenie->execute([$kat_id]);
    $kategoria = $polecenie->fetch(PDO::FETCH_ASSOC);
} else {
    header('location: index.php');
    exit;
}
?>

<?=template_header($kategoria['nazwa'])?>
<div class="recentlyadded content-wrapper">
    <h2><?= $kategoria['nazwa'] ?>:</h2>
    <div class="products">
        <?php foreach ($kategoria_produkty as $kp): ?>
        <?php 
            $polecenie = $pdo->prepare('SELECT * FROM produkty where id = ?');
            $polecenie->execute([$kp['prod_id']]);
            $produkt = $polecenie->fetch(PDO::FETCH_ASSOC);
        ?>
        <a href="index.php?page=produkt&id=<?=$produkt['id']?>" class="product">
            <img src="imgs/<?=isset($produkt['img'])&&!empty($produkt['img']) ? $produkt['img']:'default.jpg'?>" width="200" height="200" alt="<?=$produkt['nazwa']?>">
            <span class="name"><?=$produkt['nazwa']?></span>
            <span class="price"><del><?=$produkt['staracena'] ?></del> <?=$produkt['cena']?>&#122;&#322;</span>
        </a>
        <?php endforeach; ?>
    </div>
</div>

<?=template_footer()?>