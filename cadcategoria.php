<?php
header("Content-type:text/html; charset=utf8");
session_start();

require_once "./Classes/Categoria.php";
if(!isset( $_SESSION["USUARIO_ID"])){
    header("location: index.php");
}

$categoria = new Categoria();
$listar = $categoria->listarTodos();

if(isset($_POST["cadastrar"])){
    $categoria->inserir();
}

if(isset($_GET["id"])){
    $categoria->excluir($_GET["id"]);
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
                            <form action="cadcategoria.php" method="post">
                            <h2>Cadastro de Categorias</h2>
                                <br>
                            <label>Nome:</label>
                            <br>
                            <input id="nome" name="nome" type="text" class="form-control" required>
                            <br><br>
                            <button class="btn btn-outline-success" name="cadastrar" type="submit">Cadastrar</button>
                            </form>
                            <br><br>
                        </div>
                    </div>
                </div>
                <div class="col-4"></div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <tr>
                        <?php if($listar): ?>
                        <?php foreach ($listar as $categoria): ?>
                    <tr>
                        <td><?php echo $categoria->NOME?></td>
                        <td>
                            <a href="editarcategoria.php?id=<?php echo $categoria->ID;?>" class="btn btn-outline-primary"><i class="fa fa-edit"></i></a>
                            <a href="cadcategoria.php?id=<?php echo $categoria->ID;?>" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <td colspan="2">Nenhuma categoria cadastrada!!!</td>
                    <?php endif; ?>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-1"></div>
    </div>
</body>
</html>