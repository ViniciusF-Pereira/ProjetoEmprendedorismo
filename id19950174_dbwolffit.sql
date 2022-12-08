-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 08-Dez-2022 às 03:31
-- Versão do servidor: 10.5.16-MariaDB
-- versão do PHP: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `id19950174_dbwolffit`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administrador`
--

CREATE TABLE `administrador` (
  `id_admin` int(11) NOT NULL,
  `senha_admin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_admin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpf` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `administrador`
--

INSERT INTO `administrador` (`id_admin`, `senha_admin`, `login_admin`, `cpf`, `nome`, `id_number`, `id_hash`) VALUES
(1, '$argon2i$v=19$m=65536,t=4,p=1$SElUWTdjM1ptMDd0VHZNMg$5sxj88xZOQut6gRUDkykNTrq4x4V8pDIOXM2johG7hM', 'admin@admin.com', '4095666', 'Vinicius de freitas', '1399111536', '$argon2i$v=19$m=65536,t=4,p=1$L1g0eG9TTDVhQUhvWm5jQw$qCopwtdZQO0kERvJd5G7MhezmpNCMep35/B5HUXXcHs');

-- --------------------------------------------------------

--
-- Estrutura da tabela `carousels`
--

CREATE TABLE `carousels` (
  `id` int(11) NOT NULL,
  `nome` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `imagem` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `titulo_lat` varchar(220) COLLATE utf8_unicode_ci NOT NULL,
  `texto_lat` text COLLATE utf8_unicode_ci NOT NULL,
  `ordem` int(11) NOT NULL,
  `situacao_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `carousels`
--

