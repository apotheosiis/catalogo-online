<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - TechShop</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <a href="index.php" style="display: block; text-align: center; margin-bottom: 1.5rem; color: #6c757d; text-decoration: none;">&larr; Voltar para a loja</a>
            <h1>Crie sua Conta</h1>
            
            <div id="notification-container"></div>

            <form action="registrar_cliente.php" method="POST">
                <label for="nome">Nome completo:</label>
                <input type="text" name="nome" id="nome" required>

                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" required>
                
                <label for="password">Senha:</label>
                <input type="password" name="password" id="password" required>
                
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </form>
            <p style="text-align: center; margin-top: 20px;">Já tem uma conta? <a href="login_cliente.php" style="color: var(--admin-primary); text-decoration: none;">Faça login</a></p>
        </div>
    </div>
    <script src="js/notifications.js"></script>
     <script>
        document.addEventListener('DOMContentLoaded', function() {
            const params = new URLSearchParams(window.location.search);
            if (params.get('error') === 'exists') {
                showNotification('Este e-mail já está cadastrado.', 'error');
            }
        });
    </script>
</body>
</html>