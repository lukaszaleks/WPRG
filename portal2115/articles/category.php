<?php
require_once '../db.php';

$category_id = $_GET['id'];
$stmt = $conn->prepare('SELECT * FROM articles WHERE category_id = ? ORDER BY created_at DESC');
$stmt->bindParam(1, $category_id, PDO::PARAM_INT);
$stmt->execute();
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Kategoria</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <h1>Artykuly</h1>
        <?php foreach ($articles as $article): ?>
            <div class="article">
                <h2><?php echo htmlspecialchars($article['title']); ?></h2>
                <p><?php echo htmlspecialchars(substr($article['content'], 0, 100)); ?>...</p>
                <a href="view_article.php?id=<?php echo $article['id']; ?>">Czytaj dalej</a>
            </div>
        <?php endforeach; ?>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
