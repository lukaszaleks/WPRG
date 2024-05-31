<?php
include 'session_start.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Strona 1</title>
</head>
<body>
    <h1>Podaj dane ogolne</h1>
    <form action="strona2.php" method="post">
        <label for="nr_karty">Nr karty:</label>
        <input type="text" id="nr_karty" name="nr_karty" required><br>
        
        <label for="dane_zamawiajacego">Dane zamawiajacego:</label>
        <input type="text" id="dane_zamawiajacego" name="dane_zamawiajacego" required><br>
        
        <label for="ilosc_osob">Ilosc osob:</label>
        <input type="number" id="ilosc_osob" name="ilosc_osob" min="1" required><br>
        
        <input type="submit" value="Dalej">
    </form>
</body>
</html>
