<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "mojaBaza";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Polaczenie nieudane: " . $conn->connect_error);
}


$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Baza danych 'mojaBaza' zostala utworzona pomyslnie.<br>";
} else {
    echo "Blad przy tworzeniu bazy danych: " . $conn->error . "<br>";
}

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "CREATE TABLE IF NOT EXISTS samochody (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    marka VARCHAR(255) NOT NULL,
    model VARCHAR(255) NOT NULL,
    cena DECIMAL(10, 2) NOT NULL,
    rok INT NOT NULL,
    opis TEXT
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabela 'samochody' zostala utworzona pomyslnie.<br>";
} else {
    echo "Blad przy tworzeniu tabeli: " . $conn->error . "<br>";
}

$sql = "INSERT INTO samochody (marka, model, cena, rok, opis) VALUES
('Toyota', 'Corolla', 75000, 2020, 'Niezawodny samochod z niskim przebiegiem'),
('Honda', 'Civic', 80000, 2021, 'Nowoczesny design i oszczednosc paliwa'),
('Ford', 'Focus', 65000, 2019, 'Dobrze utrzymany, niski przebieg'),
('BMW', '3 Series', 120000, 2018, 'Luksusowy samochod w swietnym stanie')";

if ($conn->query($sql) === TRUE) {
    echo "Przykladowe dane zostaly dodane pomyslnie.<br>";
} else {
    echo "Blad przy dodawaniu danych: " . $conn->error . "<br>";
}

$conn->close();
?>
