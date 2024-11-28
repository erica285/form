<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação de dois Fatores</title>

    <?php
// Simulação do banco de dados
$users = [
    'admin' => [
        'password' => 'senha123',
        'security' => [
            'motherName' => 'Maria',
            'birthDate' => '01/01/1990',
            'zipCode' => '12345678'
        ]
    ]
];

$questions = [
    ['question' => 'Qual o nome da sua mãe?', 'field' => 'motherName'],
    ['question' => 'Qual a data do seu nascimento?', 'field' => 'birthDate'],
    ['question' => 'Qual o CEP do seu endereço?', 'field' => 'zipCode']
];

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        // Processar login
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (isset($users[$username]) && $users[$username]['password'] === $password) {
            // Escolher pergunta aleatória
            $selectedQuestion = $questions[array_rand($questions)];
            $_SESSION['username'] = $username;
            $_SESSION['selectedQuestion'] = $selectedQuestion;
            $_SESSION['attempts'] = 0;

            header("Location: 2fa.php");
            exit();
        } else {
            $error = "Usuário ou senha incorretos!";
        }
    }

    if (isset($_POST['2fa'])) {
        // Verificar resposta da 2FA
        $answer = $_POST['answer'];
        $username = $_SESSION['username'];
        $selectedQuestion = $_SESSION['selectedQuestion'];
        $attempts = $_SESSION['attempts'];

        if ($answer === $users[$username]['security'][$selectedQuestion['field']]) {
            session_destroy();
            header("Location: dashboard.php");
            exit();
        } else {
            $_SESSION['attempts'] = ++$attempts;
            if ($attempts >= 3) {
                session_destroy();
                $error = "3 tentativas sem sucesso! Favor realizar login novamente.";
                header("Location: index.php");
                exit();
            } else {
                $error = "Resposta incorreta! Tentativas restantes: " . (3 - $attempts);
            }
        }
    }
}
?>
</head>
<body>
    
</body>
</html>