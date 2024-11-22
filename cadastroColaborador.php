<?php
include 'conexao.php'; // Inclui a conexão com o banco

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cargo = $_POST['cargo'];

    // Validar e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "E-mail inválido!";
        exit();
    }

    // Preparar a consulta SQL para inserção
    $sql = "INSERT INTO Colaboradores (nome, email, telefone, cargo) VALUES ('$nome', '$email', '$telefone', '$cargo')";

    if ($conn->query($sql) === TRUE) {
        echo "Colaborador cadastrado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    // Fechar a conexão
    $conn->close();
}
?>

<!-- Formulário HTML de cadastro -->
<form action="CadastroColaborador.php" method="POST">
    <label for="nome">Nome:</label><br>
    <input type="text" id="nome" name="nome" required><br><br>

    <label for="email">E-mail:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label for="telefone">Telefone:</label><br>
    <input type="text" id="telefone" name="telefone"><br><br>

    <label for="cargo">Cargo:</label><br>
    <input type="text" id="cargo" name="cargo" required><br><br>

    <button type="submit">Cadastrar</button>
</form>
