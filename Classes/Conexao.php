<?php 

class Conexao{
    private $servidor;
    private $banco;
    private $usuario;
    private $senha;

    function __construct()
    {
        $this->servidor = "localhost"; // nome do servidor  // this significa class
        $this->banco = "mesadinha";
        $this->usuario = "root";
        $this->senha = "";
    }

    public function conectar(){
        try {
            $con = new PDO("mysql:host={$this->servidor}; dbname={$this->banco}; charset=utf8",$this->usuario,$this->senha);
            return $con;

        }catch (PDOException $msg){
            echo "Não foi possivel conectar com o banco de dados{$msg->getMessage()}";
        }
    }

}