<?php
require_once '../db.php';
require_once '../functions.php';

$author_id = $_GET['id'];
$stmt = $conn->prepare('SELECT articles.*, users.username AS author, categories.name AS category FROM articles JOIN users ON articles.author_id = users.id JOIN categories ON articles.category_id = categories.id WHERE articles.author_id = ? ORDER BY articles.created_at DESC');
$stmt->bindParam(1, $author_id, PDO::PARAM_INT);
$stmt->execute();
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Artykuly autora</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <h1>Artykuly autora</h1>
        <div class="articles">
            <?php foreach ($articles as $article): ?>
                <div class="article">
                    <h3><?php echo htmlspecialchars($article['title']); ?></h3>
                    <p><?php echo htmlspecialchars(substr($article['content'], 0, 100)); ?>...</p>
                    <p>Autor: <?php echo htmlspecialchars($article['author']); ?></p>
                    <p>Kategoria: <?php echo htmlspecialchars($article['category']); ?></p>
                    <a href="view_article.php?id=<?php echo $article['id']; ?>">Czytaj dalej</a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
