<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../config/db.php';

    // Variáveis com verificação de existência
    $id = $_POST['id'] ?? '';
    $nome = $_POST['nome'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $preco = $_POST['preco'] ?? '';
    $imagem = $_POST['imagem'] ?? '';

    // Validação no lado do servidor (essencial!)
    if (empty($id) || empty($nome) || empty($descricao) || empty($preco) || empty($imagem)) {
        header('Location: ../admin/crud.php?status=error_empty');
        exit;
    }

    try {
        $pdo = getDbConnection();
        $sql = "UPDATE produtos SET nome = ?, descricao = ?, preco = ?, imagem = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $descricao, $preco, $imagem, $id]);
        
        // Redireciona para o caminho correto com um status de sucesso
        header('Location: ../admin/crud.php?status=success_update');
        exit;
    } catch (Exception $e) {
        // Em caso de erro no banco, redireciona com status de erro
        header('Location: ../admin/crud.php?status=error_db');
        exit;
    }
}
?>