<!DOCTYPE html>
<html>
<head>
    <title>Wyniki obslugi katalogow</title>
</head>
<body>
    <h2>Wyniki obslugi katalogow</h2>
    <?php
    include 'funkcje.php';

    if(isset($_POST['submit'])){
        $sciezka = $_POST['sciezka'];
        $nazwa_katalogu = $_POST['nazwa_katalogu'];
        $operacja = $_POST['operacja'];

        $komunikat = katalogi($sciezka, $nazwa_katalogu, $operacja);
        echo $komunikat;
    }
    ?>
</body>
</html>
