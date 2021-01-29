<?php

require_once "Conexao.php";
session_start();

class Usuario
{
    public $SEXO;
    public $EMAIL;
    public $ID;
    public $NOME;
    public $ENDERECO;
    public $TELEFONE;
    public $SENHA;

    public function senha(){
        try{
            $this->ID = $_SESSION["USUARIO_ID"];

            $bd = new Conexao();
            $con = $bd->conectar();
            $sql = $con->prepare("select SENHA from usuario where id = ?");
            $sql->execute(array($this->ID));

            if($sql->rowCount() > 0) {
                return $resultado = $sql->fetchObject();

            }
        }catch (PDOException $msg){
            echo "Não foi possivel listar senha {$msg->getMessage()}";
        }
    }

    public function inserir()
    {
        try {
            $senha = $_POST["senha"];
            $csenha = $_POST["csenha"];

            if($senha == $csenha){
                $this->NOME = $_POST["nome"];
                $this->SEXO = $_POST["sexo"];
                $this->EMAIL = $_POST["email"];
                $this->ENDERECO = $_POST["endereco"];
                $this->TELEFONE = $_POST["telefone"];
                $this->SENHA = $_POST["senha"];

                $bd = new Conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("insert into usuario(id,nome,sexo,email,endereco,telefone,senha)
                                      values(null,?,?,?,?,?,?)");
                $sql->execute(array(
                    $this->NOME,
                    $this->SEXO,
                    $this->EMAIL,
                    $this->ENDERECO,
                    $this->TELEFONE,
                    $this->SENHA
                ));

                if ($sql->rowCount() > 0) {
                    echo "<script>
                    window.location.href = 'index.php';
                    alert('Usuário cadastrado com sucesso!!!');
                  </script>";
                } else {
                    header("location: Cadastro.php");
                }
            }else{
                echo "<script>
                alert('as senhas nao coicidem');
                window.location.href = 'Cadastro.php';
                </script>";
            }

        } catch (PDOException $msg) {
            echo "Não foi possivel inserir aluno {$msg->getMessage()}";
        }
    }

    public function excluir()
    {
        try {
            if (isset($_POST["email"]) && !empty($_POST["email"]) &&
            isset($_POST["senha"]) && !empty($_POST["senha"])){

                $this->ID = $_SESSION["USUARIO_ID"];
                $this->EMAIL = $_POST["email"];
                $this->SENHA = $_POST["senha"];
                $bd = new Conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("delete from usuario where id = ? and email = ? and senha = ?");
                $sql->execute(array($this->ID,$this->EMAIL, $this->SENHA));

                if ($sql->rowCount() > 0) {
                    session_unset();
                    session_destroy();
                    echo "<script>
window.location.href = 'index.php';
alert('Usuário excluido com sucesso!!!');
</script>";
                }else{
                    echo "<script>
window.location.href = 'excluir.php';
alert('Email ou senha errado!!!');
</script>";
                }
            } else {
                header("location: excluir.php");
            }
        } catch (PDOException $msg) {
            echo "Não foi possivel excluir o usuario {$msg->getMessage()}";
        }
    }

    public function alterar()
    {
        try {
            if (isset($_POST["nsenha"])) {

                $this->SENHA = $_POST["nsenha"];
                $this->ID = $_SESSION["USUARIO_ID"];

                $bd = new Conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("update usuario set senha = ? where id = ?");
                $sql->execute(array($this->SENHA, $this->ID));


                if ($sql->rowCount() > 0) {
                    echo "<script>
window.location.href = 'menu.php';
alert('Senha atualizado com sucesso!!!')
</script>";
                }

            } else if (isset($_POST["nome"]) && isset($_POST["sexo"]) &&
                isset($_POST["telefone"]) && isset($_POST["endereco"])) {

                $this->NOME = $_POST["nome"];
                $this->SEXO = $_POST["sexo"];
                $this->TELEFONE = $_POST["telefone"];
                $this->ENDERECO = $_POST["endereco"];
                $this->ID = $_SESSION["USUARIO_ID"];

                $bd = new Conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("update usuario set nome = ?, sexo = ?, endereco = ?, telefone = ? where id = ?");
                $sql->execute(array(
                    $this->NOME,
                    $this->SEXO,
                    $this->ENDERECO,
                    $this->TELEFONE,
                    $this->ID
                ));


                if ($sql->rowCount() > 0) {
                    echo "<script>
window.location.href = 'menu.php';
alert('Dados atualizado com sucesso!!!')
</script>";
                }
            }
            }catch
            (PDOException $msg) {
                echo "Não foi possivel atualizar usuario. {$msg->getMessage()}";
            }
    }

    public function listarID()
    {
        try {
            $this->ID = $_SESSION["USUARIO_ID"];
            $bd = new Conexao();
            $con = $bd->conectar();
            $sql = $con->prepare("select * from usuario where id = ?");
            $sql->execute(array($this->ID));

            if ($sql->rowCount() > 0) {
                return $resultado = $sql->fetchObject();
            }
        } catch (PDOException $msg) {
            echo "Não foi possivel listar usuario. {$msg->getMessage()}";
        }
    }


    public function login()
    {
        try {

            if (isset($_POST["email"]) && !empty($_POST["email"]) &&
                isset($_POST["senha"]) && !empty($_POST["senha"])) {

                $this->EMAIL = $_POST["email"];
                $this->SENHA = $_POST["senha"];

                $bd = new Conexao();
                $con = $bd->conectar();
                $sql = $con->prepare("select * from usuario where email = ? and senha = ?");
                $sql->execute(array($this->EMAIL, $this->SENHA));

                if ($sql->rowCount() > 0) {
                    $resultado = $sql->fetchObject();
                    $_SESSION["USUARIO_ID"] = $resultado->ID;

                    echo "<script>
                             window.location.href = 'menu.php';
                             alert('Bem vindo {$resultado->NOME}');
                           </script>";
                } else {
                    echo "<script>
                          alert('Email ou senha inválido!!!');
                          window.location.href = 'index.php';
                          </script>";
                }

            } else {
                header("location:index.php");
            }

        } catch (PDOException $msg) {
            echo "Não foi possivel fazer o login";
        }
    }
}