<?php
require_once '../db.php';
require_once '../functions.php';

$article_id = $_GET['id'];
$stmt = $conn->prepare('SELECT * FROM articles WHERE id = ?');
$stmt->bindParam(1, $article_id, PDO::PARAM_INT);
$stmt->execute();
$article = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $conn->prepare('SELECT * FROM comments WHERE article_id = ? ORDER BY created_at DESC');
$stmt->bindParam(1, $article_id, PDO::PARAM_INT);
$stmt->execute();
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($article['title']); ?></title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <h1><?php echo htmlspecialchars($article['title']); ?></h1>
        <p><?php echo nl2br(htmlspecialchars($article['content'])); ?></p>
        <p>Autor: <?php echo htmlspecialchars($article['author_id']); ?></p>
        <p>Data: <?php echo htmlspecialchars($article['created_at']); ?></p>
        
        <h2>Komentarze</h2>
        <?php foreach ($comments as $comment): ?>
            <div class="comment">
                <p><?php echo nl2br(htmlspecialchars($comment['content'])); ?></p>
                <p>Autor: <?php echo htmlspecialchars($comment['author']); ?></p>
                <p>Data: <?php echo htmlspecialchars($comment['created_at']); ?></p>
            </div>
        <?php endforeach; ?>

        <form action="../comments/add_comment.php" method="post">
            <input type="hidden" name="article_id" value="<?php echo $article_id; ?>">
            <label for="author">Nick:</label>
            <input type="text" id="author" name="author" required>
            <label for="content">Komentarz:</label>
            <textarea id="content" name="content" required></textarea>
            <button type="submit">Dodaj komentarz</button>
        </form>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
