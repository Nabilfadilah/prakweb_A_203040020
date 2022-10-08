<?php

class Mahasiswa_model
{

    // variabel
    private $dbh; // database handler
    private $stmt;

    // method 
    public function __construct()
    {
        // data source name
        $dsn = 'mysql:host=localhost;dbname=phpmvc';

        try {
            $this->dbh = new PDO($dsn, 'root', '');
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // private $mhs = [
    //     [
    //         "nama" => "Mohammad Nabil Fadilah",
    //         "nrp" => "203040020",
    //         "email" => "fadilah47@gmail.com",
    //         "jurusan" => "Teknik Informatika"
    //     ],

    //     [
    //         "nama" => "Ilham Herdianan",
    //         "nrp" => "203020046",
    //         "email" => "heridaN33@gmail.com",
    //         "jurusan" => "Teknik Industri"
    //     ],

    //     [
    //         "nama" => "Suehendi Atmojo",
    //         "nrp" => "203060123",
    //         "email" => "AtmojoHen7@gmail.com",
    //         "jurusan" => "Teknik Mesin"
    //     ]
    // ];

    // method 
    public function getAllMahasiswa()
    {
        // return $this->mhs;
        $this->stmt = $this->dbh->prepare('SELECT * FROM mahasiswa');
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
