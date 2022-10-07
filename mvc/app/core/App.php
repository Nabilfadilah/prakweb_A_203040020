<?php

class App
{
    public function __construct()
    {
        $url = $this->parseURL();
        var_dump($url);
    }

    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/'); // rtrim = untuk menghilangkan '/'
            $url = filter_var($url, FILTER_SANITIZE_URL); // membersihkan url-url yang ngaco atau memungkinkan karakter kita di hack
            $url = explode('/', $url); // explode(delimiter, String) memecah url dengan fungsi explode
            return $url;
        }
    }
}
