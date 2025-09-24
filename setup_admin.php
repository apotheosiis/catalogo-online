<?php
// Este script serve para criar ou resetar a senha do usuário administrador.
// DEVE SER DELETADO APÓS O USO.

require_once 'config/db.php';

// --- Configurações ---
$admin_username = 'admin';
$admin_password = '123'; // <<< MUDANÇA AQUI: Nova senha definida como '123' >>>

echo "<!DOCTYPE html><html lang='pt-br'><head><meta charset='UTF-8'><title>Setup Admin</title>";
echo "<style>body { font-family: sans-serif; padding: 20px; } .success { color: green; font-weight: bold; } .error { color: red; font-weight: bold; }</style></head><body>";
echo "<h1>Instalador/Reset do Usuário Admin</h1>";

// Gera o hash SEGURO da senha no seu ambiente PHP local
$password_hash = password_hash($admin_password, PASSWORD_DEFAULT);

if (!$password_hash) {
    die("<p class='error'>Erro crítico: A função password_hash() não está funcionando corretamente.</p></body></html>");
}

echo "<p>Tentando configurar o usuário: <strong>{$admin_username}</strong> com a nova senha: <strong>{$admin_password}</strong></p>";

try {
    $pdo = getDbConnection();

    // 1. Verifica se o usuário 'admin' já existe
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE username = ?");
    $stmt->execute([$admin_username]);
    $user = $stmt->fetch();

    if ($user) {
        // 2. Se existe, atualiza a senha
        echo "<p>Usuário 'admin' encontrado. Atualizando a senha...</p>";
        $update_stmt = $pdo->prepare("UPDATE usuarios SET password_hash = ? WHERE username = ?");
        $update_stmt->execute([$password_hash, $admin_username]);
        echo "<p class='success'>Senha do usuário 'admin' atualizada com sucesso!</p>";
    } else {
        // 3. Se não existe, cria o usuário
        echo "<p>Usuário 'admin' não encontrado. Criando novo usuário...</p>";
        $insert_stmt = $pdo->prepare("INSERT INTO usuarios (username, password_hash) VALUES (?, ?)");
        $insert_stmt->execute([$admin_username, $password_hash]);
        echo "<p class='success'>Usuário 'admin' criado com sucesso!</p>";
    }

    echo "<hr>";
    echo "<p><strong>Próximos Passos:</strong></p>";
    echo "<ol><li>Limpe os cookies do seu navegador para 'localhost' para remover o bloqueio de tentativas.</li>";
    echo "<li>Tente fazer o login novamente na <a href='admin/painel-acesso.php'>página de acesso do admin</a> com a nova senha.</li>";
    echo "<li>Após confirmar que o login funciona, <strong>DELETE ESTE ARQUIVO (setup_admin.php)</strong> do seu servidor imediatamente.</li></ol>";

} catch (PDOException $e) {
    echo "<p class='error'>ERRO DE BANCO DE DADOS: " . $e->getMessage() . "</p>";
}

echo "</body></html>";
?>