<?php
$file_path = "licznik.txt";

if (file_exists($file_path)) {
    $visits = intval(file_get_contents($file_path));
    
    $visits++;
    
    file_put_contents($file_path, $visits);
} else {
    file_put_contents($file_path, "1");
    $visits = 1;
}

echo "Liczba odwiedzin: " . $visits;
?>
