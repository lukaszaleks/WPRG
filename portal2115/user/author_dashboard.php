<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../db.php';
require_once '../functions.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'author') {
    redirect('../user/access_denied.php');
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitize_input($_POST['title']);
    $content = sanitize_input($_POST['content']);
    $author_id = $_SESSION['user_id'];
    $category_id = sanitize_input($_POST['category_id']);

    $stmt = $conn->prepare('INSERT INTO articles (title, content, author_id, category_id) VALUES (?, ?, ?, ?)');
    if ($stmt->execute([$title, $content, $author_id, $category_id])) {
        $message = 'Artykul zostal dodany pomyslnie.';
    } else {
        $message = 'Blsd dodawania artykulu: ' . $stmt->errorInfo()[2];
    }
}

$stmt = $conn->prepare('SELECT articles.*, users.username AS author FROM articles JOIN users ON articles.author_id = users.id WHERE articles.author_id = ? ORDER BY created_at DESC');
$stmt->bindParam(1, $_SESSION['user_id'], PDO::PARAM_INT);
$stmt->execute();
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel autora</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <h1>Panel autora</h1>
        <form method="POST" action="author_dashboard.php">
            <label for="title">Tytul:</label>
            <input type="text" id="title" name="title" required>
            
            <label for="content">Tresc:</label>
            <textarea id="content" name="content" required></textarea>
            
            <label for="category_id">Kategoria:</label>
            <select id="category_id" name="category_id" required>
                <option value="1">Technologia</option>
                <option value="2">Zdrowie</option>
                <option value="3">Lifestyle</option>
            </select>
            
            <button type="submit">Dodaj artykul</button>
        </form>
        <p><?php echo $message; ?></p>

        <h2>Twoje artykuly</h2>
        <div class="articles">
            <?php foreach ($articles as $article): ?>
                <div class="article">
                    <h3><?php echo htmlspecialchars($article['title']); ?></h3>
                    <p><?php echo htmlspecialchars(substr($article['content'], 0, 100)); ?>...</p>
                    <p>Autor: <?php echo htmlspecialchars($article['author']); ?></p>
                    <a href="../articles/view_article.php?id=<?php echo $article['id']; ?>">Czytaj dalej</a>
                    <a href="edit_article.php?id=<?php echo $article['id']; ?>">Edytuj</a>
                    <a href="delete_article.php?id=<?php echo $article['id']; ?>" onclick="return confirm('Czy na pewno chcesz usunac ten artykul?')">Usun</a>
                </div>
            <?php endforeach; ?>
        </div>
        <a href="edit_profile.php">Edytuj profil</a>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
