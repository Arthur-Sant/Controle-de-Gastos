<?php
header("Content-type:text/html; charset=utf8");

require_once "./Classes/Usuario.php";

$usuario = new Usuario();

if(isset($_POST["registrar"])) {
    $usuario->inserir();
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
    <link rel="stylesheet" href="Style/util.css" />
  <title>Cadastro</title>
</head>

<body>
  <div class="main" style="background-color: #535657;">
    <div class="container lista" style="
    border-radius: 17px;
    margin-top: -50px;">
        <div id="h1">
      <h1 class="text-center">Cadastro de Usuário</h1>
        </div>
      <form action="Cadastro.php" method="post">
        <div class="row">
          <div class="form-group col-lg-5">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
          </div>
          <div class="form-group col-lg-3">
            <label for="sexo">Sexo</label>
            <select name="sexo" id="sexo" class="form-control" required>
              <option value="">Escolha um opção</option>
              <option value="M">Masculino</option>
              <option value="F">Feminino</option>
              <option value="O">Outro</option>
              <option value="N">Não declarar</option>
            </select>
          </div>
          <div class="form-group col-lg-4">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" required>
          </div>
          <div class="form-group col-lg-8">
            <label for="endereco">Endereço</label>
            <input type="text" name="endereco" id="endereco" class="form-control" required>
          </div>
          <div class="form-group col-lg-4">
            <label for="telefone">Telefone</label>
            <input type="tel" name="telefone" id="telefone" class="form-control" oninput="mascara_telefone()" maxlength="14" required>
          </div>
          <div class="form-group col-lg-4">
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" class="form-control" required>
          </div>
            <div class="form-group col-lg-4">
                <label for="csenha">Confirmar senha</label>
                <input type="password" name="csenha" id="csenha" class="form-control" required>
            </div>
          <div class="col-lg-4 d-flex align-items-center justify-content-center">
            <button type="submit" name="registrar" class="btn btn-outline-success m-2">Registrar</button>
            <a href="index.php" class="btn btn-outline-danger">Voltar</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>
</html>