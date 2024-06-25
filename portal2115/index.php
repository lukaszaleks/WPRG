<?php
require_once 'db.php';
require_once 'functions.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Portal Informacyjny</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <main>
        <h1>Witamy w Portalu Informacyjnym</h1>
        <h2>Najnowsze artykuly</h2>
        <div class="articles">
            <?php
            $stmt = $conn->query('SELECT articles.*, users.username AS author, categories.name AS category FROM articles JOIN users ON articles.author_id = users.id JOIN categories ON articles.category_id = categories.id ORDER BY articles.created_at DESC LIMIT 5');
            $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($articles as $article):
            ?>
                <div class="article">
                    <h3><?php echo htmlspecialchars($article['title']); ?></h3>
                    <p><?php echo htmlspecialchars(substr($article['content'], 0, 100)); ?>...</p>
                    <p>Autor: <?php echo htmlspecialchars($article['author']); ?></p>
                    <p>Kategoria: <?php echo htmlspecialchars($article['category']); ?></p>
                    <?php if ($article['image']): ?>
                        <img src="uploads/<?php echo htmlspecialchars($article['image']); ?>" alt="Obraz" style="max-width: 100px;">
                    <?php endif; ?>
                    <a href="articles/view_article.php?id=<?php echo $article['id']; ?>">Czytaj dalej</a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
