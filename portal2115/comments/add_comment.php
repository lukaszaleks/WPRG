<?php
require_once '../db.php';
require_once '../functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $article_id = sanitize_input($_POST['article_id']);
    $author = sanitize_input($_POST['author']);
    $content = sanitize_input($_POST['content']);
    
    $stmt = $conn->prepare('INSERT INTO comments (article_id, author, content) VALUES (?, ?, ?)');
    if ($stmt->execute([$article_id, $author, $content])) {
        header('Location: ../articles/view_article.php?id=' . $article_id);
    } else {
        echo 'Blad: ' . $stmt->errorInfo()[2];
    }
}
?>
