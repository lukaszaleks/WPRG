<?php
$maksymalna_liczba_odwiedzin = 10;

$czas_waznosci_krotkotrwalego_cookie = 30 * 60;

if (isset($_COOKIE['liczba_odwiedzin'])) {
    $liczba_odwiedzin = $_COOKIE['liczba_odwiedzin'];
} else {
    $liczba_odwiedzin = 0;
}

if (!isset($_COOKIE['ostatnia_wizyta'])) {
    $liczba_odwiedzin++;
    
    setcookie('ostatnia_wizyta', 'true', time() + $czas_waznosci_krotkotrwalego_cookie);
}

setcookie('liczba_odwiedzin', $liczba_odwiedzin, time() + (30 * 24 * 60 * 60));

if ($liczba_odwiedzin >= $maksymalna_liczba_odwiedzin) {
    echo "<p>Odwiedziles te strone $liczba_odwiedzin razy. Osiagnales maksymalna liczbe odwiedzin!</p>";
} else {
    echo "<p>Odwiedziles te strone $liczba_odwiedzin razy.</p>";
}
?>
