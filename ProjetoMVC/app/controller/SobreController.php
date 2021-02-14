<?php 
	/**
	 * 
	 */
	class SobreController
	{
		
		public function index(){


				$loader = new \Twig\Loader\FilesystemLoader('app/view'); //caminho do nosso template
				$twig = new \Twig\Environment($loader); //objeto ENVIRONMENT do twig vai carregar nosso template
				$template = $twig->load('sobre.html'); //e vai rodar nosso template

				$parametros = array();

				$conteudo = $template->render($parametros); //renderização do template com os parametros

				echo $conteudo; 
		}
	}
?>