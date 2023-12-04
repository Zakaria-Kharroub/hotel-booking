<?php

if (isset($_POST["textcheck"], $_POST["valinput"])) {
    $inputText = $_POST["textcheck"];
    $valinput = $_POST["valinput"];

    if (empty($inputText) || empty($valinput)) {
        echo "input est vide ";
    } else {
        $tableau = explode(" ", $inputText);

        $longmot = "";

        $motLenght = 0;

        foreach ($tableau as $mot) {
            if (strpos($mot, $valinput) !== false) {
                if (strlen($mot) > $motLenght) {
                    $longmot = $mot;
                    $motLenght = strlen($mot);
                }
            }
        }

        echo "le mot plus long est: $longmot <br> lenght est  : $motLenght";
    }
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form method="POST" action="">
    <textarea name="textcheck" id="" cols="50" rows="20"></textarea><br>
    <input type="text" name="valinput"><br>
    <button type='submit'>check</button>
</form>

</body>
</html>
