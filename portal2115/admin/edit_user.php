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
    $username = sanitize_input($_POST['username']);
    $email = sanitize_input($_POST['email']);
    $role = sanitize_input($_POST['role']);

    $stmt = $conn->prepare('UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?');
    if ($stmt->execute([$username, $email, $role, $user_id])) {
        $message = 'Dane uzytkownika zostaly zaktualizowane.';
    } else {
        $message = 'Blad aktualizacji danych: ' . $stmt->errorInfo()[2];
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
    <title>Edytuj uzytkownika</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <h1>Edytuj uzytkownika</h1>
        <form method="POST" action="edit_user.php?id=<?php echo $user_id; ?>">
            <label for="username">Nazwa uzytkownika:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            
            <label for="role">Rola:</label>
            <select id="role" name="role" required>
                <option value="admin" <?php if ($user['role'] === 'admin') echo 'selected'; ?>>Administrator</option>
                <option value="author" <?php if ($user['role'] === 'author') echo 'selected'; ?>>Autor</option>
                <option value="user" <?php if ($user['role'] === 'user') echo 'selected'; ?>>Uzytkownik</option>
            </select>
            
            <button type="submit">Zaktualizuj uzytkownika</button>
        </form>
        <p><?php echo $message; ?></p>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
