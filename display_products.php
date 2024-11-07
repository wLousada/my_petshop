<?php
include 'db_connection.php';

// Função para buscar produtos do banco de dados e exibi-los
function displayProducts($conn) {
    if ($conn) {  // Verifica se a conexão existe
        $sql = "SELECT * FROM produtos";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div>";
                echo "<h2>" . htmlspecialchars($row['nome']) . "</h2>";
                echo "<p>" . htmlspecialchars($row['descricao']) . "</p>";
                echo "<p>Preço: R$ " . number_format($row['preco'], 2, ',', '.') . "</p>";
                echo "<form action='add_to_cart.php' method='post'>";
                echo "<input type='hidden' name='product_id' value='" . htmlspecialchars($row['id']) . "'>";
                echo "<button type='submit'>Adicionar ao Carrinho</button>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "Nenhum produto disponível.";
        }
    } else {
        echo "Erro de conexão com o banco de dados.";
    }
}

// Chama a função para exibir os produtos
displayProducts($conn);
?>
