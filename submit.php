<?php
$servername = "192.168.0.1";
$username = "artur";
$password = "artur";

// Crie uma conexão
$conn = new mysqli($servername, $username, $password);

// Verifique a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Crie o banco de dados
$sql = "CREATE DATABASE IF NOT EXISTS minas_brasil";
if ($conn->query($sql) === TRUE) {
    echo "Banco de dados criado com sucesso. ";
} else {
    echo "Erro ao criar o banco de dados: " . $conn->error;
}

// Selecionar o banco de dados
$conn->select_db("minas_brasil");

// Crie a tabela para armazenar as avaliações, se não existir
$sql = "CREATE TABLE IF NOT EXISTS avaliacoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    valor INT,
    data_hora DATETIME DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabela criada com sucesso. ";
} else {
    echo "Erro ao criar tabela: " . $conn->error;
}

// Obter valores do formulário
$valor = $_POST['valor'];

// Inserir dados no banco de dados, incluindo a hora atual
$sql = "INSERT INTO avaliacoes (valor) VALUES ('$valor')";

if ($conn->query($sql) === TRUE) {
    echo "Avaliação enviada com sucesso.";
} else {
    echo "Erro ao enviar avaliação: " . $conn->error;
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
