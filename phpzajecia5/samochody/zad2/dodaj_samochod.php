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
        <form action="dodaj_samochod.php" method="post">
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
