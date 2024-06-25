<?php
require_once '../db.php';
require_once '../functions.php';

$message = '';

if (isset($_GET['token']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = sanitize_input($_GET['token']);
    $new_password = password_hash(sanitize_input($_POST['new_password']), PASSWORD_BCRYPT);

    $stmt = $conn->prepare('SELECT * FROM users WHERE reset_token = ? AND reset_token_expires > NOW()');
    if ($stmt->execute([$token])) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $stmt = $conn->prepare('UPDATE users SET password = ?, reset_token = NULL, reset_token_expires = NULL WHERE id = ?');
            if ($stmt->execute([$new_password, $user['id']])) {
                $message = 'Haslo zostalo zaktualizowane pomyslnie.';
            } else {
                $message = 'Wystapil blad podczas aktualizacji hasla: ' . $stmt->errorInfo()[2];
            }
        } else {
            $message = 'Token jest nieprawidlowy lub wygasl.';
        }
    } else {
        $message = 'Blad polaczenia: ' . $stmt->errorInfo()[2];
    }
} else {
    $message = 'Niepoprawne zadanie.';
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Ustaw nowe haslo</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <h1>Ustaw nowe haslo</h1>
        <form method="POST" action="new_password.php?token=<?php echo htmlspecialchars($_GET['token']); ?>">
            <label for="new_password">Nowe haslo:</label>
            <input type="password" id="new_password" name="new_password" required>
            <button type="submit">Ustaw nowe haslo</button>
        </form>
        <p><?php echo $message; ?></p>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
