<?php
header("Content-type:text/html; charset=utf8");

require_once "./Classes/Usuario.php";

if(!isset($_SESSION["USUARIO_ID"])){
    header("location: index.php");
}

$usuario = new Usuario();
if(isset($_POST["excluir"])){
    $usuario->excluir();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <title>Alterar Dados</title>
</head>
<header>
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
                    <a class="dropdown-item" href="editar.php">Alterar Senha</a>
                    <a class="dropdown-item" href="editardados.php">Alterar Dados</a>
                    <a class="dropdown-item">Excluir Usuário</a>
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
                <a class="nav-link" href="cadlancamento.php">Lançamentos</a>
            </li>
            <li class="nav-item active">
                <a href="sair.php" class="nav-link">Sair</a>
            </li>
        </ul>
    </nav>
</header>

<body style="background-color: #F4FAFF;">


<div class="col-md-12" style="text-align: center;">
    <div class="row">
        <div class="col-md-4" style="text-align: center;"></div>
        <div class="col-md-4" style="text-align: center;
            margin-top: 250px;
            background-color: #ADBABD;
            border-radius: 17px;
            padding-bottom: 15px;
            padding-top: 15px;">

            <h2>Conta</h2>
            <form action="excluir.php" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" id="email" required>
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="text" name="senha" class="form-control" id="senha" required>
                </div>
                <div>
                    <button class="btn btn-danger" name="excluir" type="submit" >Excluir</button>
                </div>
            </form>
        </div>

    </div>
    <div class="col-md-4" style="text-align: center;">
    </div>
</div>
</body>
</html>
