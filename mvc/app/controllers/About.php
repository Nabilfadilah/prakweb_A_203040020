<?php

class About extends Controller
{
    public function index($nama = 'Nabil', $pekerjaan = 'Mahasiswa', $umur = 20) // index = method
    {
        // echo 'About/index';
        // echo "Hallo, nama saya $nama, saya adalah seorang $pekerjaan. saya berumur $umur tahun.";
        $data['nama'] = $nama;
        $data['pekerjaan'] = $pekerjaan;
        $data['umur'] = $umur;
        $data['judul'] = 'About Me';
        $this->view('templates/header', $data);
        $this->view('about/index', $data);
        $this->view('templates/footer');
    }

    public function page() // page = method
    {
        $data['judul'] = 'pages';
        $this->view('templates/header', $data);
        $this->view('about/page'); // controller about, method page
        $this->view('templates/footer');
    }
}
