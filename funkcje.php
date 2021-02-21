<?php

function pdoConnect() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'proj3';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	die ('Nie udało się połączyć z bazą danych!');
    }
}

// Nagłówek zależny od parametru
function template_header($title) {
echo <<<EOT
    <!DOCTYPE html>
    <html>
	<head>
		<meta charset="UTF-8">
		<title>$title</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
        <header>
            <div class="content-wrapper">
                <nav>
                    <div>
                        <a href="index.php">Pseudoskelp</a>
                    </div>
                    <div class="dropdown">
                        <button class="dropbtn">Produkty</button>
                        <div class="dropdown-content">
EOT;
$pdo = pdoConnect();
$polecenie = $pdo->prepare('SELECT * FROM kategorie');
$polecenie->execute();
$kategorie = $polecenie->fetchAll(PDO::FETCH_ASSOC);
foreach($kategorie as $kategoria){
                            echo '<a href="index.php?page=produkty&kat_id='.$kategoria['id'].'">'.$kategoria['nazwa'].'</a>';
}
echo <<<EOT
                        </div>
                    </div>
                    <div>
                        <a href="index.php">Promocje</a>
                    </div>
                    <div>
                        <a href="index.php">Kontakt</a>
                    </div>
                </nav>

                <div class="link-icons">
EOT;
if(isset($_SESSION['admin']) && !empty($_SESSION['admin'])){//////admin zmienić na user
    echo <<<EOT
                    <a href="index.php?page=usrpanel"><i class="fas fa-user"></i></a>
    EOT;  
}else{   
    echo <<<EOT
                    <a href="index.php?page=usrlogin"><i class="fas fa-user"></i></a>
    EOT;  
}

echo <<<EOT
                    <a href="index.php?page=koszyk"><i class="fas fa-shopping-cart"></i></a>
                </div>
            </div>
        </header>
        <main>
EOT;
}
function template_header_adm($title){
echo <<<EOT
    <!DOCTYPE html>
    <html>
	<head>
		<meta charset="UTF-8">
		<title>$title</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
        <header>
            <div class="content-wrapper">
                <nav>
                    <a href="index.php">Pseudosklep</a>
EOT;
if(isset($_SESSION['admin']) && !empty($_SESSION['admin'])){
echo <<<EOT
                    <a href="index.php?page=panel">Edytuj produkty</a>
                    <a href="index.php?page=kategorie">Edytuj kategorie</a>
                    <a href="index.php?page=zamowienia">Edytuj zamówienia</a>
                    <a href="index.php?logout=1">Wyloguj</a>
EOT;
}
echo <<<EOT
                </nav>
            </div>
        </header>
        <main>
EOT;
}

function template_footer() {
echo <<<EOT
            </main>
            <footer>
                <div class="content-wrapper">
                    <a href="index.php?page=admlogin">Panel Administracyjny</a>
                </div>
            </footer>
        </body>
    </html>
EOT;
}

function validate($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>