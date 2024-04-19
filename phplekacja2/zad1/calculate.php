<?php
if(isset($_POST['submit'])){
    $cyfra1 = $_POST['cyfra1'];
    $cyfra2 = $_POST['cyfra2'];
    $silnik = $_POST['silnik'];

    switch($silnik){
        case 'plusowanie':
            $result = $cyfra1 + $cyfra2;
            break;
        case 'minusowanie':
            $result = $cyfra1 - $cyfra2;
            break;
        case 'kropokowanie':
            $result = $cyfra1 * $cyfra2;
            break;
        case 'dwukropkowanie':
            if($cyfra2 != 0){
                $result = $cyfra1 / $cyfra2;
            } else {
                $result = "Nie można dzielić przez zero!";
            }
            break;
        default:
            $result = "Wybierz działanie";
    }

    echo "Wynik: $result";
}
?>
