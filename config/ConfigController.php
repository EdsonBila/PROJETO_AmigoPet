<?php

namespace Config;

class ConfigController
{

    private $Url;
    private $UrlConjunto;
    private $UrlController;
    private $UrlMetodo;
    private $UrlParametro;
    private $Classe;
    private static $Format;

    public function __construct()
    {
        $this->Url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT) ?? '';
        $this->limparUrl();
        $this->UrlConjunto = explode("/", $this->Url);
        $this->UrlController = $this->slugController($this->getUrlPart(0) == null || $this->Url == '' ? CONTROLER : $this->getUrlPart(0));
        $this->UrlMetodo = $this->slugMetodo($this->getUrlPart(1) == null || $this->Url == '' ? METODO : $this->getUrlPart(1));
        $this->UrlParametro = $this->getUrlPart(2);
    }

    private function getUrlPart($index)
    {
        return $this->UrlConjunto[$index] ?? null;
    }

    private function limparUrl()
    {
        $this->Url = strip_tags(trim(rtrim($this->Url, "/")));
        self::$Format = [
            'a' => 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ',
            'b' => 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr--------------------------------'
        ];
        $this->Url = strtr(iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $this->Url), self::$Format['a'], self::$Format['b']);

    }

    public function slugController($SlugController)
    {
        return str_replace(" ", "", ucwords(implode(" ", explode("-", strtolower($SlugController)))));
    }

    public function slugMetodo($SlugMetodo)
    {
        return lcfirst(str_replace(" ", "", ucwords(implode(" ", explode("-", strtolower($SlugMetodo))))));
    }

    public function carregar()
    {
        $this->Classe = "\\App\\Controllers\\" . $this->UrlController;
        if (!class_exists($this->Classe)) {
            $this->UrlController = $this->slugController(CONTROLER);
            $this->UrlMetodo = $this->slugMetodo(METODO);
        }
        $this->carregarMetodo();
    }

    private function carregarMetodo()
    {
        $classeCarregar = new $this->Classe;
        if (method_exists($classeCarregar, $this->UrlMetodo)) {
            $this->UrlParametro !== null ? $classeCarregar->{$this->UrlMetodo}($this->UrlParametro) : $classeCarregar->{$this->UrlMetodo}();
        } else {
            $this->UrlController = $this->slugController(CONTROLER);
            $this->UrlMetodo = $this->slugMetodo(METODO);
            $this->carregar();
        }
    }
}
