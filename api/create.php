<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../config/db.php';

    $nome = $_POST['nome'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $preco = $_POST['preco'] ?? 0;
    $imagem = $_POST['imagem'] ?? 'default.jpg';

    if (empty($nome) || empty($descricao) || empty($preco)) {
        header('Location: ../crud.php?status=error&message=Preencha todos os campos.');
        exit;
    }

    try {
        $pdo = getDbConnection();
        $sql = "INSERT INTO produtos (nome, descricao, preco, imagem) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $descricao, $preco, $imagem]);
        
        header('Location: ../crud.php?status=success&message=Produto criado com sucesso.');
    } catch (Exception $e) {
        header('Location: ../crud.php?status=error&message=Erro ao criar produto.');
    }
}
?>