<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../config/db.php';

    // Variável com verificação de existência
    $id = $_POST['id'] ?? '';

    // Validação no lado do servidor (essencial!)
    if (empty($id)) {
        header('Location: ../admin/crud.php?status=error_no_id');
        exit;
    }

    try {
        $pdo = getDbConnection();
        $sql = "DELETE FROM produtos WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        
        // Redireciona para o caminho correto com um status de sucesso
        header('Location: ../admin/crud.php?status=success_delete');
        exit;
    } catch (Exception $e) {
        // Em caso de erro no banco, redireciona com status de erro
        header('Location: ../admin/crud.php?status=error_db');
        exit;
    }
}
?>