<?php

$file = fopen("catatan.txt", "a");

$baris = "\nAngkatan 2024";

fwrite($file, $baris);
fclose($file);
?>