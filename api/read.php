<?php
header('Content-Type: application/json');
require_once '../config/db.php';

// Verifica se um parâmetro 'categoria' foi enviado na URL
$categoria = $_GET['categoria'] ?? null;

try {
    $pdo = getDbConnection();

    // A consulta SQL base
    $sql = "SELECT id, nome, descricao, preco, categoria, imagem FROM produtos";

    if ($categoria) {
        // Se uma categoria foi especificada, adiciona uma cláusula WHERE
        $sql .= " WHERE categoria = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$categoria]);
    } else {
        // Se nenhuma categoria foi especificada, busca todos os produtos
        $stmt = $pdo->query($sql);
    }

    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($produtos);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao buscar produtos.']);
}
?>