<?php

namespace Config;

class ConfigView
{

    private $Nome;
    private $Dados;

    public function __construct($Nome, array $Dados = null)
    {
        $this->Nome = (string) $Nome;
        $this->Dados = $Dados;
    }

    public function renderizarPadrao()
    {
        if (file_exists('app/' . $this->Nome . '.php')) {
            echo '<!DOCTYPE html>
            <html lang="pt-br">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>AmigoPet</title>
            </head>';
            include 'app/' . $this->Nome . '.php';
            include 'public/includes/footer.php';
            echo '<script src="home.js?v=10"></script></body></html>';
        } else {
            echo "Erro ao carregar a Página: {$this->Nome}";
        }
    }

    public function renderizarLoginCadastro()
    {
        include 'app/amp/Views/include/cabecalho.php';
        if (file_exists('app/' . $this->Nome . '.php')) {
            include 'app/' . $this->Nome . '.php';
            include 'app/amp/Views/include/rodape.php';
        } else {
            echo "Erro ao carregar a Página: {$this->Nome}";
        }
    }
    public function renderizarLogadoUsuario()
    {
        if (file_exists('app/' . $this->Nome . '.php')) {
            include 'app/amp/Views/include/cabecalho.php';
            include 'app/amp/Views/include/menuLoginUsuario.php';
            include 'app/' . $this->Nome . '.php';
            include 'app/amp/Views/include/rodape.php';
        } else {
            echo "Erro ao carregar a Página: {$this->Nome}";
        }
    }

    public function renderizarLogadoVeterinario()
    {
        if (file_exists('app/' . $this->Nome . '.php')) {
            include 'app/amp/Views/include/cabecalho.php';
            include 'app/amp/Views/include/menuLoginVeterinario.php';
            include 'app/' . $this->Nome . '.php';
            include 'app/amp/Views/include/rodape.php';
        } else {
            echo "Erro ao carregar a Página: {$this->Nome}";
        }
    }
}
