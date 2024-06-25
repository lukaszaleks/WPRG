<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../db.php';
require_once '../functions.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    redirect('../user/access_denied.php');
}

$user_id = $_GET['id'];

try {
    // Usuniecie komentarzy powiazanych z artykulami uzytkownika
    $stmt = $conn->prepare('SELECT id FROM articles WHERE author_id = ?');
    $stmt->execute([$user_id]);
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($articles as $article) {
        $stmt = $conn->prepare('DELETE FROM comments WHERE article_id = ?');
        $stmt->execute([$article['id']]);
    }

    // Usuniecie artykulow uzytkownika
    $stmt = $conn->prepare('DELETE FROM articles WHERE author_id = ?');
    $stmt->execute([$user_id]);

    // Usuniecie uzytkownika
    $stmt = $conn->prepare('DELETE FROM users WHERE id = ?');
    $stmt->execute([$user_id]);

    redirect('admin.php');
} catch (PDOException $e) {
    echo 'Blad usuwania uzytkownika: ' . $e->getMessage();
}
?>
