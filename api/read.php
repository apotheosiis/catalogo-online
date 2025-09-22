<?php
header('Content-Type: application/json');
require_once '../config/db.php';

try {
    $pdo = getDbConnection();
    $stmt = $pdo->query("SELECT id, nome, descricao, preco, imagem FROM produtos ORDER BY nome ASC");
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($produtos);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao buscar produtos.']);
}
?>