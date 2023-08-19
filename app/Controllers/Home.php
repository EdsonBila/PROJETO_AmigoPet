<?php

namespace App\Controllers;

if (!defined('URL')) {
    header("Location:  /");
    exit();
}

class Home
{

    private $Dados;

    public function index()
    {

        $carregarView = new \Config\ConfigView('Views/home/home');
        $carregarView->renderizarPadrao();
    }
}
