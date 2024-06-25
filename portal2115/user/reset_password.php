<?php
session_start();
require_once '../db.php';
require_once '../functions.php';

if (!isset($_SESSION['user_id'])) {
    redirect('../user/login.php');
}

$message = '';
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = sanitize_input($_POST['current_password']);
    $new_password = sanitize_input($_POST['new_password']);
    $confirm_password = sanitize_input($_POST['confirm_password']);

    if ($new_password === $confirm_password) {
        $stmt = $conn->prepare('SELECT password FROM users WHERE id = ?');
        $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($current_password, $user['password'])) {
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
            $stmt = $conn->prepare('UPDATE users SET password = ? WHERE id = ?');
            if ($stmt->execute([$hashed_password, $user_id])) {
                $message = 'Haslo zostalo zaktualizowane.';
            } else {
                $message = 'Blad aktualizacji hasla: ' . $stmt->errorInfo()[2];
            }
        } else {
            $message = 'Nieprawidlowe obecne haslo.';
        }
    } else {
        $message = 'Nowe hasla sie nie zgadzaja.';
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Resetuj haslo</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <h1>Resetuj haslo</h1>
        <form method="POST" action="reset_password.php">
            <label for="current_password">Obecne haslo:</label>
            <input type="password" id="current_password" name="current_password" required>
            
            <label for="new_password">Nowe haslo:</label>
            <input type="password" id="new_password" name="new_password" required>
            
            <label for="confirm_password">Potwierdz nowe haslo:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            
            <button type="submit">Resetuj haslo</button>
        </form>
        <p><?php echo $message; ?></p>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
