<!DOCTYPE html>
<html>
<head>
    <title>Formularz rezerwacji hotelu</title>
</head>
<body>
    <h2>Formularz rezerwacji hotelu</h2>
    <form method="post" action="podsumowanie_rezerwacji.php">
        <label for="liczba_osob">Liczba osób:</label>
        <select name="liczba_osob" id="liczba_osob" required>
            <?php for ($i = 1; $i <= 4; $i++) { ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php } ?>
        </select><br><br>

        <div id="dodatkowe_dane"></div><br>

        <input type="submit" name="submit" value="Zarezerwuj">

        <script>
            document.getElementById('liczba_osob').addEventListener('change', function() {
                var liczbaOsob = this.value;
                var dodatkoweDaneDiv = document.getElementById('dodatkowe_dane');
                dodatkoweDaneDiv.innerHTML = '';

                for (var i = 1; i <= liczbaOsob; i++) {
                    dodatkoweDaneDiv.innerHTML += '<div>' +
                                                    '<h3>Dane osoby ' + i + '</h3>' +
                                                    '<label>Imię:</label>' +
                                                    '<input type="text" name="imie_' + i + '" required><br><br>' +
                                                    '<label>Nazwisko:</label>' +
                                                    '<input type="text" name="nazwisko_' + i + '" required><br><br>' +
                                                    '<label>Adres:</label>' +
                                                    '<input type="text" name="adres_' + i + '" required><br><br>' +
                                                    '<label>Nr karty kredytowej:</label>' +
                                                    '<input type="text" name="karta_kredytowa_' + i + '" required><br><br>' +
                                                    '<label>E-mail:</label>' +
                                                    '<input type="email" name="email_' + i + '" required><br><br>' +
                                                    '<label>Data pobytu:</label>' +
                                                    '<input type="date" name="data_pobytu_' + i + '" required><br><br>' +
                                                    '<label>Godzina przyjazdu:</label>' +
                                                    '<input type="time" name="godzina_przyjazdu_' + i + '" required><br><br>' +
                                                    '<label>Dostawka dla dziecka:</label>' +
                                                    '<input type="checkbox" name="dostawka_dla_dziecka_' + i + '"><br><br>' +
                                                    '<label>Udogodnienia:</label><br>' +
                                                    '<input type="checkbox" name="udogodnienia_' + i + '[]" value="klimatyzacja"> Klimatyzacja<br>' +
                                                    '<input type="checkbox" name="udogodnienia_' + i + '[]" value="popielniczka"> Popielniczka dla palacza<br><br>' +
                                                  '</div>';
                }
            });
        </script>
    </form>
</body>
</html>
