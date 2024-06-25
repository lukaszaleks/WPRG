<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Portal Informacyjny</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/portal2115/index.php">Strona glowna</a></li>
                <li><a href="/portal2115/articles/category.php?id=1">Technologia</a></li>
                <li><a href="/portal2115/articles/category.php?id=2">Zdrowie</a></li>
                <li><a href="/portal2115/articles/category.php?id=3">Lifestyle</a></li>
                <li><a href="/portal2115/messages/contact.php">Kontakt</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <?php if (in_array($_SESSION['user_role'], ['admin', 'author'])): ?>
                        <li><a href="/portal2115/admin/messages.php">Wiadomosci</a></li>
                    <?php endif; ?>
                    <?php if ($_SESSION['user_role'] === 'admin'): ?>
                        <li><a href="/portal2115/admin/admin.php">Panel administratora</a></li>
                    <?php elseif ($_SESSION['user_role'] === 'author'): ?>
                        <li><a href="/portal2115/user/author_dashboard.php">Panel autora</a></li>
                    <?php endif; ?>
                    <li><a href="/portal2115/user/logout.php">Wyloguj sie</a></li>
                <?php else: ?>
                    <li><a href="/portal2115/user/login.php">Zaloguj sie</a></li>
                    <li><a href="/portal2115/user/register.php">Zarejestruj sie</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
</body>
</html>
