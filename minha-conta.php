<?php
session_start();

if (!isset($_SESSION['cliente_loggedin']) || $_SESSION['cliente_loggedin'] !== true) {
    header('Location: login_cliente.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Conta - TechShop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <div class="header-top-bar">
        <div class="container">
            <nav class="top-bar-nav">
                <a href="minha-conta.php"><i class="fas fa-user"></i> <span>Olá, <?php echo htmlspecialchars(explode(' ', $_SESSION['cliente_nome'])[0]); ?></span></a>
                <a href="logout_cliente.php"><i class="fas fa-sign-out-alt"></i> <span>Sair</span></a>
                <a href="carrinho.php"><i class="fas fa-shopping-cart"></i> <span>Carrinho</span></a>
                <div class="contact-link-wrapper">
                    <a href="#"><i class="fas fa-phone-alt"></i> <span>Contato</span></a>
                    <div class="contact-tooltip">
                        <h4>Fale conosco:</h4>
                        <p><strong>Telefone:</strong><br>(00) 0000-0000</p>
                        <p><strong>Whatsapp:</strong><br>(77) 77777-7777</p>
                        <p><strong>E-mail:</strong><br>default@default.com</p>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <header class="header">
        <div class="container">
            <a href="index.php" style="text-decoration: none; color: inherit;"><h1>TechShop</h1></a>
        </div>
    </header>

    <main class="container" style="padding: 2rem 0;">
        <a href="index.php" class="btn-voltar" style="margin-bottom: 2rem; display: inline-block; text-decoration: none; background-color: #6c757d; color: white; padding: 0.5rem 1rem; border-radius: 6px; transition: background-color 0.2s;">&larr; Voltar para a loja</a>
        <h1>Minha Conta</h1>
        <p>Bem-vindo, <?php echo htmlspecialchars($_SESSION['cliente_nome']); ?>!</p>
        <p>Aqui você poderá ver seu histórico de pedidos e alterar seus dados.</p>
        <p>Funcionalidade em desenvolvimento.</p>
    </main>
    
    <footer class="footer">
        <div class="container">
            <div class="footer-main">
                <div class="footer-column">
                    <h4>Institucional</h4>
                    <ul>
                        <li><a href="#">Sobre nós</a></li>
                        <li><a href="#">Fale Conosco</a></li>
                        <li><a href="#">Políticas de Devolução</a></li>
                        <li><a href="#">Política de Privacidade</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Redes Sociais</h4>
                    <div class="social-icons">
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="Youtube"><i class="fab fa-youtube"></i></a>
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                        <a href="#" aria-label="Whatsapp"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="footer-column">
                    <h4>Formas de Pagamento</h4>
                    <div class="payment-icons">
                        <i class="fab fa-cc-visa" aria-label="Visa"></i>
                        <i class="fab fa-cc-mastercard" aria-label="Mastercard"></i>
                    </div>
                </div>
                 <div class="footer-column">
                    <h4>Atendimento</h4>
                     <p style="color: #adb5bd;">Segunda à Sexta<br>08:00h às 18:00h</p>
                </div>
            </div>
            <div class="footer-copyright">
                <p>&copy; <?php echo date('Y'); ?> TechShop - Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

</body>
</html>