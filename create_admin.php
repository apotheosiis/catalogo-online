<?php
require_once 'config/db.php';

// --- CONFIGURAÇÃO ---
$admin_user = 'admin';
$admin_pass = 'senha123'; // Defina aqui a senha que você quer usar

// --- LÓGICA ---
// Gera o hash seguro da senha
$password_hash = password_hash($admin_pass, PASSWORD_DEFAULT);

try {
    $pdo = getDbConnection();

    // Verifica se o usuário já existe para não duplicar
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE username = ?");
    $stmt->execute([$admin_user]);

    if ($stmt->fetch()) {
        echo "O usuário '{$admin_user}' já existe. Nenhum novo usuário foi criado.";
    } else {
        // Insere o novo usuário no banco de dados
        $sql = "INSERT INTO usuarios (username, password_hash) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$admin_user, $password_hash]);
        echo "Usuário '{$admin_user}' criado com sucesso!";
    }

} catch (PDOException $e) {
    die("Erro ao criar usuário: " . $e->getMessage());
}

// **IMPORTANTE:** Após rodar este script com sucesso, delete-o do seu servidor
// por razões de segurança.
?>