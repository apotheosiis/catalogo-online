<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: crud.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h1>Painel Administrativo</h1>
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
                <button type="submit" class="btn btn-primary">Entrar</button>
            </form>
        </div>
    </div>
</body>
</html>