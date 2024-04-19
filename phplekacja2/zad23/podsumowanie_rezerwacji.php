<!DOCTYPE html>
<html>
<head>
    <title>Podsumowanie rezerwacji</title>
</head>
<body>
    <h2>Podsumowanie rezerwacji</h2>
    <?php
    if(isset($_POST['submit'])){
        $liczbaOsob = $_POST['liczba_osob'];
        $podsumowanie = '';

        for ($i = 1; $i <= $liczbaOsob; $i++) {
            $imie = $_POST['imie_' . $i];
            $nazwisko = $_POST['nazwisko_' . $i];
            $adres = $_POST['adres_' . $i];
            $kartaKredytowa = $_POST['karta_kredytowa_' . $i];
            $email = $_POST['email_' . $i];
            $dataPobytu = $_POST['data_pobytu_' . $i];
            $godzinaPrzyjazdu = $_POST['godzina_przyjazdu_' . $i];
            $dostawkaDlaDziecka = isset($_POST['dostawka_dla_dziecka_' . $i]) ? "Tak" : "Nie";
            $udogodnienia = isset($_POST['udogodnienia_' . $i]) ? implode(', ', $_POST['udogodnienia_' . $i]) : "Brak";

            $podsumowanie .= "<div>" .
                                "<h3>Dane osoby $i</h3>" .
                                "<p>Imię: $imie</p>" .
                                "<p>Nazwisko: $nazwisko</p>" .
                                "<p>Adres: $adres</p>" .
                                "<p>Nr karty kredytowej: $kartaKredytowa</p>" .
                                "<p>E-mail: $email</p>" .
                                "<p>Data pobytu: $dataPobytu</p>" .
                                "<p>Godzina przyjazdu: $godzinaPrzyjazdu</p>" .
                                "<p>Dostawka dla dziecka: $dostawkaDlaDziecka</p>" .
                                "<p>Udogodnienia: $udogodnienia</p>" .
                             "</div>";
        }

        echo $podsumowanie;
    }
    ?>
</body>
</html>
