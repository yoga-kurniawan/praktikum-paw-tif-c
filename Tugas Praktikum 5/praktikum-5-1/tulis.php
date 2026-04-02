<?php

$barisBaru =  "Saya adalah mahasiswa FILKOM.\nProdi TIF";

$file = fopen("catatan.txt", "wx");

file_put_contents("catatan.txt", $barisBaru);

echo nl2br(file_get_contents("catatan.txt"));

fclose($file);
?>