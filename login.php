<?php
session_start();
// Se o usuário já estiver logado, redireciona para o CRUD
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: crud.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Área Administrativa</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .login-container { background-color: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 300px; }
        h1 { text-align: center; color: #333; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"], input[type="password"] { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        button:hover { background-color: #0056b3; }
        .error { color: red; text-align: center; margin-bottom: 1rem; }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Admin Login</h1>
        <?php
        if (isset($_GET['error']) && $_GET['error'] === 'invalid') {
            echo '<p class="error">Usuário ou senha inválidos.</p>';
        }
        ?>
        <form action="auth.php" method="POST">
            <label for="username">Usuário:</label>
            <input type="text" name="username" id="username" required>
            <label for="password">Senha:</label>
            <input type="password" name="password" id="password" required>
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>