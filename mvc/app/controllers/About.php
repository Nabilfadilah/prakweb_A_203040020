<?php

class About
{
    public function index($nama = 'Nabil', $pekerjaan = 'Mahasiswa')
    {
        // echo 'About/index';
        echo "Hallo, nama saya $nama, saya adalah seorang $pekerjaan";
    }

    public function page()
    {
        echo 'About/page'; // controller about, method page
    }
}
