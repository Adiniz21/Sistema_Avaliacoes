<?php
$servername = "localhost";
$username = "root";
$password = "";

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Crie uma conexÃ£o
$conn = new mysqli($servername, $username, $password);

// Verifique a conexÃ£o
 if ($conn->connect_error) {
    die("ConexÃ£o falhou: " . $conn->connect_error);
} 

// Crie o banco de dados
$sql = "CREATE DATABASE IF NOT EXISTS minas_brasil";
/* if ($conn->query($sql) === TRUE) {
    echo "Banco de dados criado com sucesso. ";
} else {
    echo "Erro ao criar o banco de dados: " . $conn->error;
} */

// Selecionar o banco de dados
$conn->select_db("minas_brasil");

// Crie a tabela para armazenar as avaliaÃ§Ãµes, se nÃ£o existir
$sql = "CREATE TABLE IF NOT EXISTS filial_01 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    valor INT,
    data_hora DATETIME DEFAULT CURRENT_TIMESTAMP
)";

/* if ($conn->query($sql) === TRUE) {
    echo "Tabela criada com sucesso. ";
} else {
    echo "Erro ao criar tabela: " . $conn->error;
}
 */
// Obter valores do formulÃ¡rio
$valor = $_POST['valor'];

// Inserir dados no banco de dados, incluindo a hora atual
$sql = "INSERT INTO filial_01 (valor) VALUES ('$valor')";

if ($conn->query($sql) === TRUE) {
    // Exibir um alert com uma mensagem de sucesso e configurar um timeout para fechÃ¡-lo apÃ³s 5 segundos
    echo "<script>
            var alerta = alert('Avaliação enviada com sucesso.');
            setTimeout(function(){ 
                alerta.close(); // Fechar o alert apÃ³s 5 segundos
                window.location.href = 'index.html'; 
            }, 5000);
          </script>";
} else {
    // Exibir um alert com uma mensagem de erro
    echo "<script>
            var alertaErro = alert('Erro ao enviar avaliaÃ§Ã£o: " . $conn->error . "');
            setTimeout(function(){ 
                alertaErro.close(); // Fechar o alert apÃ³s 5 segundos
                window.location.href = 'index.html'; 
            }, 5000);
          </script>";
}

// Fechar a conexÃ£o com o banco de dados
$conn->close();

// Redirecionar para a pÃ¡gina index.html apÃ³s o alert
echo "<script>window.location.href = 'index.html';</script>";
?>
