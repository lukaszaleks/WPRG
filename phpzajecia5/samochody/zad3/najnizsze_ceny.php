<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona Glowna - Najnizsze ceny</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <a href="index.php" class="active">Strona glowna</a>
        <a href="wszystkie_samochody.php">Wszystkie samochody</a>
        <a href="dodaj_samochod.php">Dodaj samochod</a>
    </div>

    <div class="content">
        <h1>Najnizsze ceny samochodow</h1>
        <table>
            <tr>
                <th>Marka</th>
                <th>Model</th>
                <th>Cena</th>
            </tr>
            <?php
            $conn = new mysqli("localhost", "root", "", "mojaBaza");

            if ($conn->connect_error) {
                die("Połączenie nieudane: " . $conn->connect_error);
            }

            $sql = "SELECT marka, model, cena FROM samochody ORDER BY cena ASC LIMIT 5";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["marka"] . "</td><td>" . $row["model"] . "</td><td>" . $row["cena"] . " PLN</td></tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Brak danych</td></tr>";
            }

            $conn->close();
            ?>
        </table>
    </div>

</body>
</html>
