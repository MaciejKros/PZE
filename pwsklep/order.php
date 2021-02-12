<?php

require('header.php');
?>




<h1>Podaj dane do wysyłki</h1>
<form action='ordersummary.php' method='post'>
Imię i nazwisko<br><input type='text' name='customer'><br>
E-mail: <br><input type='text' name='email'><br>
Adres: <br><textarea name='address'>
</textarea><br>
<input type='submit' value='zamawiam!'>
</form>
<?php
require('footer.php');
?>