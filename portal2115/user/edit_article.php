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
$article_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = sanitize_input($_POST['title']);
    $content = sanitize_input($_POST['content']);
    $category_id = sanitize_input($_POST['category_id']);

    $stmt = $conn->prepare('UPDATE articles SET title = ?, content = ?, category_id = ? WHERE id = ? AND author_id = ?');
    if ($stmt->execute([$title, $content, $category_id, $article_id, $_SESSION['user_id']])) {
        $message = 'Artykul zostal zaktualizowany pomyslnie.';
    } else {
        $message = 'Blad aktualizacji artykulu: ' . $stmt->errorInfo()[2];
    }
}

$stmt = $conn->prepare('SELECT * FROM articles WHERE id = ? AND author_id = ?');
$stmt->bindParam(1, $article_id, PDO::PARAM_INT);
$stmt->bindParam(2, $_SESSION['user_id'], PDO::PARAM_INT);
$stmt->execute();
$article = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Edytuj artykul</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <h1>Edytuj artykul</h1>
        <form method="POST" action="edit_article.php?id=<?php echo $article_id; ?>">
            <label for="title">Tytul:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" required>
            
            <label for="content">Tresc:</label>
            <textarea id="content" name="content" required><?php echo htmlspecialchars($article['content']); ?></textarea>
            
            <label for="category_id">Kategoria:</label>
            <select id="category_id" name="category_id" required>
                <option value="1" <?php if ($article['category_id'] == 1) echo 'selected'; ?>>Technologia</option>
                <option value="2" <?php if ($article['category_id'] == 2) echo 'selected'; ?>>Zdrowie</option>
                <option value="3" <?php if ($article['category_id'] == 3) echo 'selected'; ?>>Lifestyle</option>
            </select>
            
            <button type="submit">Zaktualizuj artykul</button>
        </form>
        <p><?php echo $message; ?></p>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
