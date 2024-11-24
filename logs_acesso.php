<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "azzo";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi estabelecida
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
//
// Filtros: Verificar se os filtros foram passados
$data_inicial = isset($_GET['data_inicial']) ? $_GET['data_inicial'] : '';
$data_final = isset($_GET['data_final']) ? $_GET['data_final'] : '';
$usuario = isset($_GET['usuario']) ? $_GET['usuario'] : '';

// Consulta ao banco com filtros
$sql = "SELECT * FROM logs_acesso WHERE 1=1";
if ($data_inicial && $data_final) {
    $sql .= " AND data_entrada BETWEEN '$data_inicial' AND '$data_final'";
}
if ($usuario) {
    $sql .= " AND usuario LIKE '%$usuario%'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs de Acesso</title>
    <link rel="stylesheet" href="logstyle.css">
</head>
<body>
    <div class="container">
        <h1>Logs por Acessos</h1>
        <form method="GET" action="logs_acesso.php">
            <div class="filters">
                <label for="data_inicial">Data Inicial:</label>
                <input type="date" id="data_inicial" name="data_inicial" value="<?php echo $data_inicial; ?>">
                
                <label for="data_final">Data Final:</label>
                <input type="date" id="data_final" name="data_final" value="<?php echo $data_final; ?>">
                
                <label for="usuario">Usuário:</label>
                <input type="text" id="usuario" name="usuario" placeholder="Buscar por usuário..." value="<?php echo $usuario; ?>">
                
                <button type="submit">Atualizar Filtro</button>
            </div>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Data Entrada</th>
                    <th>Hora Entrada</th>
                    <th>Data Saída</th>
                    <th>Hora Saída</th>
                    <th>Usuário</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['data_entrada'] . "</td>";
                        echo "<td>" . $row['hora_entrada'] . "</td>";
                        echo "<td>" . $row['data_saida'] . "</td>";
                        echo "<td>" . $row['hora_saida'] . "</td>";
                        echo "<td>" . $row['usuario'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Nenhum log encontrado</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>