<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = (int)$_POST['product_id'];

    if ($conn) {  // Verifica se a conexão existe
        // Verifica se o produto existe no banco de dados
        $sql = "SELECT * FROM produtos WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Adiciona o produto ao carrinho
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }
            $_SESSION['cart'][] = $product_id;

            echo "Produto adicionado ao carrinho!";
        } else {
            echo "Produto não encontrado.";
        }

        $stmt->close();
    } else {
        echo "Erro de conexão com o banco de dados.";
    }
} else {
    echo "Requisição inválida.";
}

$conn->close();
?>
