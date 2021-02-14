<?php 
	require_once"app/core/core.php";

	require_once"app/lib/Database/conecta.php";

	require_once"app/controller/homeController.php";
	require_once"app/controller/ErroController.php";
	require_once"app/controller/PostController.php";
	require_once"app/controller/SobreController.php";
	require_once"app/controller/AdminController.php";

	require_once"app/model/postagens.php";
	require_once"app/model/comentario.php";
	
	require_once"vendor/autoload.php";
	
	$template = file_get_contents('app/template/estrutura.html');
	ob_start();
		$core = new Core;
		$core->start($_GET);
		$saida = ob_get_contents();
	ob_end_clean();

	$tplpronto = str_replace("{{area_dinamica}}",$saida, $template);
	
	//str_replace(search, replace, subject)
	echo $tplpronto;

?>