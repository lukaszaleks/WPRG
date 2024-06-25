<?php
session_start();
require_once '../db.php';
require_once '../functions.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    redirect('../user/login.php');
}

$message = '';

if (isset($_GET['mark_as_read'])) {
    $stmt = $conn->prepare('UPDATE messages SET is_read = 1 WHERE id = ?');
    if ($stmt->execute([sanitize_input($_GET['mark_as_read'])])) {
        $message = 'Wiadomosc oznaczona jako przeczytana.';
    } else {
        $message = 'Blad podczas oznaczania wiadomosci: ' . $stmt->errorInfo()[2];
    }
}

try {
    $stmt = $conn->query('SELECT * FROM messages ORDER BY created_at DESC');
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $message = 'Blad pobierania wiadomosci: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel administracyjny - Wiadomosci</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <h1>Panel administracyjny - Wiadomosci</h1>
        <p><?php echo $message; ?></p>
        
        <h2>Wiadomosci</h2>
        <table>
            <tr>
                <th>Imie</th>
                <th>E-mail</th>
                <th>Wiadomosc</th>
                <th>Data</th>
                <th>Akcja</th>
            </tr>
            <?php foreach ($messages as $msg): ?>
                <tr>
                    <td><?php echo htmlspecialchars($msg['contact_name']); ?></td>
                    <td><?php echo htmlspecialchars($msg['contact_email']); ?></td>
                    <td><?php echo htmlspecialchars($msg['message_content']); ?></td>
                    <td><?php echo htmlspecialchars($msg['created_at']); ?></td>
                    <td>
                        <?php if ($msg['is_read']): ?>
                            Przeczytana
                        <?php else: ?>
                            <a href="admin_messages.php?mark_as_read=<?php echo $msg['id']; ?>">Oznacz jako przeczytana</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
