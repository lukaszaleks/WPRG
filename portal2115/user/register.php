<?php
session_start();
require_once '../db.php';
require_once '../functions.php';

$message = '';
// Zapisywanie danych uzytkownika podczas rejestracji
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize_input($_POST['username']);
    $email = sanitize_input($_POST['email']);
    $password = sanitize_input($_POST['password']);

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare('SELECT * FROM users WHERE email = ?');
    if ($stmt->execute([$email])) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $message = 'Uzytkownik z tym adresem email juz istnieje.';
        } else {
            $stmt = $conn->prepare('INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)');
            if ($stmt->execute([$username, $email, $hashed_password, 'user'])) {
                $message = 'Rejestracja zakonczona sukcesem.';
            } else {
                $message = 'Blad podczas rejestracji: ' . $stmt->errorInfo()[2];
            }
        }
    } else {
        $message = 'Blad polaczenia: ' . $stmt->errorInfo()[2];
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <h1>Rejestracja</h1>
        <form method="POST" action="register.php">
            <label for="username">Nazwa uzytkownika:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Haslo:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Zarejestruj sie</button>
        </form>
        <p><?php echo $message; ?></p>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
