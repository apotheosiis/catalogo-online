-- Criação do banco de dados (opcional, pode ser criado manualmente)
CREATE DATABASE IF NOT EXISTS `catalogo_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `catalogo_db`;

-- Estrutura da tabela `produtos`
CREATE TABLE `produtos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `descricao` TEXT NOT NULL,
  `preco` DECIMAL(10, 2) NOT NULL,
  `imagem` VARCHAR(255) DEFAULT 'default.jpg',
  `data_criacao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Inserindo dados de exemplo
INSERT INTO `produtos` (`nome`, `descricao`, `preco`, `imagem`) VALUES
('Mouse Gamer RGB', 'Mouse óptico com 16.000 DPI e iluminação RGB personalizável.', 250.50, 'mouse.jpg'),
('Teclado Mecânico Pro', 'Teclado mecânico com switches Cherry MX, layout ABNT2 e backlight.', 499.99, 'teclado.jpg'),
('SSD 1TB NVMe', 'Unidade de estado sólido de alta velocidade para performance máxima.', 650.00, 'ssd.jpg'),
('HD Externo 2TB', 'Disco rígido externo portátil com conexão USB 3.0.', 350.75, 'hd.jpg'),
('Headset Gamer 7.1', 'Fone de ouvido com som surround 7.1 e microfone com cancelamento de ruído.', 420.00, 'fone.jpg'),
('Monitor 27" 4K', 'Monitor profissional com resolução 4K, painel IPS e 99% sRGB.', 1899.90, 'monitor.jpg');