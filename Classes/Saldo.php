<?php
session_start();

require_once "Conexao.php";
class Saldo
{

    public $VALOR_P;
    public $VALOR_N;
    public $ID;

    public function saldoPositivo()
    {
        try {

            $this->ID = $_SESSION["USUARIO_ID"];

            $bd = new Conexao();
            $con = $bd->conectar();
            $sql = $con->prepare("select sum(lancamento.valor) as VALOR_P from usuario 
                                           join conta on usuario.id = conta.usuario_id
                                           join lancamento on lancamento.conta_id = conta.id
                                           where usuario.id = ? and conta.tipo = 'Receitas';");
            $sql->execute(array($this->ID));

            if ($sql->rowCount() > 0) {
                return $resultado = $sql->fetchObject();
            }
        }catch (PDOException $msg){
            echo "Não foi possivel listar. {$msg->getMessage()}";
        }
    }

    public function saldoNegativo()
    {
        try {

            $this->ID = $_SESSION["USUARIO_ID"];

            $bd = new Conexao();
            $con = $bd->conectar();
            $sql = $con->prepare("select sum(lancamento.valor) as VALOR_N from usuario 
                                           join conta on usuario.id = conta.usuario_id
                                           join lancamento on lancamento.conta_id = conta.id
                                           where usuario.id = ? and conta.tipo = 'Despesas';");
            $sql->execute(array($this->ID));

            if ($sql->rowCount() > 0) {
                return $resultado = $sql->fetchObject();
            }
        }catch (PDOException $msg){
            echo "Não foi possivel listar. {$msg->getMessage()}";
        }
    }
}