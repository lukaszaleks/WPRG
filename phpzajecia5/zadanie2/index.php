<?php

$maksymalna_liczba_odwiedzin = 50;


if (isset($_COOKIE['liczba_odwiedzin'])) {
    
    $liczba_odwiedzin = $_COOKIE['liczba_odwiedzin'] + 1;
} else {
    
    $liczba_odwiedzin = 1;
}


setcookie('liczba_odwiedzin', $liczba_odwiedzin, time() + (30 * 24 * 60 * 60));


if ($liczba_odwiedzin >= $maksymalna_liczba_odwiedzin) {
    echo "<p>Odwiedziles te strone $liczba_odwiedzin razy. Osiagnales maksymalna liczbe odwiedzin!</p>";
} else {
    echo "<p>Odwiedziles te strone $liczba_odwiedzin razy.</p>";
}
?>
