<?php
header("Content-type:text/html; charset=utf8");

require_once "./Classes/Conta.php";
require_once "./Classes/Categoria.php";

$conta = new Conta();
$categoria = new Categoria();

$listarCategoria = $categoria->listarTodos();

if(isset($_GET["id"])) {
    $contas = $conta->listarID($_GET["id"]);
}else{
    header("location: cadconta.php");
}

if(isset($_POST["atualizar"])){
    $conta->alterar();
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
    <title>Contas</title>
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
                <a class="dropdown-item">Contas</a>
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
    <div style="text-align: center; margin-top: 150px;">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h2>Editar de Contas</h2>
                        <form action="editarconta.php?id=<?php echo $contas->ID?>" method="post">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" value="<?php echo $contas->NOME;?>" class="form-control" id="nome" required>
                            </div>
                            <div class="form-group">
                                <label for="tipo">Tipo</label>
                                <select name="tipo" id="tipo" class="form-control">
                                    <option value="Receitas" <?php if($contas->TIPO == "Receitas"){echo "selected";}?>>Receitas</option>
                                    <option value="Despesas" <?php if($contas->TIPO == "Despesas"){echo "selected";}?>>Despesas</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="categorias">Categoria</label>
                                <select name="categorias" id="categorias" class="form-control" required>
                                    <option value="">Selecione uma opção</option>
                                    <?php foreach ($listarCategoria as $categoria){?>
                                        <option value="<?php echo $categoria->ID;?>"  <?php if($contas->CATEGORIA_ID == $categoria->ID){echo "selected";}?>><?php echo $categoria->NOME;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <button class="btn btn-outline-info" name="atualizar" type="submit" id="atualizar" >Atualizar</button>
                            <a href="cadconta.php" class="btn btn-outline-danger">Voltar</a>

                            <br><br>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-4"></div>
        </div>
    </div>
</div>
</body>
</html>