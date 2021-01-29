<?php
header("Content-type:text/html; charset=utf8");

require_once "./Classes/Categoria.php";

$categoria = new Categoria();

if(isset($_GET["id"])) {
    $categorias = $categoria->listarID($_GET["id"]);
}else{
    header("location: cadcategoria.php");
}

if(isset($_POST["atualizar"])){
    $categoria->alterar();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <title>Categorias</title>
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
                <a class="dropdown-item">Categorias</a>
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
<div class="col-12">
    <div style="text-align: center; margin-top: 100px;">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <form action="editarcategoria.php?id=<?php echo $categorias->ID;?>" method="post">
                            <h2>Editar Categoria</h2>
                            <br>
                            <label>Nome:</label>
                            <br>
                            <input id="nome" name="nome" type="text" class="form-control" required value="<?php echo $categorias->NOME;?>">
                            <br><br>
                            <button class="btn btn-outline-info" name="atualizar" type="submit">Atualizar</button>
                            <a href="cadcategoria.php" class="btn btn-outline-danger">Voltar</a>
                        </form>
                        <br><br>
                    </div>
                </div>
            </div>
            <div class="col-4"></div>
        </div>
    </div>
</div>
</body>
</html>
