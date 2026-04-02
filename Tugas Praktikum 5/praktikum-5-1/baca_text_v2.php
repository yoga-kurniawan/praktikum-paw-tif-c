<?php

$file = fopen("data.txt", "r");

while (($baris = fgets($file)) != false){
    echo nl2br($baris);
}

fclose($file);

?>