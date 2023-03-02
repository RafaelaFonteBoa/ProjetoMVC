<?php

class Comentario
{
    public static function selectComent($idPost)
    {
        $con = Connection::getConn();

        $sql = $con->prepare("SELECT * FROM comentario WHERE id_postagem = :id");
        $sql->bindValue(":id", $idPost, PDO::PARAM_INT);
        $sql->execute();

        $resultado = array();

        while ($row = $sql->fetchObject("Comentario")) {
            $resultado[] = $row;
        }
        return $resultado;
    }

    public static function insert($reqPost)
    {
        $con = Connection::getConn();

        $sql = $con->prepare("INSERT INTO comentario (nome, comentario, id_postagem) VALUES (:n, :m, :id) ");
        $sql->bindValue(":id", $reqPost['id']);
        $sql->bindValue(":n", $reqPost['nome']);
        $sql->bindValue(":m", $reqPost['comentario']);
        $sql->execute();

        if ($sql->rowCount()) {
            return true;
        } else {
            throw new Exception("Falha na inserção do comentário!");
        }

    }
}
