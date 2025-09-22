<?php
session_start();

// Verifica se o usuário está logado. Se não, redireciona para a página de login.
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit; // É crucial parar a execução do script aqui
}
?>

<?php
// Simples "guarda" para futuras implementações de login
// session_start();
// if (!isset($_SESSION['loggedin'])) {
//     header('Location: login.php');
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Produtos</title>
    <style>
        /* Estilos básicos para o CRUD */
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1, h2 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        form { margin-bottom: 20px; padding: 20px; border: 1px solid #ccc; max-width: 500px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"], input[type="number"], textarea { width: 100%; padding: 8px; margin-bottom: 10px; }
        button { padding: 10px 15px; background-color: #28a745; color: white; border: none; cursor: pointer; }
        button.delete { background-color: #dc3545; }
        button.edit { background-color: #007bff; }
        .actions form { display: inline-block; }
        .actions button { padding: 5px 10px; }
        .back-link { display: block; margin-top: 20px; }
    </style>
</head>
<body>
    <h1>Gerenciamento de Produtos</h1>
    <a href="index.php" class="back-link">Voltar ao Catálogo</a>

    <h2>Adicionar / Editar Produto</h2>
    <form action="api/create.php" method="POST" id="productForm">
        <input type="hidden" name="id" id="productId">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>
        
        <label for="descricao">Descrição:</label>
        <textarea name="descricao" id="descricao" required></textarea>
        
        <label for="preco">Preço:</label>
        <input type="number" name="preco" id="preco" step="0.01" required>

        <label for="imagem">Nome do Arquivo da Imagem (ex: mouse.jpg):</label>
        <input type="text" name="imagem" id="imagem" required>
        
        <button type="submit" id="formButton">Adicionar Produto</button>
        <button type="button" onclick="clearForm()" style="background-color: #6c757d;">Cancelar Edição</button>
    </form>

    <h2>Produtos Existentes</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once 'config/db.php';
            $pdo = getDbConnection();
            $stmt = $pdo->query("SELECT id, nome, preco, descricao, imagem FROM produtos ORDER BY id DESC");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                echo "<td>R$ " . number_format($row['preco'], 2, ',', '.') . "</td>";
                echo "<td class='actions'>
                        <button class='edit' onclick='editProduct(" . json_encode($row) . ")'>Editar</button>
                        <form action='api/delete.php' method='POST' onsubmit='return confirm(\"Tem certeza?\");'>
                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                            <button type='submit' class='delete'>Excluir</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <script>
        function editProduct(product) {
            document.getElementById('productId').value = product.id;
            document.getElementById('nome').value = product.nome;
            document.getElementById('descricao').value = product.descricao;
            document.getElementById('preco').value = product.preco;
            document.getElementById('imagem').value = product.imagem;
            
            const form = document.getElementById('productForm');
            form.action = 'api/update.php';
            document.getElementById('formButton').textContent = 'Atualizar Produto';
            window.scrollTo(0, 0); // Rola para o topo para ver o formulário
        }

        function clearForm() {
            const form = document.getElementById('productForm');
            form.reset();
            document.getElementById('productId').value = '';
            form.action = 'api/create.php';
            document.getElementById('formButton').textContent = 'Adicionar Produto';
        }
    </script>
</body>
</html>