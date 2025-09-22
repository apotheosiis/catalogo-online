<?php
session_start();
require_once '../config/db.php';

// --- IMPLEMENTAÇÃO DE SEGURANÇA CONTRA FORÇA BRUTA ---
// 1. Inicializa o contador de tentativas se ele não existir na sessão.
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

// 2. Bloqueia o acesso se o número de tentativas for excedido (ex: 5 tentativas).
if ($_SESSION['login_attempts'] >= 5) {
    // É uma boa prática informar o usuário que a conta foi temporariamente bloqueada.
    die("Muitas tentativas de login falhas. Por segurança, sua capacidade de fazer login foi temporariamente bloqueada. Tente novamente em alguns minutos.");
}
// ---------------------------------------------------------


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        header('Location: login.php?error=invalid');
        exit;
    }

    try {
        $pdo = getDbConnection();
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica se o usuário existe E se a senha está correta
        if ($user && password_verify($password, $user['password_hash'])) {
            // --- LOGIN BEM-SUCEDIDO ---

            // 1. Limpa o contador de tentativas falhas após o sucesso.
            unset($_SESSION['login_attempts']);

            // 2. [BÔNUS DE SEGURANÇA] Regenera o ID da sessão para prevenir Session Fixation.
            session_regenerate_id(true);
            
            // 3. Define as variáveis da sessão para indicar que o usuário está logado.
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            
            // 4. Redireciona para a página do CRUD.
            header('Location: crud.php');
            exit;

        } else {
            // --- LOGIN FALHOU ---

            // 1. Incrementa o contador de tentativas falhas.
            $_SESSION['login_attempts']++;
            
            // 2. Redireciona de volta para o login com uma mensagem de erro.
            header('Location: login.php?error=invalid');
            exit;
        }
    } catch (PDOException $e) {
        // Em produção, logar o erro em vez de exibi-lo.
        die("Erro de autenticação: " . $e->getMessage());
    }
} else {
    // Se não for POST, redireciona para o login
    header('Location: login.php');
    exit;
}
?>