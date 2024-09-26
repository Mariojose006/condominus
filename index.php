<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./imgs/icon.jpeg" type="image/png">
    <title>Condôminus - Login</title>
    <style>
        body {
            background-color: #101E38;
            font-family: Arial, sans-serif;
        }
        .login-container {
            width: 300px;
            margin: 0 auto;
            padding-top: 50px;
            text-align: center;
        }
        .login-container img {
            width: 200px;
            height: auto;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        a {
            display: block;
            margin-top: 10px;
            color: #0000EE;
        }
        .forgot-password, .register {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="./imgs/logo.jpeg" alt="Condôminus">

        <?php
			if(isset($_GET['error'])) {
				if($_GET['error']==1){
					echo("
							<p style='color: #a83232;'>
								Usuário ou senha incorretos
							</p>
					");
				}if($_GET['error']==2){
					echo("
							<p style='color: #a83232;'>
								Logue antes para acessar a página desejada
							</p>
					");
				}
			}
		?>

        <form action="./conexao/login.php" method="POST">
            <input type="text" name="login" placeholder="Login" required><br>
            <input type="password" name="senha" placeholder="Senha" required><br>
            <input type="submit" value="Entrar">
        </form>

        <!--<div class="forgot-password">
            <a href="#">Esqueceu a senha? Clique aqui</a>
        </div>

        <div class="register">
            <a href="#">Fazer cadastro</a>
        </div>-->

    </div>
</body>
</html>