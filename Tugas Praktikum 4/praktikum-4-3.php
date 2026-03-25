<?php
class Mahasiswa {
    public $nim;
    public $nama;
    public $prodi;

    public function __construct($nim, $nama, $prodi){
        $this->nim = $nim;
        $this->nama = $nama;
        $this->prodi = $prodi;
    }
    public function kuliah(){
        echo $this->nama . " sedang kuliah <br>";
    }
    public function ujian(){
        echo $this->nama . " sedang ujian <br>";
    }
    public function praktikum(){
        echo $this->nama . " sedang praktikum <br>";
    }
    public function biodata(){
        echo "Nama : " . $this->nama . " <br>";
        echo "Nim : " . $this->nim . " <br>";
        echo "Prodi : " . $this->prodi . " <br>";
    }
}

$mhs1 = new Mahasiswa("12345", "Budi", "Informatika");
$mhs1->kuliah();
$mhs1->ujian();
$mhs1->praktikum();
$mhs1->biodata();

$mhs2 = new Mahasiswa("67892", "Acong", "Sastra Mesin");
$mhs2->kuliah();
$mhs2->ujian();
$mhs2->praktikum();
$mhs2->biodata();
?>