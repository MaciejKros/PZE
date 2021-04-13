<?php
$search = validate($_POST['search']);
if(isset($search) && !empty($search)){
    $polecenie = $pdo->prepare("SELECT * FROM produkty WHERE nazwa LIKE '%".$search."%' OR opis LIKE '%".$search."%'");
    $polecenie->execute();
    $produkty = $polecenie->fetchAll();
} else {
    header('location: index.php');
    exit;
}
?>

<?=template_header('Wynik wyszukiwania')?>

<div class="recentlyadded content-wrapper">
    <h2> Wynik wyszukiwania:</h2>
    <div class="products">
        <?php if(empty($produkty)): ?>
        <h2>Przepraszamy, nie znaleźliśmy wyniku poszukiwania frazy: <?=$search ?></h2>
        <?php else: ?>
        <?php foreach ($produkty as $produkt): ?>
        <a href="index.php?page=produkt&id=<?=$produkt['id']?>" class="product">
            <img src="imgs/<?=isset($produkt['img'])&&!empty($produkt['img']) ? $produkt['img']:'default.jpg'?>" width="200" height="200" alt="<?=$produkt['nazwa']?>">
            <span class="name"><?=$produkt['nazwa']?></span>
            <span class="price"><del><?=$produkt['staracena'] ?></del> <?=$produkt['cena']?>&#122;&#322;</span>
        </a>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>

<?=template_footer()?>