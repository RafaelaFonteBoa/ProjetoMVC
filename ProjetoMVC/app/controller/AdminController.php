<?php 
	/**
	 * 
	 */
	class AdminController
	{
		
		public function index(){


				$loader = new \Twig\Loader\FilesystemLoader('app/view'); //caminho do nosso template
				$twig = new \Twig\Environment($loader); //objeto ENVIRONMENT do twig vai carregar nosso template
				$template = $twig->load('admin.html'); //e vai rodar nosso template

				$objPostagens = Postagens::selecionaTodos();

				$parametros = array();
				$parametros['postagens'] = $objPostagens;

				$conteudo = $template->render($parametros); //renderização do template com os parametros

				echo $conteudo; 
		}
		public function create(){


				$loader = new \Twig\Loader\FilesystemLoader('app/view'); //caminho do nosso template
				$twig = new \Twig\Environment($loader); //objeto ENVIRONMENT do twig vai carregar nosso template
				$template = $twig->load('create.html'); //e vai rodar nosso template

				$parametros = array();

				$conteudo = $template->render($parametros); //renderização do template com os parametros

				echo $conteudo; 
		}
		public function insert(){
			try{
				Postagens::insert($_POST);
				echo '<script>alert("Publicação inserida com sucesso!");</script>';
				echo '<script>location.href="/ProjetoMVC/?pagina=admin&metodo=index";</script>';
				
			}catch(Exception $e){
				echo '<script>alert("'.$e->getMessage().'");</script>';
				echo '<script>location.href="/ProjetoMVC/?pagina=admin&metodo=create";</script>';

			}
			
		}
		public function change($idPost){
			$loader = new \Twig\Loader\FilesystemLoader('app/view'); //caminho do nosso template
				$twig = new \Twig\Environment($loader); //objeto ENVIRONMENT do twig vai carregar nosso template
				$template = $twig->load('update.html'); //e vai rodar nosso template

				$post = Postagens::selecionaPorId($idPost);

				$parametros = array();
				$parametros['id'] = $post->id ;
				$parametros['titulo'] = $post->titulo ; 
				$parametros['conteudo'] = $post->conteudo ; 

				$conteudo = $template->render($parametros); //renderização do template com os parametros

				echo $conteudo; 
		}
		public function update(){
			try{
				Postagens::update($_POST);
				echo '<script>alert("Publicação alterada com sucesso!");</script>';
				echo '<script>location.href="/ProjetoMVC/?pagina=admin&metodo=index";</script>';
			}catch(Exception $e){
				echo '<script>alert("'.$e->getMessage().'");</script>';
				echo '<script>location.href="/ProjetoMVC/?pagina=admin&metodo=change&id='.$_POST['id'].'";</script>';
			}
			
		}
		public function delete($paramId){
			
			try {
				Postagens::delete($paramId);
				echo '<script>alert("Publicação deletada com sucesso!");</script>';
				echo '<script>location.href="/ProjetoMVC/?pagina=admin&metodo=index";</script>';
			}catch(Exception $e){
				echo '<script>alert("'.$e->getMessage().'");</script>';
				echo '<script>location.href="/ProjetoMVC/?pagina=admin&metodo=index";</script>';
			}
		}
	}
?>