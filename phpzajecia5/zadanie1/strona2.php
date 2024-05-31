<?php
include 'session_start.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['nr_karty'] = $_POST['nr_karty'];
    $_SESSION['dane_zamawiajacego'] = $_POST['dane_zamawiajacego'];
    $_SESSION['ilosc_osob'] = $_POST['ilosc_osob'];
    $ilosc_osob = $_SESSION['ilosc_osob'];
} else {
    $ilosc_osob = $_SESSION['ilosc_osob'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Strona 2</title>
</head>
<body>
    <h1>Podaj dane osob</h1>
    <form action="strona3.php" method="post">
        <?php for ($i = 1; $i <= $ilosc_osob; $i++): ?>
            <h2>Osoba <?php echo $i; ?></h2>
            <label for="osoba_<?php echo $i; ?>_imie">Imie i nazwisko:</label>
            <input type="text" id="osoba_<?php echo $i; ?>_imie" name="osoby[<?php echo $i; ?>][imie]" required><br>
            
            <label for="osoba_<?php echo $i; ?>_wiek">Wiek:</label>
            <input type="number" id="osoba_<?php echo $i; ?>_wiek" name="osoby[<?php echo $i; ?>][wiek]" required><br>
        <?php endfor; ?>
        
        <input type="submit" value="Zapisz i przejdz dalej">
    </form>
</body>
</html>
