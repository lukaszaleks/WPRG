<!DOCTYPE html>
<html>
<head>
    <title>Lista odnosnikow</title>
</head>
<body>

<h2>Lista odnosnikow</h2>

<ul>
    <?php
    $file_path = "C:/xampp/htdocs/phpzajecia4/zad3/lista_adresow.txt";

    if (file_exists($file_path)) {
        $file = fopen($file_path, "r");

        while (!feof($file)) {
            $line = fgets($file);
            
            $data = explode(";", $line);

            if (count($data) == 2) {
                $url = trim($data[0]); 
                $description = trim($data[1]);

                echo "<li><a href='$url'>$description</a></li>";
            }
        }

        fclose($file);
    } else {
        echo "Plik nie istnieje.";
    }
    ?>
</ul>

</body>
</html>
