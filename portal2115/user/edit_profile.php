<?php
session_start();
require_once '../db.php';
require_once '../functions.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'author') {
    redirect('../user/login.php');
}

$message = '';
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize_input($_POST['username']);
    $email = sanitize_input($_POST['email']);
    $stmt = $conn->prepare('UPDATE users SET username = ?, email = ? WHERE id = ?');
    if ($stmt->execute([$username, $email, $user_id])) {
        $message = 'Profil zostal zaktualizowany.';
    } else {
        $message = 'Blad aktualizacji profilu: ' . $stmt->errorInfo()[2];
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
    <title>Edytuj profil</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <h1>Edytuj profil</h1>
        <form method="POST" action="edit_profile.php">
            <label for="username">Nazwa uzytkownika:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            
            <button type="submit">Zaktualizuj profil</button>
        </form>
        <p><?php echo $message; ?></p>
        <a href="reset_password.php">Resetuj haslo</a>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
