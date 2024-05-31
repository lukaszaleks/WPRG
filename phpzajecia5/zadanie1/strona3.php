<?php
include 'session_start.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['osoby'] = $_POST['osoby'];
}

$nr_karty = $_SESSION['nr_karty'];
$dane_zamawiajacego = $_SESSION['dane_zamawiajacego'];
$ilosc_osob = $_SESSION['ilosc_osob'];
$osoby = $_SESSION['osoby'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Strona 3</title>
</head>
<body>
    <h1>Podsumowanie</h1>
    <p><strong>Nr karty:</strong> <?php echo htmlspecialchars($nr_karty); ?></p>
    <p><strong>Dane zamawiajacego:</strong> <?php echo htmlspecialchars($dane_zamawiajacego); ?></p>
    <p><strong>Ilosc osob:</strong> <?php echo htmlspecialchars($ilosc_osob); ?></p>

    <?php foreach ($osoby as $index => $osoba): ?>
        <h2>Osoba <?php echo $index; ?></h2>
        <p><strong>Imie i nazwisko:</strong> <?php echo htmlspecialchars($osoba['imie']); ?></p>
        <p><strong>Wiek:</strong> <?php echo htmlspecialchars($osoba['wiek']); ?></p>
    <?php endforeach; ?>
</body>
</html>
