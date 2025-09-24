--
-- Base de Dados: `catalogo_db`
--
CREATE DATABASE IF NOT EXISTS `catalogo_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `catalogo_db`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--
CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `imagem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'default.jpg',
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Inserindo dados de exemplo na tabela `produtos`
--
INSERT INTO `produtos` (`nome`, `descricao`, `preco`, `imagem`) VALUES
('Mouse Gamer RGB', 'Mouse óptico com 16.000 DPI e iluminação RGB personalizável.', '250.50', 'mouse.jpg'),
('Teclado Mecânico Pro', 'Teclado mecânico com switches Cherry MX, layout ABNT2 e backlight.', '499.99', 'teclado.jpg'),
('SSD 1TB NVMe', 'Unidade de estado sólido de alta velocidade para performance máxima.', '650.00', 'ssd.jpg'),
('HD Externo 2TB', 'Disco rígido externo portátil com conexão USB 3.0.', '350.75', 'hd.jpg'),
('Headset Gamer 7.1', 'Fone de ouvido com som surround 7.1 e microfone com cancelamento de ruído.', '420.00', 'fone.jpg'),
('Monitor 27" 4K', 'Monitor profissional com resolução 4K, painel IPS e 99% sRGB.', '1899.90', 'monitor.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios` (APENAS para administradores)
--
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL UNIQUE,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Inserindo o usuário administrador padrão. Senha: 'admin123'
--
INSERT INTO `usuarios` (`id`, `username`, `password_hash`) VALUES
(1, 'admin', '$2y$10$3g0a.hJJn.o8fH7qR2h5n.vF8e0d1b.9w2g4c6i8j0k1l2m3n4O') 
ON DUPLICATE KEY UPDATE username='admin';


-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes` (para os usuários da loja)
--
CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL UNIQUE,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinhos`
--
CREATE TABLE `carrinhos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `cliente_id` (`cliente_id`),
  FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho_itens`
--
CREATE TABLE `carrinho_itens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `carrinho_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`carrinho_id`) REFERENCES `carrinhos` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE,
  UNIQUE KEY `carrinho_produto` (`carrinho_id`,`produto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Adicionando Índices para otimização
--
ALTER TABLE `produtos` ADD PRIMARY KEY (`id`);
ALTER TABLE `usuarios` ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);
ALTER TABLE