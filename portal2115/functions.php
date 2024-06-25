<?php
function redirect($url) {
    header("Location: $url");
    exit;
}

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function check_login() {
    if (!isset($_SESSION['user_id'])) {
        redirect('../user/login.php');
    }
}

function saveToFile($filename, $data) {
    $file = fopen($filename, 'a'); // 'a' oznacza, ze dane beda dopisywane do pliku
    if ($file) {
        fwrite($file, $data . PHP_EOL);
        fclose($file);
    } else {
        echo "Nie mozna otworzycpliku do zapisu.";
    }
}
?>
