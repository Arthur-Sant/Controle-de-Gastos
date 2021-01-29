<?php

require_once "Conexao.php";
class Lancamento
{
   public $ID;
   public $VALOR;
   public $DATA;
   public $CONTA_ID;

    public function listarTodos(){
        try{
            $bd = new Conexao();
            $con = $bd->conectar();
            $sql = $con->prepare("select lancamento.ID,lancamento.VALOR, lancamento.DATA, conta.nome as CONTA from lancamento
                                           join conta on lancamento.conta_id = conta.id");
            $sql->execute();

            if($sql->rowCount() > 0){
                return $resultado = $sql->fetchAll(PDO::FETCH_CLASS);
            }

        }catch (PDOException $msg){
            echo "Não foi possível listar lançamento {$msg->getMessage()}";
        }
    }

    public function inserir()
    {
        try {

            if(isset($_POST["valor"]) && !empty($_POST["valor"]) &&
                isset($_POST["data"]) && !empty($_POST["data"])  &&
                isset($_POST["contas"]) && !empty($_POST["contas"])) {

                $this->VALOR = $_POST["valor"];
                $this->DATA = $_POST["data"];
                $this->CONTA_ID = $_POST["contas"];

                $bd = new Conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("insert into lancamento(id,valor,data,conta_id)
                                      values(null,?,?,?)");
                $sql->execute(array(
                    $this->VALOR,
                    $this->DATA,
                    $this->CONTA_ID
                ));

                if ($sql->rowCount() > 0) {
                    header("location: cadlancamento.php");
                }
            }else{
                header("location: cadlancamento.php");
            }

        } catch (PDOException $msg) {
            echo "Não foi possivel inserir lançamento {$msg->getMessage()}";
        }
    }

    public function excluir($id)
    {
        try {
            if (isset($id)) {
                $this->ID = $id;

                $bd = new Conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("delete from lancamento where id = ?");
                $sql->execute(array($this->ID));

                if ($sql->rowCount() > 0) {
                    header("location: cadlancamento.php");
                }
            } else {
                header("location: cadlancamento.php");
            }
        } catch (PDOException $msg) {
            echo "Não foi possivel excluir a lançamento {$msg->getMessage()}";
        }
    }

    public function alterar(){

        try {
            if (isset($_POST["valor"]) && !empty($_POST["valor"]) &&
                isset($_POST["data"]) && !empty($_POST["data"]) &&
                isset($_POST["contas"]) && !empty($_POST["contas"])){

                $this->ID = $_GET["id"];
                $this->VALOR = $_POST["valor"];
                $this->DATA = $_POST["data"];
                $this->CONTA_ID = $_POST["contas"];

                $bd = new Conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("update lancamento set valor = ?, data = ?, conta_id = ? where id = ?");
                $sql->execute(array(
                    $this->VALOR,
                    $this->DATA,
                    $this->CONTA_ID,
                    $this->ID
                ));

                if ($sql->rowCount() > 0) {
                    header("location: cadlancamento.php");
                }

            } else {
                header("location: cadlancamento.php");
            }
        } catch (PDOException $msg) {
            echo "Não foi possivel alterar lançamento. {$msg->getMessage()}";
        }
    }

    public function listarID($id)
    {
        try {
            $this->ID = $id;
            $bd = new Conexao();
            $con = $bd->conectar();
            $sql = $con->prepare("select * from lancamento where id = ?");
            $sql->execute(array($this->ID));

            if ($sql->rowCount() > 0) {
                return $resultado = $sql->fetchObject();
            }
        } catch (PDOException $msg) {
            echo "Não foi possivel listar lancamento. {$msg->getMessage()}";
        }
    }
}