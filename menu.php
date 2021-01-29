<?php
header("Content-type:text/html; charset=utf8");

require_once "./Classes/Saldo.php";

if(!isset($_SESSION["USUARIO_ID"])){
    header("location: index.php");
}

$saldo = new Saldo();

$saldo_p = $saldo->saldoPositivo();
$saldo_n = $saldo->saldoNegativo();
$saldo_total = $saldo_p->VALOR_P - $saldo_n->VALOR_N;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <title>Controle Financeiro Pessoal</title>
</head>

<body style="background-color: #F4FAFF;">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Controle Financeiro</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link">Home</a>
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
                <a class="nav-link" href="cadlancamento.php">Lançamentos</a>
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
                <div class="card" style="border-radius: 17px;
    padding-bottom: 15px;">
                    <div class="card-header" align="center" style="background-color:#91B7C7;">
                        <h3>Receitas</h3>
                    </div>
                    <div class="card-body card-totais">
                        <h3 id="labelreceitas"><?php if($saldo_p->VALOR_P != 0){ echo "<span style='color: green'>R$: {$saldo_p->VALOR_P}</span>";}else{ echo "R$: 0,00";}?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="border-radius: 17px;
    padding-bottom: 15px;">
                    <div class="card-header" align="center" style="background-color:#91B7C7;">
                        <h3>Despesas</h3>
                    </div>
                    <div class="card-body card-totais">
                        <h3 id="labeldespesas"><?php if($saldo_n->VALOR_N != 0){ echo "<span style='color: red'>R$: {$saldo_n->VALOR_N}</span>";}else{ echo "R$: 0,00";}?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" style="border-radius: 17px;
    padding-bottom: 15px;">
                    <div class="card-header" align="center" style="background-color:#91B7C7;">
                        <h3>Saldo</h3>
                    </div>
                    <div class="card-body card-totais">
                        <h3 id="labelsaldo"><?php if($saldo_total > 0){echo "<span style='color: green'>R$: {$saldo_total}</span>";}elseif($saldo_total < 0){echo "<span style='color: red'>R$: {$saldo_total}</span>";}else{ echo "R$: 0,00";}?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div hidden>
            <div class="col-12">
                <div style="text-align: center; margin-top: 150px;">
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body">
                                    <h2>Lançamentos</h2>
                                    <div class="form-group" hidden>
                                        <label for="">ID</label>
                                        <input type="text" class="form-control" id="id">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Descrição</label>
                                        <input type="text" class="form-control" id="desclancamentos">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Conta</label>
                                        <select name="conta" id="contalancamentos" class="form-control">
                                  
                                </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Valor</label>
                                        <input type="number" class="form-control" id="valorlancamentos">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Data</label>
                                        <input type="date" class="form-control" id="datalancamentos">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Hora</label>
                                        <input type="time" class="form-control" id="horalancamentos">
                                    </div>
                                    <button class="btn btn-outline-success" type="button">Cadastrar</button>
                                    <button class="btn btn-outline-info" type="button" id="btn_alterar">Alterar</button>


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
                <div class="col-2"></div>
                <div class="col-8">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Descrição</th>
                                <th>Conta</th>
                                <th>Valor</th>
                                <th>Data</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            <tr>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