INSERT INTO `carousels` (`id`, `nome`, `imagem`, `titulo_lat`, `texto_lat`, `ordem`, `situacao_id`, `created`, `modified`) VALUES
(1, 'whey', 'https://github.com/Wolf-Fit/imgs_db/blob/main/whey/whey_wolffit.png?raw=true', 'Whey Protein', 'Whey Protein é um suplemento proteico feito a partir da proteína extraída do soro do leite, composta principalmente por alfa-globulina e beta-globulina. O produto possui aminoácidos essenciais que são rapidamente absorvidos pelo corpo, substâncias que participam de forma ativa na construção de músculos e tecidos.\"', 1, 1, '2018-09-23 00:00:00', NULL),
(2, 'CREATINA WOLF FIT', 'https://github.com/Wolf-Fit/imgs_db/blob/main/creatina/creatina.png?raw=true', 'CREATINA WOLF FIT', 'A creatina é uma molécula encontrada naturalmente no tecido muscular, em quantidade limitada, que participa de todos os processos energéticos do corpo. Ela é fundamental na contração muscular, proporcionando maior força muscular, resistência física, redução no tempo de recuperação, e aumento', 2, 1, '2018-09-23 00:00:00', NULL),
(3, 'CAMISETA WOLFFIT', 'https://github.com/Wolf-Fit/imgs_db/blob/main/roupas/camisetas/camiseta_wolffit_basica.png?raw=true', 'CAMISETA WOLFFIT', 'Seja qual for a estação do ano, manter o corpo seco e confortável com vestimentas certas é essencial para o nosso bem-estar! E a boa notícia é que já não dependemos apenas de temperaturas e climas agradáveis para isso, pois já existem tecidos inteligentes e com tecnologia que oferecem uma lista de benefícios incríveis para o nosso corpo, como as populares camisetas Dry Fit. Acompanhe a leitura e saiba tudo sobre a tecnologia dry fit, dicas de looks e como usar em todas as estações.', 3, 1, '2018-09-23 00:00:00', NULL),
(4, 'Halter', 'https://github.com/Wolf-Fit/imgs_db/blob/main/equipamentos/halteres/halter.png?raw=true', 'Halter', 'O Halter possui formato anatômico e o revestimento protege a pele das mãos do atrito e oferece maior aderência no uso e conforto na prática. O acessório é ideal para treinos com o objetivo de condicionamento físico e fortalecimento muscular.', 4, 1, '2018-09-23 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `enderecos`
--

CREATE TABLE `enderecos` (
  `id_endereco` int(11) NOT NULL,
  `nome_endereco` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cep` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logradouro` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `complemento` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `principal` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `enderecos`
--

INSERT INTO `enderecos` (`id_endereco`, `nome_endereco`, `cep`, `logradouro`, `complemento`, `usuario_id`, `principal`) VALUES
(38, 'casa', '04850100', 'Rua São Salvador da Torre', '22', 50, 1),
(39, 'tran', '04850100', 'Rua São Salvador da Torre', '222', 50, 1),
(40, 'tran', '04850100', 'Rua São Salvador da Torre', '222', 50, 1),
(41, 'casa', '04850100', 'Rua São Salvador da Torre', '3', 52, 0),
(42, 'casa', '68904-329', 'Avenida Laudelino Araújo Corrêa', '44', 52, 0),
(43, 'casa', '04850100', 'Rua São Salvador da Torre', '55', 52, 0),
(44, 'casa', '04850100', 'Rua São Salvador da Torre', '55', 52, 0),
(45, 'novo', '04850100', 'Rua São Salvador da Torre', '11', 52, 1),
(46, 'novo', '04850100', 'Rua São Salvador da Torre', '11', 52, 0),
(47, 'novo', '04850100', 'Rua São Salvador da Torre', '11', 52, 0),
(48, 'novo', '68904-329', 'Avenida Laudelino Araújo Corrêa', '1234', 52, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id_produtos` int(11) NOT NULL,
  `nome_produtos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preco_produtos` float(10,2) NOT NULL,
  `preco_promo` double DEFAULT NULL,
  `descricao_produtos` varchar(355) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_produtos` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `img_produtos2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_produtos` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id_produtos`, `nome_produtos`, `preco_produtos`, `preco_promo`, `descricao_produtos`, `tipo_produtos`, `created`, `modified`, `img_produtos2`, `img_produtos`) VALUES
(1, 'whey', 99.00, NULL, 'whey whey', 'WHEY', '2022-11-06', '2022-11-06', '', 'https://github.com/Wolf-Fit/imgs_db/blob/main/whey/whey_wolffit.png?raw=true'),
(2, 'creatina', 100.00, NULL, 'creatina creatina', 'creatina', '2022-11-06', '2022-11-06', '', 'https://github.com/Wolf-Fit/imgs_db/blob/main/creatina/creatina.png?raw=true'),
(5, 'CAMISETA WOLFFIT', 70.00, NULL, 'Seja qual for a estação do ano, manter o corpo seco e confortável com vestimentas certas é essencial para o nosso bem-estar! E a boa notícia é que já não dependemos apenas de temperaturas e climas agradáveis para isso, pois já existem tecidos inteligentes e com tecnologia que oferecem uma lista de benefícios incríveis para o nosso corpo, como as popular', 'roupa', '2022-11-06', '2022-11-06', '', 'https://github.com/Wolf-Fit/imgs_db/blob/main/roupas/camisetas/camiseta_wolffit_basica.png?raw=true'),
(6, 'whey', 100.00, 55.55, 'whey whey', 'WHEY', '2022-11-06', '2022-11-06', '', 'https://github.com/Wolf-Fit/imgs_db/blob/main/whey/whey_wolffit.png?raw=true'),
(7, 'whey', 100.00, NULL, 'whey whey', 'WHEY', '2022-11-06', '2022-11-06', '', 'https://github.com/Wolf-Fit/imgs_db/blob/main/whey/whey_wolffit.png?raw=true'),
(8, 'whey', 100.00, 25, 'whey whey', 'WHEY', '2022-11-06', '2022-11-06', '', 'https://github.com/Wolf-Fit/imgs_db/blob/main/whey/whey_wolffit.png?raw=true'),
(9, 'creatina', 100.00, NULL, 'creatina creatina', 'creatina', '2022-11-06', '2022-11-06', '', 'https://github.com/Wolf-Fit/imgs_db/blob/main/creatina/creatina.png?raw=true'),
(10, 'creatina', 100.00, 2, 'creatina creatina', 'creatina', '2022-11-06', '2022-11-06', '', 'https://github.com/Wolf-Fit/imgs_db/blob/main/creatina/creatina.png?raw=true'),
(11, 'whey', 100.00, NULL, 'whey whey', 'WHEY', '2022-11-06', '2022-11-06', '', 'https://github.com/Wolf-Fit/imgs_db/blob/main/whey/whey_wolffit.png?raw=true'),
(12, 'whey', 99.50, NULL, 'whey whey', 'WHEY', '2022-11-06', '2022-11-06', '', 'https://github.com/Wolf-Fit/imgs_db/blob/main/whey/whey_wolffit.png?raw=true');

-- --------------------------------------------------------

--
-- Estrutura da tabela `situacao`
--

CREATE TABLE `situacao` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpf` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha_usuario` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_endereco` int(11) DEFAULT NULL,
  `id_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0,
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `cpf`, `usuario`, `senha_usuario`, `id_endereco`, `id_number`, `id_hash`, `isAdmin`, `created`, `modified`) VALUES
(1, 'Vinicius de freitas', '4095666', 'admin@admin.com', '$argon2i$v=19$m=65536,t=4,p=1$ZHEuVGRuZHgudWl6aDd3bQ$eK9rf6yK6o3c3Df+xYRvo/szCqVyYquXOMukN1pdi8g', 34, '1399111536', '$argon2i$v=19$m=65536,t=4,p=1$L1g0eG9TTDVhQUhvWm5jQw$qCopwtdZQO0kERvJd5G7MhezmpNCMep35/B5HUXXcHs', 1, NULL, NULL),
(50, 'VINICIUS DE FREITAS PEREIRA', '000', '000@123.com', '$2y$10$yilMDBwG8g7n5TO0nQtLyuTL5ARV8VYJABdn2KHOSQL2V1hRdCPK6', NULL, '195373516', '$2y$10$Kwor6h30EY3nBDUpYmWio.vo/3x6LhhH473M4Jws9Sdc8fbSanAsO', 0, NULL, NULL),
(51, 'Mario', '12121212', 'mario@gmail.com', '$2y$10$J.ithPRw/keCeDDQk3G69eFx88cVdJ6cBCl8827CZUUv1AbXNS10y', NULL, '546189273', '$2y$10$SnKeQj2U6vzBdy.UMqeoP.86Fv1Bw2pey6PFHJBJsZz2VyfKjEbwy', 0, NULL, NULL),
(52, 'VINICIUS DE FREITAS PEREIRA', 'teste1', '0001@123.com', '$2y$10$00sQLiKCDn.82kpEr19SVOw2f/sNnD8yxksoOx8ZdfKn9GEUxu2mG', 45, '131518974', '$2y$10$0LrkEgLE6O2NDD/wARcv7u0kGErvH0jNyqUqEyQ0A6LGuGBSrcCkq', 0, NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_admin`);

--
-- Índices para tabela `carousels`
--
ALTER TABLE `carousels`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD PRIMARY KEY (`id_endereco`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produtos`);

--
-- Índices para tabela `situacao`
--
ALTER TABLE `situacao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `carousels`
--
ALTER TABLE `carousels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `enderecos`
--
ALTER TABLE `enderecos`
  MODIFY `id_endereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produtos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `situacao`
--
ALTER TABLE `situacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
