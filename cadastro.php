<?php
include('db_connection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $query = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
    
    if (mysqli_query($conn, $query)) {
        // Armazenar mensagem de sucesso na sessão
        $_SESSION['signup_success'] = "Cadastro realizado com sucesso!";
        // Redirecionar para a página de login
        header("Location: login.html");
        exit();
    } else {
        echo "Erro: " . $query . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
