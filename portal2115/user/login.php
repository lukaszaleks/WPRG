
<?php
session_start();
require_once '../db.php';
require_once '../functions.php';
/*uzycie formularzy i ich funkcjonalnosci - odbieranie i przetwarzanie danych */
//Ten plik juz uzywa sesji (session_start()) i przechowuje w niej dane uzytkownika po pomyslnym zalogowaniu
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitize_input($_POST['email']);
    $password = sanitize_input($_POST['password']);

    $stmt = $conn->prepare('SELECT * FROM users WHERE email = ?');
    if ($stmt->execute([$email])) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            redirect('../index.php');
        } else {
            $message = 'Nieprawidlowe dane logowania.';
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
    <title>Logowanie</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <h1>Logowanie</h1>
        <form method="POST" action="login.php">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Haslo:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Zaloguj</button>
        </form>
        <p><?php echo $message; ?></p>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
