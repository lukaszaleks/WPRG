<?php

function katalogi($sciezka, $nazwa_katalogu, $operacja = 'read') {
    $sciezka_katalogu = $sciezka . '/' . $nazwa_katalogu;

    if ($operacja == 'delete') {
        if (is_dir($sciezka_katalogu)) {
            if (is_writable($sciezka_katalogu)) {
                rmdir($sciezka_katalogu);
                return "Katalog $nazwa_katalogu zostal usuniety.";
            } else {
                return "Brak uprawnien do usuniecia katalogu $nazwa_katalogu.";
            }
        } else {
            return "Katalog $nazwa_katalogu nie istnieje.";
        }
    } elseif ($operacja == 'create') {
        if (!is_dir($sciezka_katalogu)) {
            mkdir($sciezka_katalogu);
            return "Katalog $nazwa_katalogu zostal utworzony.";
        } else {
            return "Katalog $nazwa_katalogu juz istnieje.";
        }
    } else {
        if (is_dir($sciezka_katalogu)) {
            $elementy = scandir($sciezka_katalogu);
            return "Zawartosc katalogu $nazwa_katalogu: " . implode(', ', $elementy);
        } else {
            return "Katalog $nazwa_katalogu nie istnieje.";
        }
    }
}

?>
