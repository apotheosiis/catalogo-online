<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../config/db.php';

    // Variáveis com verificação de existência (boa prática)
    $nome = $_POST['nome'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $preco = $_POST['preco'] ?? '';
    $imagem = $_POST['imagem'] ?? '';

    // Validação no lado do servidor (essencial!)
    if (empty($nome) || empty($descricao) || empty($preco) || empty($imagem)) {
        // Redireciona de volta com um erro claro se algum campo estiver vazio
        header('Location: ../admin/crud.php?status=error_empty');
        exit;
    }

    try {
        $pdo = getDbConnection();
        $sql = "INSERT INTO produtos (nome, descricao, preco, imagem) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $descricao, $preco, $imagem]);
        
        // Redireciona para o caminho correto com um status de sucesso
        header('Location: ../admin/crud.php?status=success_create');
        exit;
    } catch (Exception $e) {
        // Em caso de erro no banco, redireciona com status de erro
        header('Location: ../admin/crud.php?status=error_db');
        exit;
    }
}
?>