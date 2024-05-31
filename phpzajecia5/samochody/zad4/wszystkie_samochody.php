<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wszystkie Samochody - Posortowane wedlug rocznika</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <a href="index.php">Strona glowna</a>
        <a href="wszystkie_samochody.php" class="active">Wszystkie samochody</a>
        <a href="dodaj_samochod.php">Dodaj samochod</a>
    </div>

    <div class="content">
        <h1>Wszystkie samochody - Posortowane wedlug rocznika</h1>
        <table>
            <tr>
                <th>Marka</th>
                <th>Model</th>
                <th>Rok produkcji</th>
                <th>Cena</th>
                <th>Opis</th>
            </tr>
            <?php
            $conn = new mysqli("localhost", "root", "", "mojaBaza");

            if ($conn->connect_error) {
                die("Polaczenie nieudane: " . $conn->connect_error);
            }

            $sql = "SELECT marka, model, rok, cena, opis FROM samochody ORDER BY rok DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["marka"] . "</td><td>" . $row["model"] . "</td><td>" . $row["rok"] . "</td><td>" . $row["cena"] . " PLN</td><td>" . $row["opis"] . "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Brak danych</td></tr>";
            }

            $conn->close();
            ?>
        </table>
    </div>

</body>
</html>
