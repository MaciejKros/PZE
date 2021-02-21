<?php
if(!(isset($_SESSION['user']) && !empty($_SESSION['user']))){
    header("location: index.php");
    exit;
}
?>
<?=template_header('Panel użytkownika')?>
<br>
<a href="index.php?usrlogout=1">Wyloguj</a> TO DO: zrobić z tego przycisk
<br><br>
TO DO: Link do edycji danych osobowych(nowa podstrona)
<br>
<br>
TO DO: Link do edycji hasła(nowa podstrona)
<br>
<br>
TO DO: Link do histori zamówień(nowa podstrona)
<br>
<br>
TO DO: Wyświetlanie aktualnych zamówień
<br>
<br>



<?=template_footer()?>