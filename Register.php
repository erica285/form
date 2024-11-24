<?php
include_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $sexo = $_POST['genero'];
    $data_nascimento = $_POST['datanascimento'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $endereco = $_POST['endereco'];
    $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);

    // Verifique se o email já existe
    $checkQuery = "SELECT * FROM users WHERE email = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $result = $checkStmt->get_result();

    if ($result->num_rows > 0) {
        echo "Erro: O email já está cadastrado.";
    } else {
        // Inserir o novo usuário
        $query = "INSERT INTO users (nome, email, telefone, sexo, data_nascimento, cidade, estado, endereco, senha) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssssss", $nome, $email, $telefone, $sexo, $data_nascimento, $cidade, $estado, $endereco, $senha);

        if ($stmt->execute()) {
            echo "Usuário cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar o usuário: " . $stmt->error;
        }

        $stmt->close();
    }

    $checkStmt->close();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <style>/* Define estilos globais */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Fredoka', sans-serif;
        }
        
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f7fa;
        }
        
        /* Estilos para o contêiner do formulário */
        .box {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        
        .box h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 1.5rem;
            color: #333333;
        }
        
        /* Estilos para os campos de entrada */
        .box input[type="text"],
        .box input[type="email"],
        .box input[type="password"],
        .box input[type="date"],
        .box input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        
        /* Estilos específicos para os botões de rádio */
        .box input[type="radio"] {
            margin: 0 5px 0 0;
        }
        
        /* Estilos para os rótulos de opções de gênero */
        .box input[type="radio"] + label {
            margin-right: 10px;
            font-size: 16px;
            color: #333333;
        }
        
        /* Estilos para o botão de envio */
        .box input[type="submit"] {
            background-color: #00A8FF;
            color: white;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .box input[type="submit"]:hover {
            background-color: #333333;
        }</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo ao meu site</title>
    <link rel="stylesheet" href="cadastro.css">
    <link rel="stylesheet" href="fonts.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
</head>
<body>
    
     <div class="box">
        <form action="Register.php" method="POST">
            <input type="text" name="nome" placeholder="Digite seu Nome Completo..." required>
            <input type="email" name="email" placeholder="Digite seu Email..." required>
            <input type="text" name="telefone" placeholder="Digite seu Telefone..." required>
            <input type="radio" name="genero" value="Masculino" required> Masculino
            <input type="radio" name="genero" value="Feminino" required> Feminino
            <input type="radio" name="genero" value="Outro" required> Outro
            <input type="date" name="datanascimento" required>
            <input type="text" name="cidade" placeholder="Digite sua Cidade..." required>
            <input type="text" name="estado" placeholder="Digite seu Estado..." required>
            <input type="text" name="endereco" placeholder="Digite seu Endereço..." required>
            <input type="password" name="senha" placeholder="Digite sua Senha..." required>
            <input type="submit" value="Cadastrar">
        </form>
     </div>
</body>
</html>