<?php
// Inclua o arquivo de conexão ao banco de dados
include('conexão.php');

// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtenha os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifique se os campos obrigatórios foram preenchidos
    if (empty($nome) || empty($email) || empty($senha)) {
        echo "Preencha todos os campos obrigatórios.";
    } else {
        // Hash da senha (use uma função de hash segura, como password_hash)
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        // Inserir os dados no banco de dados
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha_hash')";
        if ($mysqli->query($sql)) {
            echo "Conta criada com sucesso!";
        } else {
            echo "Erro ao criar a conta: " . $mysqli->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    <h1>Crie sua conta</h1>
    <form action="cadastro.php" method="POST">
        <p>
            <label>Nome:</label>
            <input type="text" name="nome">
        </p>
        <p>
            <label>Email:</label>
            <input type="email" name="email">
        </p>
        <p>
            <label>Senha:</label>
            <input type="password" name="senha">
        </p>
        <p>
            <button type="submit">Criar Conta</button>
        </p>
    </form>

    <p>Já tem uma conta? <a href="index.php">Faça login</a></p>
</body>
</html>
