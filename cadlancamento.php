<?php
header("Content-type:text/html; charset=utf8");

require_once "./Classes/Lancamento.php";
require_once "./Classes/Conta.php";
require_once "./Classes/Saldo.php";

if(!isset($_SESSION["USUARIO_ID"])){
    header("location: index.php");
}

$saldo = new Saldo();

$saldo_p = $saldo->saldoPositivo();
$saldo_n = $saldo->saldoNegativo();
$saldo_total = $saldo_p->VALOR_P - $saldo_n->VALOR_N;

$lancamento = new Lancamento();
$conta = new Conta();

$listarConta = $conta->listarTodos();
$listarLancamento = $lancamento->listarTodos();

if(isset($_POST["cadastrar"])){
    $lancamento->inserir();
}

if(isset($_GET["id"])){
    $lancamento->excluir($_GET["id"]);
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <link rel="stylesheet" href="Style/main2.css">
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
    <div class="container">
         <div class="row">
           <div class="col-md-4">
             <div class="card">
                <div class="card-header" align="center" style="background-color:#91B7C7;">
                  <h1>Receitas</h1>
                </div>
                <div class="card-body card-totais">
                    <h3 id="labelreceitas"><?php if($saldo_p->VALOR_P != 0){ echo "<span style='color: green'>R$: {$saldo_p->VALOR_P}</span>";}else{ echo "R$: 0,00";}?></h3>
                </div>
             </div>
           </div>
           <div class="col-md-4">
            <div class="card">
              <div class="card-header" align="center" style="background-color:#91B7C7;">
                <h1>Despesas</h1>
              </div>
              <div class="card-body card-totais">
                <h3 id="labeldespesas"><?php if($saldo_n->VALOR_N != 0){ echo "<span style='color: red'>R$: {$saldo_n->VALOR_N}</span>";}else{ echo "R$: 0,00";}?></h3>
              </div>
           </div>
           </div>
           <div class="col-md-4">
            <div class="card">
              <div class="card-header" align="center" style="background-color:#91B7C7;">
                <h1>Saldo</h1>
              </div>
              <div class="card-body card-totais">
                  <h3 id="labelsaldo"><?php if($saldo_total > 0){echo "<span style='color: green'>R$: {$saldo_total}</span>";}elseif($saldo_total < 0){echo "<span style='color: red'>R$: {$saldo_total}</span>";}else{ echo "R$: 0,00";}?></h3>
              </div>
           </div>
           </div>
         </div>
         <div class="col-12">
            <div style="text-align: center; margin-top: 150px;">

              <div class="row">
                    <div class="col-6">
                        <div class="card">
                        <div class="card-body">
                            <h2>Lançamentos</h2>
                           <br>
                            <form action="cadlancamento.php" method="post">
                            <div class="form-group">
                                <label for="contas">Conta</label>
                                <select name="contas" id="contas" class="form-control" required>
                                    <option value="">Selecione uma opção</option>
                                    <?php foreach ($listarConta as $conta){?>
                                        <option value="<?php echo $conta->ID;?>"><?php echo $conta->NOME;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Valor</label>
                                <span id="span"><span id="dinheiro">R$:</span><input type="number" class="form-control" autocomplete="off" step="any" placeholder="0,00" id="txt_valor" name="valor" required></span>
                            </div>
                            <div class="form-group">
                              <label for="data">Data</label>
                              <input type="date" class="form-control" name="data" id="data" required>
                            </div>
                             <button class="btn btn-outline-success" name="cadastrar" type="submit" >Cadastrar</button>
                            </form>
                            <br><br>
                        </div>
                        </div>
                    </div>
                    <div class="col-6">
        <br>
          <div class="col-12">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Conta</th>
                  <th>Valor</th>
                  <th>Data</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="tbody">
                <tr>
                    <?php if($listarLancamento):?>
                    <?php foreach($listarLancamento as $lancamento):?>
                        <td><?php echo $lancamento->CONTA;?></td>
                        <td><?php echo $lancamento->VALOR;?></td>
                        <td><?php echo $lancamento->DATA;?></td>
                        <td>
                            <a href="editarlancamento.php?id=<?php echo $lancamento->ID;?>" class="btn btn-outline-primary"><i class="fa fa-edit"></i></a>
                            <a href="cadlancamento.php?id=<?php echo $lancamento->ID;?>" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a>
                        </td>
                </tr>
                    <?php endforeach;?>
                    <?php else:?>
                    <td colspan="4">Nenhum lançamento cadastrado!!!</td>
                    <?php endif;?>
              </tbody>
            </table>
          </div>
                    </div>
              </div>
            </div>
         </div>
    </div>
</body>
</html>
