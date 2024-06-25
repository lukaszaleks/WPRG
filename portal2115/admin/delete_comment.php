<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../db.php';
require_once '../functions.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    redirect('../user/access_denied.php');
}

$comment_id = $_GET['id'];

$stmt = $conn->prepare('DELETE FROM comments WHERE id = ?');
if ($stmt->execute([$comment_id])) {
    $message = 'Komentarz zostal usuniety.';
} else {
    $message = 'Blad usuwania komentarza: ' . $stmt->errorInfo()[2];
}

redirect('admin.php');
?>
