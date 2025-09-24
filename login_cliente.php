<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TechShop</title>
    <link rel="stylesheet" href="css/admin.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .login-box a { color: var(--admin-primary); text-decoration: none; }
        .login-box a:hover { text-decoration: underline; }
        .back-to-store { display: block; text-align: center; margin-bottom: 1.5rem; color: #6c757d; }
        .forgot-password { text-align: right; margin-top: -10px; margin-bottom: 20px; font-size: 0.9rem; }
        .divider { display: flex; align-items: center; text-align: center; color: #ccc; margin: 20px 0; }
        .divider::before, .divider::after { content: ''; flex: 1; border-bottom: 1px solid #eee; }
        .divider:not(:empty)::before { margin-right: .25em; }
        .divider:not(:empty)::after { margin-left: .25em; }
        .btn-google { background-color: #DB4437; color: white; display: flex; align-items: center; justify-content: center; gap: 10px; }
        .btn-google:hover { background-color: #c33b2e; }
        .register-link { text-align: center; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <a href="index.php" class="back-to-store">&larr; Voltar para a loja</a>
            <a href="index.php" style="font-size: 1.5rem; text-decoration:none; color: var(--admin-dark);"><h1>TechShop</h1></a>
            
            <div id="notification-container"></div>

            <form action="auth_cliente.php" method="POST">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" required>
                
                <label for="password">Senha:</label>
                <input type="password" name="password" id="password" required>
                
                <div class="forgot-password"><a href="#">Esqueceu a senha?</a></div>
                
                <button type="submit" class="btn btn-primary">Entrar</button>
            </form>
            <div class="divider">ou</div>
            <button class="btn btn-google"><i class="fab fa-google"></i> Entrar com Google</button>
            <p class="register-link">Não tem uma conta? <a href="registro.php">Cadastre-se</a></p>
        </div>
    </div>

    <script src="js/notifications.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const params = new URLSearchParams(window.location.search);
            if (params.has('error')) {
                showNotification('E-mail ou senha inválidos.', 'error');
            }
            if (params.get('success') === 'registered') {
                showNotification('Cadastro realizado com sucesso! Faça seu login.', 'success');
            }
        });
    </script>
</body>
</html>