<?php
session_start();
require_once 'config/db.php';

// REGRA DE NEGÓCIO: Se o cliente não estiver logado, redireciona para a página de login.
if (!isset($_SESSION['cliente_loggedin']) || $_SESSION['cliente_loggedin'] !== true) {
    header('Location: login_cliente.php');
    exit;
}

$cliente_id = $_SESSION['cliente_id'];
$pdo = getDbConnection();

// Busca os itens do carrinho juntando com a tabela de produtos para obter os detalhes
$sql = "SELECT ci.id as item_id, ci.quantidade, p.id as produto_id, p.nome, p.preco, p.imagem 
        FROM carrinho_itens ci
        JOIN produtos p ON ci.produto_id = p.id
        JOIN carrinhos c ON ci.carrinho_id = c.id
        WHERE c.cliente_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$cliente_id]);
$itens_carrinho = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total_carrinho = 0;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras - TechShop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/admin.css"> </head>
<body>
    
    <div class="header-top-bar">
        <div class="container">
            <nav class="top-bar-nav">
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): // Prioridade para o ADMIN ?>
                    <a href="admin/crud.php"><i class="fas fa-user-shield"></i> <span>Painel Admin</span></a>
                    <a href="admin/logout.php"><i class="fas fa-sign-out-alt"></i> <span>Sair (Admin)</span></a>

                <?php elseif (isset($_SESSION['cliente_loggedin']) && $_SESSION['cliente_loggedin'] === true): // Se não for admin, checa se é CLIENTE ?>
                    <a href="minha-conta.php"><i class="fas fa-user"></i> <span>Olá, <?php echo htmlspecialchars(explode(' ', $_SESSION['cliente_nome'])[0]); ?></span></a>
                    <a href="logout_cliente.php"><i class="fas fa-sign-out-alt"></i> <span>Sair</span></a>
                
                <?php else: // Se não for nenhum dos dois, é VISITANTE ?>
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
        </div>
    </header>

    <main class="container" style="padding: 2rem 0;">
        <div id="notification-container"></div>
        <a href="index.php" class="btn-voltar" style="margin-bottom: 2rem; display: inline-block; text-decoration: none; background-color: #6c757d; color: white; padding: 0.5rem 1rem; border-radius: 6px; transition: background-color 0.2s;">&larr; Continuar Comprando</a>
        <h1>Meu Carrinho</h1>

        <div id="carrinho-conteudo">
            <?php if (empty($itens_carrinho)): ?>
                <p style="margin-top: 2rem; font-size: 1.2rem;">Seu carrinho de compras está vazio.</p>
            <?php else: ?>
                <div class="table-wrapper">
                    <table class="tabela-carrinho">
                        <thead>
                            <tr>
                                <th colspan="2">Produto</th>
                                <th>Preço Unitário</th>
                                <th>Quantidade</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($itens_carrinho as $item): 
                                $subtotal = $item['preco'] * $item['quantidade'];
                                $total_carrinho += $subtotal;
                            ?>
                                <tr id="item-<?php echo $item['item_id']; ?>">
                                    <td><img src="imagens/<?php echo htmlspecialchars($item['imagem']); ?>" alt="<?php echo htmlspecialchars($item['nome']); ?>" width="80"></td>
                                    <td><a href="produto.php?id=<?php echo $item['produto_id']; ?>" style="text-decoration:none; color:inherit; font-weight:bold;"><?php echo htmlspecialchars($item['nome']); ?></a></td>
                                    <td>R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></td>
                                    <td>
                                        <input type="number" value="<?php echo $item['quantidade']; ?>" min="1" onchange="atualizarQuantidade(<?php echo $item['item_id']; ?>, this.value)" class="quantidade-input">
                                    </td>
                                    <td id="subtotal-<?php echo $item['item_id']; ?>">R$ <?php echo number_format($subtotal, 2, ',', '.'); ?></td>
                                    <td><button onclick="removerItem(<?php echo $item['item_id']; ?>)" title="Remover item" class="btn-remover-item">&times;</button></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="carrinho-total">
                    <h3>Total: <span id="total-carrinho">R$ <?php echo number_format($total_carrinho, 2, ',', '.'); ?></span></h3>
                    <button class="btn btn-comprar" style="width: 100%;" onclick="finalizarPedido()">Finalizar Pedido</button>
                </div>
            <?php endif; ?>
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

    <div id="success-modal" class="modal-overlay">
        <div class="modal-content">
            <svg class="checkmark-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                <circle class="checkmark-icon__circle" cx="26" cy="26" r="25" fill="none"/>
                <path class="checkmark-icon__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
            </svg>
            <h2>Solicitação Enviada!</h2>
            <p>Obrigado pela sua preferência! Recebemos seu pedido e entraremos em contato em breve para confirmar os detalhes.</p>
            <a href="index.php" class="btn btn-primary">Voltar ao Início</a>
        </div>
    </div>

    <script src="js/notifications.js"></script>
    <script>
        function atualizarQuantidade(itemId, quantidade) {
            fetch('carrinho_api.php', { 
                method: 'POST', 
                headers: { 'Content-Type': 'application/json' }, 
                body: JSON.stringify({ action: 'update', item_id: itemId, quantidade: quantidade }) 
            })
            .then(response => response.json())
            .then(data => { 
                if (data.success) { 
                    location.reload(); 
                } else { 
                    showNotification(data.message, 'error'); 
                } 
            });
        }

        function removerItem(itemId) {
            if (!confirm('Tem certeza que deseja remover este item?')) return;
            fetch('carrinho_api.php', { 
                method: 'POST', 
                headers: { 'Content-Type': 'application/json' }, 
                body: JSON.stringify({ action: 'remove', item_id: itemId }) 
            })
            .then(response => response.json())
            .then(data => { 
                if (data.success) { 
                    location.reload(); 
                } else { 
                    showNotification(data.message, 'error'); 
                } 
            });
        }
        
        function finalizarPedido() {
            // Primeiro, chama a API para limpar o carrinho no backend
            fetch('carrinho_api.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action: 'clear' })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Se a limpeza no backend deu certo, mostra o modal de sucesso
                    document.getElementById('success-modal').classList.add('show');

                    // Também limpa a visualização do carrinho na página para o usuário
                    const conteudoCarrinho = document.getElementById('carrinho-conteudo');
                    if (conteudoCarrinho) {
                        conteudoCarrinho.innerHTML = '<p style="margin-top: 2rem; font-size: 1.2rem;">Seu carrinho de compras está vazio.</p>';
                    }
                } else {
                    // Se deu erro, mostra uma notificação de erro
                    showNotification(data.message || 'Não foi possível finalizar o pedido.', 'error');
                }
            })
            .catch(error => {
                console.error('Erro ao finalizar pedido:', error);
                showNotification('Ocorreu um erro de comunicação.', 'error');
            });
        }
    </script>
</body>
</html>