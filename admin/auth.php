<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}
if ($_SESSION['login_attempts'] >= 5) {
    die("Muitas tentativas de login falhas. Por segurança, sua capacidade de fazer login foi temporariamente bloqueada.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    try {
        $pdo = getDbConnection();
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            unset($_SESSION['login_attempts']);
            session_regenerate_id(true);
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: crud.php');
            exit;
        } else {
            $_SESSION['login_attempts']++;
            // REDIRECIONAMENTO ATUALIZADO
            header('Location: painel-acesso.php?error=invalid');
            exit;
        }
    } catch (PDOException $e) {
        die("Erro de autenticação: " . $e->getMessage());
    }
} else {
    // REDIRECIONAMENTO ATUALIZADO
    header('Location: painel-acesso.php');
    exit;
}
?>