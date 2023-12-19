
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/register.css">
    <title>Login bala</title>
</head>

<body>
    </header>
    <div class="container">
        <form action="login.php" method="post">
            <h2>Conecte-se</h2>
            <label for="username">Usuário:</label>
            <input type="text" name="username" required>
            <label for="password">Senha:</label>
            <input type="password" name="password" required>
            <button type="submit" name="enviar">Entrar</button>
        </form>
        <p>Não tem uma conta? <a href="Registrar.php">Registre-se aqui</a></p>
    </div>


    <?php

    if (isset($_POST["enviar"])) {
        session_start();
        $username = $_POST['username'];
        $password = $_POST['password'];
        $_SESSION["username"] = $username;
        $crud = new Crud($db);
        // Verificar as credenciais 
        if ($username != null && $password != null) {
            if ($crud->validate($username, $password)) {
                if ($username != "admin" && $password != "admin") {
                    header("Location: index.php");
                } else {
                    header("Location: admin.php");
                }
            } else {
                echo "Falha no login. Por favor, verifique seu usuário e senha.  ";
            }
        } else {
            echo 'preencha todos os campos ';
        }
    }

    ?>
</body>

</html>