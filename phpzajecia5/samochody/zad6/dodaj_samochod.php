<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj Samochod</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <a href="index.php">Strona glowna</a>
        <a href="wszystkie_samochody.php">Wszystkie samochody</a>
        <a href="dodaj_samochod.php" class="active">Dodaj samochod</a>
    </div>

    <div class="content">
        <h1>Dodaj nowy samochod</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $marka = $_POST['marka'];
            $model = $_POST['model'];
            $cena = $_POST['cena'];
            $rok = $_POST['rok'];
            $opis = $_POST['opis'];

            $conn = new mysqli("localhost", "root", "", "mojaBaza");

            if ($conn->connect_error) {
                die("Polaczenie nieudane: " . $conn->connect_error);
            }

            $sql = "INSERT INTO samochody (marka, model, cena, rok, opis) VALUES ('$marka', '$model', '$cena', '$rok', '$opis')";

            if ($conn->query($sql) === TRUE) {
                echo "<p>Samochod zostal dodany pomyslnie!</p>";
            } else {
                echo "Blad: " . $sql . "<br>" . $conn->error;
            }


            $conn->close();
        }
        ?>

        <form method="post">
            <label for="marka">Marka:</label>
            <input type="text" id="marka" name="marka" required><br><br>
            <label for="model">Model:</label>
            <input type="text" id="model" name="model" required><br><br>
            <label for="cena">Cena:</label>
            <input type="number" id="cena" name="cena" required><br><br>
            <label for="rok">Rok produkcji:</label>
            <input type="number" id="rok" name="rok" required><br><br>
            <label for="opis">Opis:</label><br>
            <textarea id="opis" name="opis" rows="4" cols="50"></textarea><br><br>
            <input type="submit" value="Dodaj samochod">
        </form>
    </div>
</body>
</html>
