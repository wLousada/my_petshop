<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "petshop_user";
$password = "90987654321@";
$dbname = "petshop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Erro de conexão: " . $conn->connect_error]));
}

$sql = "SELECT nome, descricao, preco, imagem FROM produtos WHERE estoque > 0";
$result = $conn->query($sql);

$produtos = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $produtos[] = $row;
    }
}
echo json_encode($produtos);

$conn->close();
?>
