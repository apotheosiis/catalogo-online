<?php
session_start();
require_once 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        header('Location: login_cliente.php?error=invalid');
        exit;
    }

    try {
        $pdo = getDbConnection();
        $stmt = $pdo->prepare("SELECT * FROM clientes WHERE email = ?");
        $stmt->execute([$email]);
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cliente && password_verify($password, $cliente['password_hash'])) {
            // Login bem-sucedido
            session_regenerate_id(true);
            $_SESSION['cliente_loggedin'] = true;
            $_SESSION['cliente_id'] = $cliente['id'];
            $_SESSION['cliente_nome'] = $cliente['nome'];
            
            // Redireciona para a página inicial, agora logado
            header('Location: index.php');
            exit;
        } else {
            // Falha no login
            header('Location: login_cliente.php?error=invalid');
            exit;
        }
    } catch (PDOException $e) {
        die("Erro de autenticação: " . $e->getMessage());
    }
} else {
    header('Location: index.php'); // Redireciona se não for POST
    exit;
}
?>