<?php
/**
 *
 */
class HomeController
{
    public function index()
    {
        try {
            $colecPostagens = Postagens::selecionaTodos(); //conexão com banco e coleta de todas as postagens no BD como objetos//

            $loader = new \Twig\Loader\FilesystemLoader('app/view'); //caminho do nosso template
            $twig = new \Twig\Environment($loader); //objeto ENVIRONMENT do twig vai carregar nosso template
            $template = $twig->load('home.html'); //e vai rodar nosso template

            $parametros = array();
            $parametros['postagens'] = $colecPostagens;

            $conteudo = $template->render($parametros); //renderização do template com os parametros

            echo $conteudo;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
