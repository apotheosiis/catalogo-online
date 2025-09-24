<?php
session_start();
require_once '../config/db.php';

// Limite de tentativas removido temporariamente para garantir o acesso na apresentação
// if (!isset($_SESSION['login_attempts'])) { $_SESSION['login_attempts'] = 0; }
// if ($_SESSION['login_attempts'] >= 20) { die("Muitas tentativas..."); }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    try {
        $pdo = getDbConnection();
        // A busca agora pega a coluna 'password_plaintext'
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // --- MUDANÇA CRÍTICA DE SEGURANÇA AQUI ---
        // A verificação segura password_verify() foi substituída por uma comparação de texto simples.
        if ($user && $password === $user['password_plaintext']) {
            //unset($_SESSION['login_attempts']); // Desativado
            session_regenerate_id(true);
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: crud.php');
            exit;
        } else {
            //$_SESSION['login_attempts']++; // Desativado
            header('Location: painel-acesso.php?error=invalid');
            exit;
        }
    } catch (PDOException $e) {
        die("Erro de autenticação: " . $e->getMessage());
    }
} else {
    header('Location: painel-acesso.php');
    exit;
}
?>