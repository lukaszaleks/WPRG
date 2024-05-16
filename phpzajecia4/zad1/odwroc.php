<!DOCTYPE html>
<html>
<head>
    <title>Zadanie 1</title>
</head>
<body>

<form method="post" enctype="multipart/form-data">
    Wybierz plik do przetworzenia: <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Wyslij plik" name="submit">
</form>

<?php
if(isset($_POST["submit"])) {
    $target_dir = ""; 
    $target_file = basename($_FILES["fileToUpload"]["name"]); 
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    
    if($fileType != "txt") {
        echo "Potrafie zamienic tylko pliki tekstowe.";
        $uploadOk = 0;
    }

    
    if ($uploadOk == 1) {
        $fileContent = file($target_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES); 
        if($fileContent !== false) {
            $reversedContent = array_reverse($fileContent); 
            $reversedFilePath = "reversed_file.txt"; 

            if (file_put_contents($reversedFilePath, implode(PHP_EOL, $reversedContent)) !== false) {
                echo "Kolejnosc wierszy zostala obrocona prawidlowo. <a href='$reversedFilePath'>Pobierz pliczek</a>";
            } else {
                echo "Nie moge zapisac pliku.";
            }
        } else {
            echo "Nie moge odczytac pliku";
        }
    }
}
?>

</body>
</html>
