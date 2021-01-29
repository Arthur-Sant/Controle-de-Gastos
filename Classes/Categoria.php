<?php

require_once "Conexao.php";
class Categoria
{
    public $ID;
    public $NOME;

    public function listarTodos()
    {
        try {
            $bd = new Conexao();
            $con = $bd->conectar();
            $sql = $con->prepare("select * from categoria");
            $sql->execute();

            if ($sql->rowCount() > 0) {
                return $resultado = $sql->fetchAll(PDO::FETCH_CLASS);
            }
        }catch (PDOException $msg){
            echo "Não foi possivel listar actegorias {$msg->getMessage()}";
        }
    }

    public function inserir()
    {
        try {

            if(isset($_POST["nome"]) && !empty($_POST["nome"])){

                $this->NOME = $_POST["nome"];
                $this->TIPO = $_POST["tipo"];
                $this->CATEGORIA_ID = $_POST["categoria"];
                $this->USUARIO_ID = $_SESSION["USUARIO_ID"];

                $bd = new Conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("insert into categoria(id,nome)
                                      values(null,?)");
                $sql->execute(array($this->NOME));

                if ($sql->rowCount() > 0) {
                    header("location: cadcategoria.php");
                }
            }else{
                header("location: cadcategoria.php");
            }

        } catch (PDOException $msg) {
            echo "Não foi possivel inserir aluno {$msg->getMessage()}";
        }
    }

    public function excluir($id)
    {
        try {
            if(isset($id)){
                $this->ID = $id;

                $bd = new Conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("delete from categoria where id = ?");
                $sql->execute(array($this->ID));

                if ($sql->rowCount() > 0){
                    header("location: cadcategoria.php");
                }
            } else {
                header("location: cadcategoria.php");
            }
        } catch (PDOException $msg) {
            echo "Não foi possivel excluir a conta {$msg->getMessage()}";
        }
    }

    public function alterar()
    {
        try {
            if (isset($_POST["nome"])) {

                $this->NOME = $_POST["nome"];
                $this->ID = $_GET["id"];

                $bd = new Conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("update categoria set nome = ? where id = ?");
                $sql->execute(array(
                    $this->NOME,
                    $this->ID
                ));


                if ($sql->rowCount() > 0) {
                    header("location: cadcategoria.php");
                }
            } else {
                header("location: cadcategoria.php");
            }
        } catch (PDOException $msg) {
            echo "Não foi possivel alterar categoria. {$msg->getMessage()}";
        }
    }

    public function listarID($id)
    {
        try {
            $this->ID = $id;
            $bd = new Conexao();
            $con = $bd->conectar();
            $sql = $con->prepare("select * from categoria where id = ?");
            $sql->execute(array($this->ID));

            if ($sql->rowCount() > 0) {
                return $resultado = $sql->fetchObject();
            }
        } catch (PDOException $msg) {
            echo "Não foi possivel listar categoria. {$msg->getMessage()}";
        }
    }
}