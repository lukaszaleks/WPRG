<?php
$ip_pages = array(
    "192.168.1.100" => "strona_ip1.php",
    "192.168.1.101" => "strona_ip2.php",
    "192.168.1.102" => "strona_ip3.php"
);

$user_ip = $_SERVER['REMOTE_ADDR'];

$file_path = "adresy_ip.txt";

$ip_found = false;

if (file_exists($file_path)) {
    $file = fopen($file_path, "r");

    while (!feof($file)) {
        $line = fgets($file);

        $line = trim($line);

        $data = explode(";", $line);

        if (count($data) == 2) {
            $ip = trim($data[0]); 
            $page = trim($data[1]); 

            if ($user_ip === $ip && isset($ip_pages[$user_ip])) {

                include $ip_pages[$user_ip];
                $ip_found = true;
                exit; 
            }
        }
    }

    fclose($file);
}

if (!$ip_found) {
    echo "<h1>Witaj na stronie domyslnej</h1>";
    echo "<p>To jest strona domyslna, ktora bedzie wyswietlana dla uzytkownikow, ktorych adresy IP nie znajduja sie na liscie.</p>";
}
?>
