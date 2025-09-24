<?php
require_once 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($nome) || empty($email) || empty($password)) {
        die("Por favor, preencha todos os campos.");
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    
    try {
        $pdo = getDbConnection();

        // Verifica se o e-mail já existe
        $stmt = $pdo->prepare("SELECT id FROM clientes WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            header('Location: registro.php?error=exists');
            exit;
        }

        // Insere o novo cliente
        $stmt = $pdo->prepare("INSERT INTO clientes (nome, email, password_hash) VALUES (?, ?, ?)");
        $stmt->execute([$nome, $email, $password_hash]);

        header('Location: login_cliente.php?success=registered');
        exit;

    } catch (PDOException $e) {
        // Em um ambiente de produção, logue o erro em vez de exibi-lo.
        die("Erro ao registrar: " . $e->getMessage());
    }
}
?>