<!DOCTYPE html>
<html>
<head>
    <title>Wyniki obliczen</title>
</head>
<body>
    <h2>Wyniki obliczen</h2>
    <?php
    include 'fibonacci_functions.php'; 

    if(isset($_GET['submit'])){
        $liczba = $_GET['liczba'];

        if (!empty($liczba) && is_numeric($liczba) && $liczba >= 0) {
            $startRekurencyjna = microtime(true);
            fibonacciRekurencyjnie($liczba);
            $endRekurencyjna = microtime(true);
            $czasRekurencyjna = $endRekurencyjna - $startRekurencyjna;

            $startNierekurencyjna = microtime(true);
            fibonacciNierekurencyjnie($liczba);
            $endNierekurencyjna = microtime(true);
            $czasNierekurencyjna = $endNierekurencyjna - $startNierekurencyjna;

            if($czasRekurencyjna < $czasNierekurencyjna) {
                echo "Funkcja rekurencyjna dzialala szybciej o " . ($czasNierekurencyjna - $czasRekurencyjna) . " sekundy.";
            } else {
                echo "Funkcja nierekurencyjna dzialala szybciej o " . ($czasRekurencyjna - $czasNierekurencyjna) . " sekundy.";
            }
        } else {
            echo "Wprowadz poprawna liczbe.";
        }
    }
    ?>
</body>
</html>
