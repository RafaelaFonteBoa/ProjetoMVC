<?php 

	class Postagens
	{
		
		public static function selecionaTodos(){
			$con = Connection::getConn();
			
			$sql = "SELECT * FROM postagem ORDER BY id DESC";
			$sql = $con->prepare($sql);
			$sql->execute();

			$resultado = array();

			while ($row = $sql->fetchObject('Postagens')) {
				$resultado[] = $row;
			}
			

			if (!$resultado) {
				throw new Exception("Nenhuma postagem foi encontrada!");
			}
			return $resultado;
			
		}
		public static function selecionaPorId($idPost){
			$con = Connection::getConn();

			$sql = $con->prepare("SELECT * FROM postagem WHERE id = :id");
			$sql->bindValue(":id", $idPost, PDO::PARAM_INT);
			$sql->execute();
			
			$resultado = $sql->fetchObject('Postagens');
			
			if (!$resultado) {
				throw new Exception("Nenhuma postagem foi encontrada!");
			} else{
				$resultado->comentario = Comentario::selectComent($resultado->id);
			}
			return $resultado;
		}
		public static function insert($dadosPost){
			if (empty($dadosPost['titulo']) OR empty($dadosPost['conteudo'])) {
				throw new Exception("Preencha todos os campos!");
				return false;
			}

			$con = Connection::getConn();

			$sql = $con->prepare("INSERT INTO postagem (titulo, conteudo) VALUES ( :t, :c)");
			$sql->bindValue(":t",$dadosPost['titulo']);
			$sql->bindValue(":c",$dadosPost['conteudo']);
			$res = $sql->execute();

			if ($res == 0) {
				throw new Exception("Falha ao inserir Publicação");
				return false;
			}
			return true;
		}
		public static function update($params){
			$con = Connection::getConn();

			$sql = $con->prepare("UPDATE postagem SET titulo = :t, conteudo = :c WHERE id = :id");
			$sql->bindValue(":t", $params['titulo']);
			$sql->bindValue(":c", $params['conteudo']);
			$sql->bindValue(":id", $params['id']);
			$resultado = $sql->execute();

			if ($resultado == 0) {
				throw new Exception("Falha ao alterar publicação!");
				return false;
				
			}
			return true;
		}
		public static function delete($IdPost){
			$con = Connection::getConn();

			$sql = $con->prepare("DELETE FROM postagem WHERE id = :id");
			$sql->bindValue(':id', $IdPost);
			$resultado = $sql->execute();

			if ($resultado == 0) {
				throw new Exception("Falha ao deletar publicação!");
				return false;
				
			}
			return true;
		}
	}
?>