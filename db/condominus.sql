-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 25-Set-2024 às 12:00
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `condominus`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_chamado`
--

DROP TABLE IF EXISTS `tb_chamado`;
CREATE TABLE IF NOT EXISTS `tb_chamado` (
  `id_chamado` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_tecnico` int UNSIGNED NOT NULL,
  `id_usuario_solicitante` int UNSIGNED NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `dt_abertura` datetime NOT NULL,
  `status` int NOT NULL,
  `dt_fechamento` datetime DEFAULT NULL,
  PRIMARY KEY (`id_chamado`),
  KEY `tb_chamado_FKIndex1` (`id_usuario_solicitante`),
  KEY `tb_chamado_FKIndex2` (`id_tecnico`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `tb_chamado`
--

INSERT INTO `tb_chamado` (`id_chamado`, `id_tecnico`, `id_usuario_solicitante`, `descricao`, `dt_abertura`, `status`, `dt_fechamento`) VALUES
(1, 1, 3, 'Problema com a conexão de internet', '2024-09-22 10:00:00', 1, NULL),
(2, 2, 4, 'Manutenção de ar condicionado', '2024-09-23 14:30:00', 2, '2024-09-23 18:30:00'),
(3, 1, 5, 'Troca de lâmpada na garagem', '2024-09-24 09:00:00', 0, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_comentario`
--

DROP TABLE IF EXISTS `tb_comentario`;
CREATE TABLE IF NOT EXISTS `tb_comentario` (
  `id_comentario` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_tecnico` int UNSIGNED NOT NULL,
  `id_chamado` int UNSIGNED NOT NULL,
  `dt_comentario` datetime NOT NULL,
  `descricao` varchar(255) NOT NULL,
  PRIMARY KEY (`id_comentario`),
  KEY `tb_comentario_FKIndex1` (`id_chamado`),
  KEY `tb_comentario_FKIndex2` (`id_tecnico`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `tb_comentario`
--

INSERT INTO `tb_comentario` (`id_comentario`, `id_tecnico`, `id_chamado`, `dt_comentario`, `descricao`) VALUES
(1, 1, 1, '2024-09-22 12:00:00', 'Visitado o local, problema identificado. Solução em andamento.'),
(2, 2, 2, '2024-09-23 16:00:00', 'Ar condicionado consertado. Revisão recomendada em 6 meses.'),
(3, 1, 3, '2024-09-24 10:00:00', 'Lâmpada trocada com sucesso.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_condominio`
--

DROP TABLE IF EXISTS `tb_condominio`;
CREATE TABLE IF NOT EXISTS `tb_condominio` (
  `id_condominio` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `cep` varchar(255) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `numero` int UNSIGNED NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  PRIMARY KEY (`id_condominio`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `tb_condominio`
--

INSERT INTO `tb_condominio` (`id_condominio`, `nome`, `cep`, `rua`, `numero`, `cidade`, `estado`) VALUES
(1, 'admin', '00000-000', '00000', 0, '0', '0'),
(2, 'Condomínio Sol Nascente', '12345-678', '1', 123, 'São Paulo', 'SP'),
(3, 'Condomínio Luar do Mar', '87654-321', '2', 456, 'Rio de Janeiro', 'RJ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuario`
--

DROP TABLE IF EXISTS `tb_usuario`;
CREATE TABLE IF NOT EXISTS `tb_usuario` (
  `id_usuario` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_condominio` int UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(255) NOT NULL,
  `tipo_usuario` int UNSIGNED NOT NULL,
  `senha` varchar(255) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `tb_usuario_FKIndex1` (`id_condominio`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `tb_usuario`
--

INSERT INTO `tb_usuario` (`id_usuario`, `id_condominio`, `nome`, `email`, `telefone`, `tipo_usuario`, `senha`) VALUES
(1, 1, 'admin', 'admin@gmail.com', '(00) 0 0000-0000', 1, '21232f297a57a5a743894a0e4a801fc3'),
(2, 2, 'João Silva', 'joao@exemplo.com', '(11) 91234-5678', 1, 'e7d80ffeefa212b7c5c55700e4f7193e'),
(3, 2, 'Maria Oliveira', 'maria@exemplo.com', '(11) 99876-5432', 2, '3d7fcc75ff6bfcbc40127078aa3760d5'),
(4, 3, 'Carlos Souza', 'carlos@exemplo.com', '(21) 91234-5678', 1, '2de3dca5a6f506661af5884c103524f4'),
(5, 3, 'Ana Costa', 'ana@exemplo.com', '(21) 99876-5432', 2, '2a373ba1edce44b21d5e0679eafb584d');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
