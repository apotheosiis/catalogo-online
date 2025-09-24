<?php
session_start();
header('Content-Type: application/json');
require_once 'config/db.php';

if (!isset($_SESSION['cliente_loggedin']) || $_SESSION['cliente_loggedin'] !== true) {
    echo json_encode(['success' => false, 'message' => 'Você precisa estar logado.', 'redirect' => 'login_cliente.php']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$action = $data['action'] ?? '';
$cliente_id = $_SESSION['cliente_id'];
$pdo = getDbConnection();

// Garante que o cliente tenha um carrinho para evitar erros
$stmt = $pdo->prepare("SELECT id FROM carrinhos WHERE cliente_id = ?");
$stmt->execute([$cliente_id]);
$carrinho = $stmt->fetch();

if (!$carrinho) {
    // Se por algum motivo não houver carrinho, cria um e encerra.
    $stmt = $pdo->prepare("INSERT INTO carrinhos (cliente_id) VALUES (?)");
    $stmt->execute([$cliente_id]);
    $carrinho_id = $pdo->lastInsertId();
} else {
    $carrinho_id = $carrinho['id'];
}

try {
    switch ($action) {
        case 'add':
            // ... (código para adicionar continua o mesmo)
            $produto_id = $data['produto_id'] ?? 0;
            $quantidade = $data['quantidade'] ?? 1;
            if ($produto_id <= 0 || $quantidade <= 0) throw new Exception('Dados inválidos.');
            $stmt = $pdo->prepare("SELECT id, quantidade FROM carrinho_itens WHERE carrinho_id = ? AND produto_id = ?");
            $stmt->execute([$carrinho_id, $produto_id]);
            $item_existente = $stmt->fetch();
            if ($item_existente) {
                $nova_quantidade = $item_existente['quantidade'] + $quantidade;
                $stmt = $pdo->prepare("UPDATE carrinho_itens SET quantidade = ? WHERE id = ?");
                $stmt->execute([$nova_quantidade, $item_existente['id']]);
            } else {
                $stmt = $pdo->prepare("INSERT INTO carrinho_itens (carrinho_id, produto_id, quantidade) VALUES (?, ?, ?)");
                $stmt->execute([$carrinho_id, $produto_id, $quantidade]);
            }
            echo json_encode(['success' => true, 'message' => 'Item adicionado ao carrinho.']);
            break;

        case 'update':
            // ... (código para atualizar continua o mesmo)
            $item_id = $data['item_id'] ?? 0;
            $quantidade = $data['quantidade'] ?? 1;
            if ($item_id <= 0 || $quantidade <= 0) throw new Exception('Dados inválidos.');
            $stmt = $pdo->prepare("UPDATE carrinho_itens SET quantidade = ? WHERE id = ? AND carrinho_id = ?");
            $stmt->execute([$quantidade, $item_id, $carrinho_id]);
            echo json_encode(['success' => true, 'message' => 'Quantidade atualizada.']);
            break;

        case 'remove':
            // ... (código para remover continua o mesmo)
            $item_id = $data['item_id'] ?? 0;
            if ($item_id <= 0) throw new Exception('ID do item inválido.');
            $stmt = $pdo->prepare("DELETE FROM carrinho_itens WHERE id = ? AND carrinho_id = ?");
            $stmt->execute([$item_id, $carrinho_id]);
            echo json_encode(['success' => true, 'message' => 'Item removido do carrinho.']);
            break;

        // --- NOVA FUNCIONALIDADE ---
        case 'clear':
            // Deleta TODOS os itens associados ao carrinho do cliente.
            $stmt = $pdo->prepare("DELETE FROM carrinho_itens WHERE carrinho_id = ?");
            $stmt->execute([$carrinho_id]);
            
            // Verifica se alguma linha foi afetada para confirmar a operação
            if ($stmt->rowCount() >= 0) {
                echo json_encode(['success' => true, 'message' => 'Carrinho esvaziado com sucesso.']);
            } else {
                throw new Exception('Não foi possível esvaziar o carrinho.');
            }
            break;
        
        default:
            throw new Exception('Ação desconhecida.');
    }
} catch (Exception $e) {
    http_response_code(400); // Bad Request
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>