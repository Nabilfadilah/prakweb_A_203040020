<?php

class App
{
    // property
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();

        // controller
        if ($url == NULL) {
            $url = [$this->controller];
        }

        // controller
        if (file_exists('../app/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // method 
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // params 
        if (!empty($url)) {
            $this->params = array_values($url);
            // var_dump($url);
        }

        // jalankan controller & method, serta kirimkan params jika ada
        call_user_func_array([$this->controller, $this->method], $this->params);
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
