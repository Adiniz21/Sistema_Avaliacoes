<?php
$servername = "localhost";
$username = "root";
$password = "";

// Crie uma conexão
$conn = new mysqli($servername, $username, $password);

// Verifique a conexão
/* if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
} */

// Crie o banco de dados
$sql = "CREATE DATABASE IF NOT EXISTS minas_brasil";
/* if ($conn->query($sql) === TRUE) {
    echo "Banco de dados criado com sucesso. ";
} else {
    echo "Erro ao criar o banco de dados: " . $conn->error;
} */

// Selecionar o banco de dados
$conn->select_db("minas_brasil");

// Crie a tabela para armazenar as avaliações, se não existir
$sql = "CREATE TABLE IF NOT EXISTS avaliacoes (
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
// Obter valores do formulário
$valor = $_POST['valor'];

// Inserir dados no banco de dados, incluindo a hora atual
$sql = "INSERT INTO avaliacoes (valor) VALUES ('$valor')";

if ($conn->query($sql) === TRUE) {
    // Exibir um alert com uma mensagem de sucesso e configurar um timeout para fechá-lo após 5 segundos
    echo "<script>
            var alerta = alert('Avaliação enviada com sucesso.');
            setTimeout(function(){ 
                alerta.close(); // Fechar o alert após 5 segundos
                window.location.href = 'index.html'; 
            }, 5000);
          </script>";
} else {
    // Exibir um alert com uma mensagem de erro
    echo "<script>
            var alertaErro = alert('Erro ao enviar avaliação: " . $conn->error . "');
            setTimeout(function(){ 
                alertaErro.close(); // Fechar o alert após 5 segundos
                window.location.href = 'index.html'; 
            }, 5000);
          </script>";
}

// Fechar a conexão com o banco de dados
$conn->close();

// Redirecionar para a página index.html após o alert
echo "<script>window.location.href = 'index.html';</script>";
?>
