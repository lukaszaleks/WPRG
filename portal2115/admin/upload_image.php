<?php
session_start();
require_once '../db.php';
require_once '../functions.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    redirect('../user/login.php');
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Sprawdz, czy plik jest obrazem
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $message = "Plik nie jest obrazem.";
        $uploadOk = 0;
    }

    // Sprawdz, czy plik juz istnieje
    if (file_exists($target_file)) {
        $message = "Plik juz istnieje.";
        $uploadOk = 0;
    }

    // Sprawdz rozmiar pliku
    if ($_FILES["image"]["size"] > 500000) {
        $message = "Plik jest za duzy.";
        $uploadOk = 0;
    }

    // Zezwol na okreslone formaty plikow
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $message = "Dozwolone sa tylko pliki JPG, JPEG, PNG i GIF.";
        $uploadOk = 0;
    }

    // Sprawdz, czy $uploadOk jest ustawione na 0 przez blad
    if ($uploadOk == 0) {
        $message = "Plik nie zostal przeslany.";
    // jesli wszystko jest w porzadku, sprobuj przeslac plik
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $message = "Plik ". basename( $_FILES["image"]["name"]). " zostal przeslany.";
        } else {
            $message = "Wystapil blad podczas przesylania pliku.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Przeslij obraz</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <h1>Przeslij obraz</h1>
        <form method="POST" action="upload_image.php" enctype="multipart/form-data">
            <label for="image">Wybierz obraz:</label>
            <input type="file" id="image" name="image" required>
            <button type="submit">Przeslij</button>
        </form>
        <p><?php echo $message; ?></p>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
