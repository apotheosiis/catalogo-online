-- TechShop - Script de Banco de Dados Completo
-- Versão: 2.1
-- Data: 23 de Setembro de 2025

--
-- Criação e seleção da Base de Dados
--
CREATE DATABASE IF NOT EXISTS `catalogo_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `catalogo_db`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--
DROP TABLE IF EXISTS `produtos`;
CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `categoria` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'default.jpg',
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Inserindo dados de exemplo na tabela `produtos`
--
INSERT INTO `produtos` (`id`, `nome`, `descricao`, `preco`, `categoria`, `imagem`, `data_criacao`) VALUES
(1, 'Mouse Gamer RGB', 'Mouse óptico com 16.000 DPI e iluminação RGB personalizável.', '250.50', 'Periféricos', 'mouse.jpg', NOW()),
(2, 'Teclado Mecânico Pro', 'Teclado mecânico com switches Cherry MX, layout ABNT2 e backlight.', '499.99', 'Periféricos', 'teclado.jpg', NOW()),
(3, 'SSD 1TB NVMe', 'Unidade de estado sólido de alta velocidade para performance máxima.', '650.00', 'Hardware', 'ssd.jpg', NOW()),
(4, 'HD Externo 2TB', 'Disco rígido externo portátil com conexão USB 3.0.', '350.75', 'Acessórios', 'hd.jpg', NOW()),
(5, 'Headset Gamer 7.1', 'Fone de ouvido com som surround 7.1 e microfone com cancelamento de ruído.', '420.00', 'Periféricos', 'fone.jpg', NOW()),
(6, 'Monitor 27\" 4K', 'Monitor profissional com resolução 4K, painel IPS e 99% sRGB.', '1899.90', 'Periféricos', 'monitor.jpg', NOW());

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios` (APENAS para administradores)
--
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Inserindo o usuário administrador padrão. Senha: 'admin123'
--
INSERT INTO `usuarios` (`id`, `username`, `password_hash`, `data_criacao`) VALUES
(1, 'admin', '$2y$10$wT/N5N20L5F0Lz2n.y9h..P/D.w3s3r4o5u6v7x8y9z0a1b2', NOW());

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes` (para os usuários da loja)
--
DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinhos`
--
DROP TABLE IF EXISTS `carrinhos`;
CREATE TABLE `carrinhos` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_modificacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho_itens`
--
DROP TABLE IF EXISTS `carrinho_itens`;
CREATE TABLE `carrinho_itens` (
  `id` int(11) NOT NULL,
  `carrinho_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para as tabelas
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);
ALTER TABLE `carrinhos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cliente_id` (`cliente_id`);
ALTER TABLE `carrinho_itens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `carrinho_produto` (`carrinho_id`,`produto_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- AUTO_INCREMENT para as tabelas
--
ALTER TABLE `produtos` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
ALTER TABLE `usuarios` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `clientes` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `carrinhos` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `carrinho_itens` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Adicionando Foreign Keys (relações entre tabelas)
--
ALTER TABLE `carrinhos`
  ADD CONSTRAINT `carrinhos_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `carrinho_itens`
  ADD CONSTRAINT `carrinho_itens_ibfk_1` FOREIGN KEY (`carrinho_id`) REFERENCES `carrinhos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carrinho_itens_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;