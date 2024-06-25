<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../db.php';
require_once '../functions.php';
require_once '../classes/Database.php';
require_once '../classes/Article.php';
require_once '../classes/User.php';
require_once '../classes/Comment.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    redirect('../user/access_denied.php');
}

$database = new Database();
$db = $database->getConnection();

$article = new Article($db);
$user = new User($db);
$comment = new Comment($db);

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $article->title = sanitize_input($_POST['title']);
    $article->content = sanitize_input($_POST['content']);
    $article->author_id = $_SESSION['user_id'];
    $article->category_id = sanitize_input($_POST['category_id']);

    $article->image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $article->image = basename($_FILES['image']['name']);
        $target = "../uploads/" . $article->image;
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $message = 'Blad przesylania pliku.';
        }
    }

    if ($article->create()) {
        $message = 'Artykul zostal dodany pomyslnie.';

         // Zapis artykulu do pliku tekstowego
        $data = "Tytul: {$article->title}\nTresc: {$article->content}\nAutor ID: {$article->author_id}\nKategoria ID: {$article->category_id}\nObraz: {$article->image}\n";
        saveToFile('../logs/articles.txt', $data);
        // Funkcja saveToFile zapisuje dane do pliku
    } else {
        $message = 'Blad dodawania artykulu.';
    }
}

$articles = $article->read()->fetchAll(PDO::FETCH_ASSOC);
$users = $user->read()->fetchAll(PDO::FETCH_ASSOC);
$comments = $comment->read()->fetchAll(PDO::FETCH_ASSOC);
// Przyklad formularzy nizej 
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel administracyjny</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <h1>Panel administracyjny</h1>
        <form method="POST" action="admin.php" enctype="multipart/form-data">
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
            
            <label for="image">Zdjecie:</label>
            <input type="file" id="image" name="image" accept="image/*">
            
            <button type="submit">Dodaj artykul</button>
        </form>
        <p><?php echo $message; ?></p>

        <h2>Lista artykulow</h2>
        <table>
            <thead>
                <tr>
                    <th>Tytul</th>
                    <th>Autor</th>
                    <th>Kategoria</th>
                    <th>Data utworzenia</th>
                    <th>Obraz</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $article): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($article['title']); ?></td>
                        <td><?php echo htmlspecialchars($article['author']); ?></td>
                        <td><?php echo htmlspecialchars($article['category']); ?></td>
                        <td><?php echo htmlspecialchars($article['created_at']); ?></td>
                        <td>
                            <?php if ($article['image']): ?>
                                <img src="../uploads/<?php echo htmlspecialchars($article['image']); ?>" alt="Obraz" style="max-width: 100px;">
                            <?php else: ?>
                                Brak obrazu
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="edit_article.php?id=<?php echo $article['id']; ?>">Edytuj</a>
                            <a href="delete_article.php?id=<?php echo $article['id']; ?>" onclick="return confirm('Czy na pewno chcesz usunac ten artykul?')">Usun</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Lista uzytkownikow</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nazwa uzytkownika</th>
                    <th>Email</th>
                    <th>Rola</th>
                    <th>Data utworzenia</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['role']); ?></td>
                        <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                        <td>
                            <a href="edit_user.php?id=<?php echo $user['id']; ?>">Edytuj</a>
                            <a href="delete_user.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Czy na pewno chcesz usunac tego uyytkownika?')">Usun</a>
                            <a href="reset_user_password.php?id=<?php echo $user['id']; ?>">Zresetuj haslo</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Lista komentarzy</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Autor</th>
                    <th>Tresc</th>
                    <th>Artykul</th>
                    <th>Data utworzenia</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comments as $comment): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($comment['id']); ?></td>
                        <td><?php echo htmlspecialchars($comment['author']); ?></td>
                        <td><?php echo htmlspecialchars($comment['content']); ?></td>
                        <td><?php echo htmlspecialchars($comment['article_title']); ?></td>
                        <td><?php echo htmlspecialchars($comment['created_at']); ?></td>
                        <td>
                            <a href="delete_comment.php?id=<?php echo $comment['id']; ?>" onclick="return confirm('Czy na pewno chcesz usunac ten komentarz?')">Usun</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <?php include '../includes/footer.php'; ?>
</body>
</html>
