<?php
header("Content-type:text/html; charset=utf8");

require_once "./Classes/Usuario.php";

$usuario = new Usuario();

if(isset($_POST["email"]) && !empty($_POST["email"])
&& isset($_POST["senha"]) && !empty($_POST["senha"])) {
    if (isset($_POST["login"])) {
        $usuario->login();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" />
    <link rel="stylesheet" href="Style/main.css" />
    <link rel="stylesheet" href="Style/util.css" />
    <link rel="stylesheet" href="Style/animation.css">
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
                <form class="login100-form validate-form flex-sb flex-w" action="index.php" method="post">
                    <span class="login100-form-title p-b-32 animation-desce">
						Login
					</span>

                    <span class="txt1 p-b-11 animation-esquerda">
						Username
					</span>
                    <div class="wrap-input100 validate-input m-b-36 animation-esquerda" data-validate="Username is required">
                        <input class="input100" type="text" name="email" placeholder="exemplo@gmail.com" required>
                        <span class="focus-input100"></span>
                    </div>

                    <span class="txt1 p-b-11 animation-direita">
						Password
					</span>
                    <div class="wrap-input100 validate-input m-b-12 animation-direita" data-validate="Password is required">
                        <span class="btn-show-pass">
							<i class="fa fa-eye"></i>
						</span>
                        <input class="input100" type="password" name="senha" required>
                        <span class="focus-input100"></span>
                    </div>

                    <div class="flex-sb-m w-full p-b-48 animation-sobe">
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                            <label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
                        </div>

                        <div>
                            <a href="#" class="txt3">
								Forgot Password?
							</a>
                        </div>
                    </div>

                    <div class="container-login100-form-btn animation-sobe">
                        <button class="login100-form-btn" name="login">
							Login
						</button>
                        <a href="Cadastro.php" class="login100-form-btn" style="text-decoration:none;
                        color: white;">
							Register
						</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>
</html>