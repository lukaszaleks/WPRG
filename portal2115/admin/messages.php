<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../db.php';
require_once '../functions.php';

if (!isset($_SESSION['user_id']) || !in_array($_SESSION['user_role'], ['admin', 'author'])) {
    redirect('../user/access_denied.php');
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message_id = sanitize_input($_POST['message_id']);
    $stmt = $conn->prepare('UPDATE messages SET is_read = 1 WHERE id = ?');
    if ($stmt->execute([$message_id])) {
        $message = 'Wiadomosc zostala oznaczona jako przeczytana.';
    } else {
        $message = 'Blad oznaczania wiadomosci: ' . $stmt->errorInfo()[2];
    }
}

$stmt = $conn->query('SELECT * FROM messages ORDER BY created_at DESC');
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Wiadomosci</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <h1>Wiadomosci</h1>
        <p><?php echo $message; ?></p>
        <div class="messages">
            <?php foreach ($messages as $msg): ?>
                <div class="message">
                    <p>Od: <?php echo htmlspecialchars($msg['contact_name']); ?> (<?php echo htmlspecialchars($msg['contact_email']); ?>)</p>
                    <p>Tresc: <?php echo htmlspecialchars($msg['message_content']); ?></p>
                    <p>Data: <?php echo htmlspecialchars($msg['created_at']); ?></p>
                    <form method="POST" action="messages.php">
                        <input type="hidden" name="message_id" value="<?php echo $msg['id']; ?>">
                        <?php if ($msg['is_read'] == 0): ?>
                            <button type="submit">Oznacz jako przeczytane</button>
                        <?php else: ?>
                            <p>Przeczytane</p>
                        <?php endif; ?>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
