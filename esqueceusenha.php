<?php
session_start();
require 'db.php'; // Arquivo com conexão ao banco de dados

$user_id = $_SESSION['user_id'];
$error = "";
$success = "";

// Processa a alteração de senha
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $error = "A nova senha e a confirmação não coincidem.";
    } else {
        // Consulta a senha atual no banco
        $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($current_password, $row['password'])) {
                // Atualiza a senha
                $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
                $update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
                $update_stmt->bind_param("si", $hashed_password, $user_id);

                if ($update_stmt->execute()) {
                    $success = "Senha alterada com sucesso!";
                } else {
                    $error = "Erro ao atualizar a senha. Tente novamente.";
                }
            } else {
                $error = "A senha atual está incorreta.";
            }
        } else {
            $error = "Usuário não encontrado.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Alterar Senha</title>
</head>
<body>
    <h1>Alterar Senha</h1>
    <?php if ($error): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <?php if ($success): ?>
        <p style="color: green;"><?php echo htmlspecialchars($success); ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="current_password">Senha Atual:</label>
        <input type="password" id="current_password" name="current_password" required>
        <br><br>
        <label for="new_password">Nova Senha:</label>
        <input type="password" id="new_password" name="new_password" required>
        <br><br>
        <label for="confirm_password">Confirmar Nova Senha:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <br><br>
        <button type="submit">Alterar Senha</button>
    </form>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AzzO</title>
    <link rel="stylesheet" href="esqueceusuasenha.css">
    <link rel="stylesheet" href="fonts.css">
</head>
<body>
    <div class="container">
        <h1>Insira seu email</h1>
        <p>Abaixo digite o seu email que você utilizou para criar a conta.</p>
        <input type="email" name="email" id="" placeholder="Digite seu email..." class="inputemail">
        <button type="submit" class="enviar">Enviar</button>
    </div>
</body>
</html>

