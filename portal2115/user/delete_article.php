=<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../db.php';
require_once '../functions.php';

if (!isset($_SESSION['user_id'])) {
    redirect('access_denied.php');
}

$article_id = $_GET['id'];

try {
    // Sprawdz, czy artykul nalezy do zalogowanego uzytkownika
    $stmt = $conn->prepare('SELECT author_id, image FROM articles WHERE id = ?');
    $stmt->execute([$article_id]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($article['author_id'] !== $_SESSION['user_id']) {
        redirect('access_denied.php');
    }

    // Usuniecie komentarzy powiazanych z artykulem
    $stmt = $conn->prepare('DELETE FROM comments WHERE article_id = ?');
    $stmt->execute([$article_id]);

    // Usuniecie obrazu artykulu, jesli istnieje
    if ($article['image']) {
        $image_path = '../uploads/' . $article['image'];
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }

    // Usuniecie artykulu
    $stmt = $conn->prepare('DELETE FROM articles WHERE id = ?');
    $stmt->execute([$article_id]);

    redirect('author_dashboard.php');
} catch (PDOException $e) {
    echo 'Blad usuwania artykulu: ' . $e->getMessage();
}
?>
