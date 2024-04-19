<!DOCTYPE html>
<html>
<head>
    <title>Wynik sprawdzania liczby pierwszej</title>
</head>
<body>
    <h2>Wynik sprawdzania liczby pierwszej</h2>
    <?php
    if(isset($_POST['submit'])){
        $liczba = $_POST['liczba'];

        // Sprawdź czy liczba jest liczbą całkowitą dodatnią
        if(!filter_var($liczba, FILTER_VALIDATE_INT) || $liczba <= 1){
            echo "Wprowadź liczbę całkowitą dodatnią większą od 1.";
        } else {
            $czyPierwsza = czyLiczbaPierwsza($liczba);
            if($czyPierwsza){
                echo "$liczba jest liczbą pierwszą.";
            } else {
                echo "$liczba nie jest liczbą pierwszą.";
            }
        }
    }

    function czyLiczbaPierwsza($liczba){
        if($liczba == 2){
            return true;
        }
        if($liczba % 2 == 0){
            return false;
        }
        $pierwiastek = sqrt($liczba);
        for($i = 3; $i <= $pierwiastek; $i += 2){
            if($liczba % $i == 0){
                return false;
            }
        }
        return true;
    }
    ?>
</body>
</html>
