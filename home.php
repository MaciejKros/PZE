<?php
$komunikat = '';

if(isset($_GET['kom'])){
    if($_GET['kom']==1){
        $komunikat = 'Wylogowano pomyślnie!';
    } else if($_GET['kom']==2){
        $komunikat = 'Rejestracja zakończona pomyślnie!';
    }
}

$polecenie = $pdo->prepare('SELECT * FROM produkty ORDER BY data DESC LIMIT 4');
$polecenie->execute();
$produkty = $polecenie->fetchAll(PDO::FETCH_ASSOC);
?>

<?=template_header('Softronic Shop')?>

<div class="featured">
    <h2>SOFTRONIC SHOP</h2>
</div>

<div class="communique">
    <?=$komunikat; ?>
</div>

<div class="recentlyadded content-wrapper">
    <h1>O firmie</h1>
	<div class="news">
	Od początku swojej działalności zajmujemy się dostarczaniem rozwiązań informatycznych dla biznesu. Nasza siedziba znajduje się w Warszawie. Dostarczamy sprawdzone oprogramownie od zaufanych dostawców. Opracowujemy również oprogramownie na indywidualne zamówienie naszych klientów.

	</div>
	<h1>Nowości w naszej ofercie</h1>
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