<?php
/**
 *
 */
class PostController
{
    public function index($params)
    {
        try {
            $postagem = Postagens::selecionaPorId($params);

            $loader = new \Twig\Loader\FilesystemLoader('app/view'); //caminho do nosso template
            $twig = new \Twig\Environment($loader); //objeto ENVIRONMENT do twig vai carregar nosso template
            $template = $twig->load('single.html'); //e vai rodar nosso template

            $parametros = array();
            $parametros['titulo'] = $postagem->titulo;
            $parametros['conteudo'] = $postagem->conteudo;
            $parametros['comentario'] = $postagem->comentario;
            $parametros['id'] = $postagem->id;

            $conteudo = $template->render($parametros); //renderização do template com os parametros

            echo $conteudo;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function addComent()
    {
        try {
            Comentario::insert($_POST);
            header('Location: /ProjetoMVC/?pagina=post&id=' . $_POST['id'] . '');
        } catch (Exception $e) {
            echo '<script>alert("' . $e->getMessage() . '");</script>';
            echo '<script>location.href="/ProjetoMVC/?pagina=post&id=' . $_POST['id'] . '";</script>';
        }
    }
}
