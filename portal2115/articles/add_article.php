<?php
session_start();
require_once '../db.php';
require_once '../functions.php';
check_login();

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = sanitize_input($_POST['title']);
    $content = sanitize_input($_POST['content']);
    $category_id = sanitize_input($_POST['category']);
    $author_id = $_SESSION['user_id'];

    $sql = "INSERT INTO articles (title, content, category_id, author_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute([$title, $content, $category_id, $author_id])) {
        $message = "Artykul zostal dodany.";
    } else {
        $message = "Blad podczas dodawania artykulu: " . $stmt->errorInfo()[2];
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dodaj Artykul</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <h2>Dodaj Artykul</h2>
        <form action="add_article.php" method="post">
            <label for="title">Tytul</label>
            <input type="text" id="title" name="title" required>
            
            <label for="content">Tresc</label>
            <textarea id="content" name="content" required></textarea>
            
            <label for="category">Kategoria</label>
            <select id="category" name="category" required>
                <option value="1">Technologia</option>
                <option value="2">Zdrowie</option>
                <option value="3">Lifestyle</option>
            </select>
            
            <button type="submit">Dodaj artykul</button>
        </form>
        <p><?php echo $message; ?></p>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
