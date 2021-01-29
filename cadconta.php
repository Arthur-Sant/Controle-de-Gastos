<?php
header("Content-type:text/html; charset=utf8");
session_start();

if(!isset($_SESSION["USUARIO_ID"])){
    header("location: index.php");
}

require_once "./Classes/Conta.php";
require_once "./Classes/Categoria.php";

$conta = new Conta();
$categoria = new Categoria();

$listarConta = $conta->listarTodos();
$listarCategoria = $categoria->listarTodos();

if(isset($_POST["cadastrar"])) {
    $conta->inserir();
}

if(isset($_GET["id"])) {
    $conta->excluir($_GET["id"]);
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
                        <h2>Cadastro de Contas</h2>
                        <form action="cadconta.php" method="post">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" name="nome" class="form-control" id="nome" required>
                        </div>
                        <div class="form-group">
                            <label for="tipo">Tipo</label>
                            <select name="tipo" id="tipo" class="form-control" required>
                              <option value="Receitas">Receitas</option>
                              <option value="Despesas">Despesas</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="categorias">Categoria</label>
                            <select name="categorias" id="categorias" class="form-control" required>
                                <option value="">Selecione uma opção</option>
                                <?php foreach ($listarCategoria as $categoria){?>
                                <option value="<?php echo $categoria->ID;?>"><?php echo $categoria->NOME;?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <button class="btn btn-outline-success" name="cadastrar" type="submit">Cadastrar</button>

                        <br><br>
                        </form>
                    </div>
                    </div>
                </div>
                <div class="col-4"></div>
            </div>
        </div>
    </div> 

    <br>
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Tipo</th>
              <th>Categoria</th>
                <th></th>
            </tr>
          </thead>
          <tbody id="tbody">
          <?php if($listarConta): ?>
          <?php foreach ($listarConta as $conta): ?>
            <tr>
              <td><?php echo $conta->NOME;?></td>
              <td><?php echo $conta->TIPO;?></td>
              <td><?php echo $conta->CATEGORIA;?></td>
              <td>
                  <a href="editarconta.php?id=<?php echo $conta->ID;?>" class="btn btn-outline-primary"><i class="fa fa-edit"></i></a>
                  <a href="cadconta.php?id=<?php echo $conta->ID;?>" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a>
              </td>
            </tr>
          <?php endforeach;?>
          <?php else: ?>
              <td colspan="4">Nenhuma conta cadastrada!!!</td>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
</body>
</html>