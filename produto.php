<?php
session_start();
require_once 'config/db.php';

// Pega o ID do produto da URL de forma segura
$produto_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if (!$produto_id) {
    header('Location: index.php');
    exit;
}

// Busca os detalhes do produto no banco de dados
$pdo = getDbConnection();
$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->execute([$produto_id]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

// Se o produto não for encontrado, redireciona para a home
if (!$produto) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($produto['nome']); ?> - TechShop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <div class="header-top-bar">
        <div class="container">
            <nav class="top-bar-nav">
                
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                    <a href="admin/crud.php"><i class="fas fa-user-shield"></i> <span>Painel Admin</span></a>
                    <a href="admin/logout.php"><i class="fas fa-sign-out-alt"></i> <span>Sair (Admin)</span></a>

                <?php elseif (isset($_SESSION['cliente_loggedin']) && $_SESSION['cliente_loggedin'] === true): ?>
                    <a href="minha-conta.php"><i class="fas fa-user"></i> <span>Olá, <?php echo htmlspecialchars(explode(' ', $_SESSION['cliente_nome'])[0]); ?></span></a>
                    <a href="logout_cliente.php"><i class="fas fa-sign-out-alt"></i> <span>Sair</span></a>
                
                <?php else: ?>
                    <a href="login_cliente.php"><i class="fas fa-user"></i> <span>Minha Conta</span></a>
                <?php endif; ?>
                
                <a href="<?php echo (isset($_SESSION['cliente_loggedin']) && $_SESSION['cliente_loggedin'] === true) ? 'carrinho.php' : 'login_cliente.php'; ?>">
                    <i class="fas fa-shopping-cart"></i> <span>Carrinho</span>
                </a>
                
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
            <p>Os melhores produtos de tecnologia você encontra aqui.</p>
        </div>
    </header>

    <main class="container">
        <a href="index.php" class="btn-voltar" style="margin: 2rem 0; display: inline-block; text-decoration: none; background-color: #6c757d; color: white; padding: 0.5rem 1rem; border-radius: 6px; transition: background-color 0.2s;">&larr; Voltar ao Catálogo</a>

        <div class="produto-container">
            <div class="produto-imagem-grande">
                <img src="imagens/<?php echo htmlspecialchars($produto['imagem']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
            </div>
            <div class="produto-detalhes">
                <h1><?php echo htmlspecialchars($produto['nome']); ?></h1>
                <p class="preco">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                <h2>Descrição</h2>
                <p class="descricao"><?php echo nl2br(htmlspecialchars($produto['descricao'])); ?></p>

                <div class="compra-box">
                    <label for="quantidade">Qtd:</label>
                    <input type="number" id="quantidade" value="1" min="1" class="quantidade-input">
                    <button class="btn btn-comprar" onclick="adicionarAoCarrinho(<?php echo $produto['id']; ?>)">
                        <i class="fas fa-shopping-cart"></i> Adicionar ao Carrinho
                    </button>
                </div>
            </div>
        </div>
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
                        <i class="fab fa-cc-amex" aria-label="American Express"></i>
                        <i class="fab fa-cc-paypal" aria-label="Paypal"></i>
                    </div>
                </div>
                 <div class="footer-column">
                    <h4>Atendimento</h4>
                     <p style="color: #adb5bd;">
                        Segunda à Sexta<br>
                        08:00h às 18:00h
                     </p>
                </div>
            </div>
            <div class="footer-copyright">
                <p>&copy; <?php echo date('Y'); ?> TechShop - Todos os direitos reservados. Projeto desenvolvido com tecnologia de ponta.</p>
            </div>
        </div>
    </footer>
    
    <script>
    function adicionarAoCarrinho(produtoId) {
        const quantidade = document.getElementById('quantidade').value;
        
        fetch('carrinho_api.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'add', produto_id: produtoId, quantidade: quantidade })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Produto adicionado ao carrinho com sucesso!');
            } else {
                if (data.redirect) {
                    // Redireciona para o login se não estiver logado
                    window.location.href = data.redirect;
                } else {
                    // Mostra outros erros
                    alert('Erro ao adicionar produto: ' + data.message);
                }
            }
        });
    }
    </script>
</body>
</html>