<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <title>Catálogo de Produtos</title>
</head>
<body>
    <header style="background-image: url(img/adorable-kitty-with-monochrome-wall-her.png);">
        <div class="container">
            <nav>
                <a href="index.html">
                <img src="img/logo-removebg-preview.png" alt="Logo">
                </a>
                <ul class="ul">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="servicos.html">Serviços</a></li>
                    <li><a href="produtos.html">Produtos</a></li> <!-- Nova aba Produtos -->
                    <li><a href="login.html">Login</a></li>
                    <li><a href="cadastro.html">Cadastro</a></li>
                    <li><a href="contato.html" class="btn">Contato</a></li>
                    <li class="close-icon" onclick="closeMenu()">
                        <i class="fa fa-times-circle"></i>
                    </li>
                </ul>
                <div class="menu-icon" onclick="openMenu()">
                    <i class="fa fa-bars"></i>
                </div>
            </nav>
        </div>
    </header>

    <section class="produtos">
        <div class="container">
            <?php
            // Conectar ao banco de dados
            $servername = "localhost";
            $username = "petshop_user";
            $password = "90987654321@";
            $dbname = "petshop";
            
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            if ($conn->connect_error) {
                die("Erro de conexão: " . $conn->connect_error);
            }

            // Consultar produtos
            $sql = "SELECT nome, descricao, preco, imagem FROM produtos WHERE estoque > 0";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='produto-card'>";
                    echo "<img src='img/{$row['imagem']}' alt='{$row['nome']}'>";
                    echo "<h3>{$row['nome']}</h3>";
                    echo "<p>Preço: R$ " . number_format($row['preco'], 2, ',', '.') . "</p>";
                    echo "<p>{$row['descricao']}</p>";
                    echo "<button>Adicionar ao Carrinho</button>";
                    echo "</div>";
                }
            } else {
                echo "<p>Nenhum produto encontrado.</p>";
            }

            $conn->close();
            ?>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p>Desenvolvido pelo Grupo</p>
        </div>
    </footer>

    <script src="main.js"></script>
</body>
</html>
