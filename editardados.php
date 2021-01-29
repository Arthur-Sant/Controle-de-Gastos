<?php
header("Content-type:text/html; charset=utf8");

require_once "./Classes/Usuario.php";

if(!isset($_SESSION["USUARIO_ID"])){
    header("location: index.php");
}

$usuario = new Usuario();

$usuarios = $usuario->listarID();

if(isset($_POST["atualizar"])) {
    $usuario->alterar();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./Style/bootstrap.min.css">
    <link rel="stylesheet" href="./Style/main2.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" />
    <link rel="stylesheet" href="Style/main.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="./js/Mask.Js"></script>
    <link rel="stylesheet" href="Style/util.css" />
    <title>Cadastro</title>
</head>

<body>
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
                <a class="dropdown-item">Alterar Dados</a>
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
            <a class="nav-link" href="cadlancamento.php">Lançamentos</a>
        </li>
        <li class="nav-item active">
            <a href="sair.php" class="nav-link">Sair</a>
        </li>
    </ul>
</nav>
<div class="main" style="background-color: #535657;">
    <div class="container lista" style="
    border-radius: 17px;
    margin-top: -50px;">
        <div id="h1">
            <h1 class="text-center">Alterar Dados</h1>
        </div>
        <form action="editardados.php" method="post">
            <div class="row">
                <div class="form-group col-lg-5">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" value="<?php echo $usuarios->NOME;?>" required>
                </div>
                <div class="form-group col-lg-3">
                    <label for="sexo">Sexo</label>
                    <select name="sexo" id="sexo" class="form-control" required>
                        <option value="">Escolha um opção</option>
                        <option value="M" <?php if($usuarios->SEXO == "M"){ echo "selected";}?>>Masculino</option>
                        <option value="F" <?php if($usuarios->SEXO == "F"){ echo "selected";}?>>Feminino</option>
                        <option value="O" <?php if($usuarios->SEXO == "O"){ echo "selected";}?>>Outro</option>
                        <option value="N" <?php if($usuarios->SEXO == "N"){ echo "selected";}?>>Não declarar</option>
                    </select>
                </div>
                <div class="form-group col-lg-4">
                    <label for="telefone">Telefone</label>
                    <input type="tel" name="telefone" id="telefone" class="form-control"  maxlength="14" oninput="mascara_telefone()" value="<?php echo $usuarios->TELEFONE;?>" required>
                </div>
                <div class="form-group col-lg-8">
                    <label for="endereco">Endereço</label>
                    <input type="text" name="endereco" id="endereco" class="form-control"  value="<?php echo $usuarios->ENDERECO;?>" required>
                </div>
                <div class="col-lg-4 d-flex align-items-center justify-content-center">
                    <button type="submit" name="atualizar" class="btn btn-outline-success m-2">Atualizar</button>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>
