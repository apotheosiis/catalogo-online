<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Produtos de Tecnologia</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <div class="header-top-bar">
        <div class="container">
            <nav class="top-bar-nav">
                <a href="admin/login.php"><i class="fas fa-user"></i> <span>Minha Conta</span></a>
                <a href="#"><i class="fas fa-shopping-cart"></i> <span>Carrinho</span></a>
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
            <h1>TechShop</h1>
            <p>Os melhores produtos de tecnologia você encontra aqui.</p>
        </div>
    </header>

    <main class="container">
        <section class="filters">
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Buscar por nome ou descrição...">
            </div>
            <div class="sort-container">
                <label for="sortOptions">Ordenar por:</label>
                <select id="sortOptions">
                    <option value="name-asc">Nome (A-Z)</option>
                    <option value="name-desc">Nome (Z-A)</option>
                    <option value="price-asc">Preço (Menor)</option>
                    <option value="price-desc">Preço (Maior)</option>
                </select>
            </div>
        </section>

        <section class="categories">
            <nav class="categories-nav">
                <ul>
                    <li><a href="#">Acessórios</a></li>
                    <li><a href="#">Games</a></li>
                    <li><a href="#">Computadores</a></li>
                    <li><a href="#">Hardware</a></li>
                    <li><a href="#">Periféricos</a></li>
                </ul>
            </nav>
        </section>

        <section id="product-grid" class="product-grid">
            <p class="loading-message">Carregando produtos...</p>
        </section>
    </main>

    <section class="newsletter-signup">
        <div class="container">
            <h3>Receba nossas ofertas por e-mail!</h3>
            <p>Fique por dentro das últimas novidades e promoções exclusivas.</p>
            <form class="newsletter-form">
                <input type="email" placeholder="Digite seu melhor e-mail" required>
                <button type="submit">Enviar</button>
            </form>
        </div>
    </section>

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

    <script src="js/script.js"></script>
</body>
</html>