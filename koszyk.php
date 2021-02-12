<?php
//dodawanie produktu do koszyka
if (isset($_POST['produkt_id'], $_POST['ilosc']) && is_numeric($_POST['produkt_id']) && is_numeric($_POST['ilosc'])) {
    $produkt_id = (int)$_POST['produkt_id'];
    $ilosc = (int)$_POST['ilosc'];
    $polecenie = $pdo->prepare('SELECT * FROM produkty WHERE id = ?');
    $polecenie->execute([$_POST['produkt_id']]);
    $produkt = $polecenie->fetch(PDO::FETCH_ASSOC);
    
    if ($produkt && $ilosc > 0) {
        if (isset($_SESSION['koszyk']) && is_array($_SESSION['koszyk'])) {
            if (array_key_exists($produkt_id, $_SESSION['koszyk'])) {
                $_SESSION['koszyk'][$produkt_id] += $ilosc;
            } else {
                $_SESSION['koszyk'][$produkt_id] = $ilosc;
            }
        } else {
            $_SESSION['koszyk'] = array($produkt_id => $ilosc);
        }
    }
    header('location: index.php?page=koszyk');
    exit;
}

// usuwanie produktu z koszyka jeżeli produkt w koszyku istnieje
if (isset($_GET['usun']) && is_numeric($_GET['usun']) && isset($_SESSION['koszyk']) && isset($_SESSION['koszyk'][$_GET['usun']])) {
    unset($_SESSION['koszyk'][$_GET['usun']]);
}

// odświeżanie zawartości koszyka
if (isset($_POST['update']) && isset($_SESSION['koszyk'])) {
    foreach ($_POST as $k => $v) {
        //sprawdzawmy czy w $_POST znajdują się właśiwe dane
        if (strpos($k, 'ilosc') !== false && is_numeric($v)) {
            $id = str_replace('ilosc-', '', $k);
            $ilosc = (int)$v;
            // sprawdzamy czy to jest ten produkt do poprawy w koszyku
            if (is_numeric($id) && isset($_SESSION['koszyk'][$id]) && $ilosc > 0) {
                $_SESSION['koszyk'][$id] = $ilosc;
            }
        }
    }
    header('location: index.php?page=koszyk');
    exit;
}

// $liczba_w_koszyku zawiera tablicę z id produktów w koszyku jeżeli koszyk istnieje
$liczba_w_koszyku = isset($_SESSION['koszyk']) ? $_SESSION['koszyk'] : array();
$produkty = array();
$wSumie = 0.00;
// pobieranie produktów znajdujących się w koszyku z bazy danych 
if ($liczba_w_koszyku) {
    //za każdy produkt w koszyku dodajemy '?,' do $znaki_zapytania które potem są dodawane do zapytania SQL do bazy
    $znaki_zapytania = implode(',', array_fill(0, count($liczba_w_koszyku), '?'));
    $polecenie = $pdo->prepare('SELECT * FROM produkty WHERE id IN (' . $znaki_zapytania . ')');
    // każdy klucz koszyk jest id produktu i tylko to jest potrzebne w zapytaniu SQL
    $polecenie->execute(array_keys($liczba_w_koszyku));
    $produkty = $polecenie->fetchAll(PDO::FETCH_ASSOC);
    // obliczamy sumę koszyka
    foreach ($produkty as $produkt) {
        $wSumie += (float)$produkt['cena'] * (int)$liczba_w_koszyku[$produkt['id']];
    }
}

if (isset($_POST['zam']) && isset($_SESSION['koszyk']) && !empty($_SESSION['koszyk'])) {
    header('Location: index.php?page=zam');
    exit;
} 

?>

<?=template_header('Koszyk')?>

<div class="cart content-wrapper">
    <h1>Koszyk</h1>
    <form action="index.php?page=koszyk" method="post">
        <table>
            <thead>
                <tr>
                    <td colspan="2">Produkt</td>
                    <td>Cena</td>
                    <td>Ilość</td>
                    <td></td>
                    <td>Razem</td>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($produkty)): ?>
                <tr>
                    <td colspan="5" style="text-align:center;">Nie masz produktów w koszyku.</td>
                </tr>
                <?php else: ?>
                <?php foreach ($produkty as $produkt): ?>
                <tr>
                    <td class="img">
                        <a href="index.php?page=produkt&id=<?=$produkt['id']?>">
                            <img src="imgs/<?=isset($produkt['img'])&&!empty($produkt['img']) ? $produkt['img']:'default.jpg'?>" width="50" height="50" alt="<?=$produkt['nazwa']?>">
                        </a>
                    </td>
                    <td>
                        <a href="index.php?page=produkt&id=<?=$produkt['id']?>"><?=$produkt['nazwa']?></a>
                    </td>
                    <td class="price"><?=$produkt['cena']?>&#122;&#322;</td>
                    <td>
                        <input type="number" name="ilosc-<?=$produkt['id']?>" value="<?=$liczba_w_koszyku[$produkt['id']]?>" min="1" placeholder="Ilość" required>
                    </td>
                    <td><a href="index.php?page=koszyk&usun=<?=$produkt['id']?>" class="remove">Usuń</a></td>
                    <td class="price"><?=$produkt['cena'] * $liczba_w_koszyku[$produkt['id']]?>&#122;&#322;</td>
                </tr>
                <?php endforeach; ?>
        <?php endif; ?>
            </tbody>
        </table>
        <div class="subtotal">
            <span class="text">Razem:</span>
            <span class="price"><?=$wSumie?>&#122;&#322;</span>
        </div>
        <div class="buttons">
            <input type="submit" value="Odśwież" name="update">
            <input type="submit" value="Zamów" name="zam">
        </div>
    </form>
</div>

<?=template_footer()?>