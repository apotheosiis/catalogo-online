<?php
session_start();

// VERIFICAÇÃO ATUALIZADA
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: painel-acesso.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Gerenciamento de Produtos</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

    <header class="admin-header">
        <h1>Dashboard</h1>
        <div class="header-nav">
            <a href="../index.php" target="_blank" class="btn btn-secondary">Ver Site</a>
            <a href="logout.php" class="btn btn-danger">Sair</a>
        </div>
    </header>

    <main class="admin-main">
        <div id="notification-container"></div>

        <div class="card">
            <h2 id="form-title">Adicionar Novo Produto</h2>
            <form action="../api/create.php" method="POST" id="productForm">
                <input type="hidden" name="id" id="productId">

                <label for="nome">Nome do Produto:</label>
                <input type="text" name="nome" id="nome" required>

                <label for="descricao">Descrição:</label>
                <textarea name="descricao" id="descricao" rows="4" required></textarea>

                <label for="preco">Preço (ex: 1250.99):</label>
                <input type="number" name="preco" id="preco" step="0.01" required>

                <label for="imagem">Nome do Arquivo da Imagem (ex: mouse.jpg):</label>
                <input type="text" name="imagem" id="imagem" required>

                <div class="form-actions">
                    <button type="submit" id="formButton" class="btn btn-primary">Adicionar Produto</button>
                    <button type="button" onclick="clearForm()" class="btn btn-secondary">Cancelar Edição</button>
                </div>
            </form>
        </div>

        <div class="card">
            <h2>Produtos Cadastrados</h2>
            <div class="table-wrapper">
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
                        require_once '../config/db.php';
                        $pdo = getDbConnection();
                        $stmt = $pdo->query("SELECT id, nome, preco, descricao, imagem FROM produtos ORDER BY id DESC");
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                            echo "<td>R$ " . number_format($row['preco'], 2, ',', '.') . "</td>";
                            echo "<td class='actions'>
                                    <button class='btn btn-edit' onclick='editProduct(" . json_encode($row) . ")'>Editar</button>
                                    <form action='../api/delete.php' method='POST' onsubmit='return confirm(\"Tem certeza que deseja excluir este produto?\");'>
                                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                                        <button type='submit' class='btn btn-delete'>Excluir</button>
                                    </form>
                                  </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        function editProduct(product) {
            document.getElementById('productId').value = product.id;
            document.getElementById('nome').value = product.nome;
            document.getElementById('descricao').value = product.descricao;
            document.getElementById('preco').value = product.preco;
            document.getElementById('imagem').value = product.imagem;

            const form = document.getElementById('productForm');
            form.action = '../api/update.php';
            document.getElementById('formButton').textContent = 'Atualizar Produto';
            document.getElementById('form-title').textContent = 'Editar Produto: ' + product.nome;
            window.scrollTo(0, 0);
        }

        function clearForm() {
            const form = document.getElementById('productForm');
            form.reset();
            document.getElementById('productId').value = '';
            form.action = '../api/create.php';
            document.getElementById('formButton').textContent = 'Adicionar Produto';
            document.getElementById('form-title').textContent = 'Adicionar Novo Produto';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const params = new URLSearchParams(window.location.search);
            const status = params.get('status');

            if (status) {
                let message = '';
                let type = 'success';

                switch (status) {
                    case 'success_create':
                        message = 'Produto adicionado com sucesso!';
                        break;
                    case 'success_update':
                        message = 'Produto atualizado com sucesso!';
                        break;
                    case 'success_delete':
                        message = 'Produto excluído com sucesso!';
                        break;
                    case 'error_empty':
                        message = 'Erro: Todos os campos são obrigatórios.';
                        type = 'error';
                        break;
                    case 'error_db':
                        message = 'Erro: Ocorreu um problema com o banco de dados.';
                        type = 'error';
                        break;
                    default:
                        return;
                }

                const container = document.getElementById('notification-container');
                const notification = document.createElement('div');
                notification.className = `notification ${type}`;
                notification.textContent = message;

                container.appendChild(notification);

                setTimeout(() => {
                    notification.classList.add('show');
                }, 10);

                setTimeout(() => {
                    notification.classList.remove('show');
                    setTimeout(() => container.removeChild(notification), 500);
                }, 5000);

                history.replaceState(null, '', window.location.pathname);
            }
        });
    </script>
</body>
</html>