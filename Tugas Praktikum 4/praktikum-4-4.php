<?php
$prodis = ["teknik informatika", "teknik komputer", "ilmu komputer", "sistem informasi", "teknologi informasi", "pendidikan teknologi informasi"];

foreach ($prodis as $prodi) {
    echo $prodi . "<br>";
}

$assArray = ["nama" => "Budi", "nim" => "12345", "prodi" => "teknik informatika"];

foreach ($assArray as $key => $value){
    echo $key . " : " . $value . "<br>";
}
?>