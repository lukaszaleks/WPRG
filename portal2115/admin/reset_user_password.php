<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../db.php';
require_once '../functions.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    redirect('../user/access_denied.php');
}

$message = '';
$user_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = sanitize_input($_POST['new_password']);
    $confirm_password = sanitize_input($_POST['confirm_password']);

    if ($new_password === $confirm_password) {
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare('UPDATE users SET password = ? WHERE id = ?');
        if ($stmt->execute([$hashed_password, $user_id])) {
            $message = 'Haslo zostalo zaktualizowane.';
        } else {
            $message = 'Blad aktualizacji hasla: ' . $stmt->errorInfo()[2];
        }
    } else {
        $message = 'Nowe hasla sie nie zgadzaja.';
    }
}

$stmt = $conn->prepare('SELECT * FROM users WHERE id = ?');
$stmt->bindParam(1, $user_id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zresetuj haslo uzytkownika</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <h1>Zresetuj haslo uzytkownika</h1>
        <form method="POST" action="reset_user_password.php?id=<?php echo $user_id; ?>">
            <label for="new_password">Nowe haslo:</label>
            <input type="password" id="new_password" name="new_password" required>
            
            <label for="confirm_password">Potwierdz nowe haslo:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            
            <button type="submit">Zresetuj haslo</button>
        </form>
        <p><?php echo $message; ?></p>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
