<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../config/db.php';

    $id = $_POST['id'] ?? 0;
    $nome = $_POST['nome'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $preco = $_POST['preco'] ?? 0;
    $imagem = $_POST['imagem'] ?? 'default.jpg';

    if (empty($id) || empty($nome) || empty($descricao) || empty($preco)) {
        header('Location: ../crud.php?status=error&message=Dados inválidos.');
        exit;
    }

    try {
        $pdo = getDbConnection();
        $sql = "UPDATE produtos SET nome = ?, descricao = ?, preco = ?, imagem = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $descricao, $preco, $imagem, $id]);
        
        header('Location: ../crud.php?status=success&message=Produto atualizado com sucesso.');
    } catch (Exception $e) {
        header('Location: ../crud.php?status=error&message=Erro ao atualizar produto.');
    }
}
?>