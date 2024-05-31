<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wszystkie Samochody</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <a href="index.php">Strona glowna</a>
        <a href="wszystkie_samochody.php" class="active">Wszystkie samochody</a>
        <a href="dodaj_samochod.php">Dodaj samochod</a>
    </div>

    <div class="content">
        <h1>Wszystkie samochody</h1>
        <ul>
            <?php
            $conn = new mysqli("localhost", "root", "", "mojaBaza");

            if ($conn->connect_error) {
                die("Polaczenie nieudane: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM samochody";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<li>" . $row["marka"] . " " . $row["model"] . " - " . $row["cena"] . " PLN</li>";
                }
            } else {
                echo "Brak samochodow w bazie danych";
            }

            $conn->close();
            ?>
        </ul>
    </div>

</body>
</html>
