<?php

class Home extends Controller
{
    // Method
    public function index()
    {
        // echo 'home/index';
        $data['judul'] = 'Home';
        $this->view('templates/header', $data);
        $this->view('home/index');
        $this->view('templates/footer');
    }
}
