<?php
session_start(); // Inicializa a sessão

include('conexão.php');

if (isset($_POST['email']) && isset($_POST['senha'])) {

    $email = $mysqli->real_escape_string($_POST['email']);
    $senha_inserida = $_POST['senha'];

    $sql_code = "SELECT * FROM usuarios WHERE email = '$email'";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

    $quantidade = $sql_query->num_rows;

    if ($quantidade == 1) {
        $usuario = $sql_query->fetch_assoc();
        $senha_hash = $usuario['senha']; // Assumindo que 'senha' é o campo no banco de dados que armazena o hash da senha

        // Verifica se a senha inserida corresponde ao hash no banco de dados
        if (password_verify($senha_inserida, $senha_hash)) {
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: painel.php");
            exit;
        } else {
            echo "Falha ao logar! E-mail ou senha incorretos";
        }
    } else {
        echo "Falha ao logar! E-mail não encontrado";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Acesse sua conta</h1>
    <form action="" method="POST">
        <p>
            <label>E-mail</label>
            <input type="text" name="email">
        </p>
        <p>
            <label>Senha</label>
            <input type="password" name="senha">
        </p>
        <p>
            <button type="submit">Entrar</button>
        </p>
    </form>

    <p>Não tem uma conta? <a href="cadastro.php">Cadastrar</a></p>
</body>
</html>
