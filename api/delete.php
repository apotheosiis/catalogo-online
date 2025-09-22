<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../config/db.php';

    $id = $_POST['id'] ?? 0;

    if (empty($id)) {
        header('Location: ../crud.php?status=error&message=ID inválido.');
        exit;
    }

    try {
        $pdo = getDbConnection();
        $sql = "DELETE FROM produtos WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        
        header('Location: ../crud.php?status=success&message=Produto excluído com sucesso.');
    } catch (Exception $e) {
        header('Location: ../crud.php?status=error&message=Erro ao excluir produto.');
    }
}
?>