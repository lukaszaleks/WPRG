<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wszystkie Samochody - Wariant A</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <a href="index.php">Strona glowna</a>
        <a href="wszystkie_samochody.php" class="active">Wszystkie samochody</a>
        <a href="dodaj_samochod.php">Dodaj samochod</a>
    </div>

    <div class="content">
        <h1>Wszystkie samochody - Wariant A</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Marka</th>
                <th>Model</th>
                <th>Cena</th>
                <th>Akcje</th>
            </tr>
            <?php
            $conn = new mysqli("localhost", "root", "", "mojaBaza");

            if ($conn->connect_error) {
                die("Polaczenie nieudane: " . $conn->connect_error);
            }

            $sql = "SELECT id, marka, model, cena FROM samochody";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><a href='samochod_info.php?id=" . $row["id"] . "'>" . $row["id"] . "</a></td>";
                    echo "<td>" . $row["marka"] . "</td>";
                    echo "<td>" . $row["model"] . "</td>";
                    echo "<td>" . $row["cena"] . " PLN</td>";
                    echo "<td><a href='index.php'>Powrot</a></td>";
                    echo "</tr>";
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
