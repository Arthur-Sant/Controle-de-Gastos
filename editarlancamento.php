<?php
header("Content-type:text/html; charset=utf8");


require_once "./Classes/Lancamento.php";
require_once "./Classes/Conta.php";

if(!isset($_SESSION["USUARIO_ID"])){
    header("location: index.php");
}

$lancamento = new Lancamento();
$conta = new Conta();

$listarConta = $conta->listarTodos();

if(isset($_POST["atualizar"])){
    $lancamento->alterar();
}

if(isset($_GET["id"])){
    $lancamentos = $lancamento->listarID($_GET["id"]);
}else{
    header("location: cadlancamento.php");
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

        <title>Controle Financeiro</title>
    </head>
    <body style="background-color: #F4FAFF;">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Controle Financeiro</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="menu.php">Home</a>
            </li>
            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                Gerenciar Dados
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="editar.php">Alterar senha</a>
                    <a class="dropdown-item" href="editardados.php">Alterar Dados</a>
                    <a class="dropdown-item" href="excluir.php">Excluir Usuario</a>
                </div>
            </li>
            <li class="nav-item dropdown active">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    Cadastro
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="cadcategoria.php">Categorias</a>
                    <a class="dropdown-item" href="cadconta.php">Contas</a>
                </div>
            </li>
            <li class="nav-item active">
                <a class="nav-link">Lançamentos</a>
            </li>
            <li class="nav-item active">
                <a href="sair.php" class="nav-link">Sair</a>
            </li>
        </ul>
    </nav>
    <br><br>

    <div style="display: flex;justify-content: center; align-items: center">
        <div class="col-6">
            <div style="text-align: center; margin-top: 150px;">

                <div class="row">
                    <div class="col-10">
                        <div class="card">
                            <div class="card-body">
                                <h2>Editar Lançamento</h2>
                                <br>
                                <form action="editarlancamento.php?id=<?php echo $lancamentos->ID;?>" method="post">
                                <div class="form-group">
                                    <label for="contas">Conta</label>
                                    <select name="contas" id="contas" class="form-control" required>
                                        <option value="">Selecione uma opção</option>
                                        <?php foreach ($listarConta as $conta){?>
                                            <option value="<?php echo $conta->ID;?>"  <?php if($lancamentos->CONTA_ID == $conta->ID){echo "selected";}?>><?php echo $conta->NOME;?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Valor</label>
                                    <input type="number" name="valor" class="form-control" value="<?php echo $lancamentos->VALOR;?>" id="valorlancamentos" step="any" required>
                                </div>
                                <div class="form-group">
                                    <label for="data">Data</label>
                                    <input type="date" class="form-control" value="<?php $lancamentos->DATA;?>" name="data" id="data" required>
                                </div>
                                <button class="btn btn-outline-success" name="atualizar" type="submit" >Atualizar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>
