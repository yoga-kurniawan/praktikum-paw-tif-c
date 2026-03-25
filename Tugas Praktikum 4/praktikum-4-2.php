<?php
function penjumlahan($x, $y) {
    return ($x + $y);
}

function panjangString($string) {
    return strlen($string);
}

$penjumlahan1 = penjumlahan(1,5);
$penjumlahan2 = penjumlahan(-5,6);
$string1 = panjangString("Saya");
$string2 = panjangString("Brawijaya");
echo "Hasil penjumlahan 1: " . $penjumlahan1 . "<br>";
echo "Hasil penjumlahan 2: " . $penjumlahan2 . "<br>";
echo "Panjang String 1: " . $string1 . "<br>";
echo "Panjang String 1: " . $string2 . "<br>";
?>