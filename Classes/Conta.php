<?php

require_once "Conexao.php";
class Conta
{
    public $ID;
    public $NOME;
    public $TIPO;
    public $CATEGORIA_ID;
    public $USUARIO_ID;

    public function listarTodos(){
        try{
            $bd = new Conexao();
            $con = $bd->conectar();
            $sql = $con->prepare("select conta.ID, conta.NOME, conta.TIPO, categoria.nome as CATEGORIA from conta
                                           join categoria on categoria.id = conta.categoria_id");
            $sql->execute();

            if($sql->rowCount() > 0){
                return $resultado = $sql->fetchAll(PDO::FETCH_CLASS);
            }

        }catch (PDOException $msg){
            echo "Não foi possível listar contas {$msg->getMessage()}";
        }
    }

    public function inserir()
    {
        try {

            if(isset($_POST["nome"]) && !empty($_POST["nome"]) &&
            isset($_POST["tipo"]) && !empty($_POST["tipo"])) {

                $this->NOME = $_POST["nome"];
                $this->TIPO = $_POST["tipo"];
                $this->CATEGORIA_ID = $_POST["categorias"];
                $this->USUARIO_ID = $_SESSION["USUARIO_ID"];

                $bd = new Conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("insert into conta(id,nome,tipo,categoria_id,usuario_id)
                                      values(null,?,?,?,?)");
                $sql->execute(array(
                    $this->NOME,
                    $this->TIPO,
                    $this->CATEGORIA_ID,
                    $this->USUARIO_ID
                ));

                if ($sql->rowCount() > 0) {
                    header("location: cadconta.php");
                }
            }else{
                header("location: cadconta.php");
            }

        } catch (PDOException $msg) {
            echo "Não foi possivel inserir aluno {$msg->getMessage()}";
        }
    }

    public function excluir($id)
    {
        try {
            if (isset($id)) {
                $this->ID = $id;

                $bd = new Conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("delete from conta where id = ?");
                $sql->execute(array($this->ID));

                if ($sql->rowCount() > 0) {
                    header("location: cadconta.php");
                }
            } else {
                header("location: cadconta.php");
            }
        } catch (PDOException $msg) {
            echo "Não foi possivel excluir a conta {$msg->getMessage()}";
        }
    }

    public function alterar(){

        try {
            if (isset($_POST["nome"]) && !empty($_POST["nome"]) &&
            isset($_POST["tipo"]) && !empty($_POST["tipo"]) &&
            isset($_POST["categorias"]) && !empty($_POST["categorias"])){

                $this->ID = $_GET["id"];
                $this->NOME = $_POST["nome"];
                $this->TIPO = $_POST["tipo"];
                $this->CATEGORIA_ID = $_POST["categorias"];

                $bd = new Conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("update conta set nome = ?, tipo = ?, categoria_id = ? where id = ?");
                $sql->execute(array(
                    $this->NOME,
                    $this->TIPO,
                    $this->CATEGORIA_ID,
                    $this->ID
                ));

                if ($sql->rowCount() > 0) {
                    header("location: cadconta.php");
                }

            } else {
                header("location: cadconta.php");
            }
        } catch (PDOException $msg) {
            echo "Não foi possivel alterar conta. {$msg->getMessage()}";
        }
    }

    public function listarID($id)
    {
        try {
            $this->ID = $id;
            $bd = new Conexao();
            $con = $bd->conectar();
            $sql = $con->prepare("select * from conta where id = ?");
            $sql->execute(array($this->ID));

            if ($sql->rowCount() > 0) {
                return $resultado = $sql->fetchObject();
            }
        } catch (PDOException $msg) {
            echo "Não foi possivel listar conta. {$msg->getMessage()}";
        }
    }
}