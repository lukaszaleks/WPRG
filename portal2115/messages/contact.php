<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../db.php';
require_once '../functions.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contact_name = sanitize_input($_POST['contact_name']);
    $contact_email = sanitize_input($_POST['contact_email']);
    $message_content = sanitize_input($_POST['message_content']);

    $stmt = $conn->prepare('INSERT INTO messages (contact_name, contact_email, message_content) VALUES (?, ?, ?)');
    if ($stmt->execute([$contact_name, $contact_email, $message_content])) {
        $message = 'Wiadomosc zostala wyslana pomyslnie.';
    } else {
        $message = 'Blad wysylania wiadomosci: ' . $stmt->errorInfo()[2];
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Kontakt</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <h1>Kontakt</h1>
        <form method="POST" action="contact.php">
            <label for="contact_name">Imie:</label>
            <input type="text" id="contact_name" name="contact_name" required>
            
            <label for="contact_email">E-mail:</label>
            <input type="email" id="contact_email" name="contact_email" required>
            
            <label for="message_content">Tresc wiadomosci:</label>
            <textarea id="message_content" name="message_content" required></textarea>
            
            <button type="submit">Wyslij</button>
        </form>
        <p><?php echo $message; ?></p>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
