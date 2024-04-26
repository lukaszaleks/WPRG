<!DOCTYPE html>
<html>
<head>
    <title>Wyniki obliczen</title>
</head>
<body>
    <h2>Wyniki obliczen</h2>
    <?php
    if(isset($_GET['submit'])){
        $dataUrodzenia = $_GET['data'];

       
        if (!empty($dataUrodzenia) && strtotime($dataUrodzenia) !== false) {
            $dzienTygodnia = date('l', strtotime($dataUrodzenia));
            echo "Urodziles/as sie w dniu: $dzienTygodnia<br>";

            $dataAktualna = date('Y-m-d');
            $rokUrodzenia = date('Y', strtotime($dataUrodzenia));
            $aktualnyRok = date('Y', strtotime($dataAktualna));
            $wiek = $aktualnyRok - $rokUrodzenia;
            echo "Masz juz $wiek lat.<br>";

            $nastepneUrodziny = date('Y-m-d', strtotime("+$wiek years", strtotime($dataUrodzenia)));
            $dniDoUrodzin = ceil((strtotime($nastepneUrodziny) - strtotime($dataAktualna)) / (60 * 60 * 24));
            echo "Do Twoich nastepnych urodzin pozostalo $dniDoUrodzin dni.<br>";
        } else {
            echo "Wprowadz poprawna date urodzenia.";
        }
    }
    ?>
</body>
</html>
