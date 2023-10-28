-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 28/10/2023 às 21:37
-- Versão do servidor: 8.0.33
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `p2_php`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens`
--

CREATE TABLE `itens` (
                         `id` int NOT NULL,
                         `nome` varchar(300) NOT NULL,
                         `finalizado` tinyint(1) NOT NULL DEFAULT (false),
                         `lista_id` int NOT NULL,
                         `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                         `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `itens`
--

INSERT INTO `itens` (`id`, `nome`, `finalizado`, `lista_id`, `created_at`, `updated_at`) VALUES
                                                                                             (1, 'ITEM', 1, 65, '2023-10-25 18:10:48', '2023-10-25 18:10:48'),
                                                                                             (2, 'ITEM', 1, 65, '2023-10-25 18:10:55', '2023-10-25 18:10:55'),
                                                                                             (3, 'sdfsdf', 0, 65, '2023-10-25 18:11:36', '2023-10-28 20:21:35'),
                                                                                             (4, 'dfsf', 1, 65, '2023-10-25 18:14:55', '2023-10-27 01:11:56'),
                                                                                             (5, 'sdfsdf', 1, 65, '2023-10-25 18:16:48', '2023-10-27 01:11:36'),
                                                                                             (6, 'asdasdasd', 0, 64, '2023-10-25 18:17:01', '2023-10-25 18:17:01'),
                                                                                             (7, 'asdasdasd', 0, 64, '2023-10-25 18:17:12', '2023-10-25 18:17:12'),
                                                                                             (8, 'sdfsdf', 0, 64, '2023-10-25 18:21:14', '2023-10-25 18:21:14'),
                                                                                             (9, 'dsffsdf', 1, 65, '2023-10-25 18:21:19', '2023-10-27 01:11:36'),
                                                                                             (10, 'asdasd', 1, 65, '2023-10-25 18:22:07', '2023-10-27 01:11:35'),
                                                                                             (11, 'asdsadasd', 0, 64, '2023-10-25 18:22:12', '2023-10-25 18:22:12'),
                                                                                             (12, 'asdsadasd', 0, 64, '2023-10-25 18:22:18', '2023-10-25 18:22:18'),
                                                                                             (13, 'asdsadasd', 0, 64, '2023-10-25 18:22:18', '2023-10-25 18:22:18'),
                                                                                             (14, 'asdsadasd', 0, 64, '2023-10-25 18:22:18', '2023-10-25 18:22:18'),
                                                                                             (15, 'asdsadasd', 1, 64, '2023-10-25 18:22:19', '2023-10-28 20:22:54'),
                                                                                             (16, 'asdsadasd', 0, 64, '2023-10-25 18:22:19', '2023-10-25 18:22:19'),
                                                                                             (17, 'asdsadasd', 0, 64, '2023-10-25 18:22:19', '2023-10-25 18:22:19'),
                                                                                             (18, 'asdsadasd', 0, 64, '2023-10-25 18:22:19', '2023-10-25 18:22:19'),
                                                                                             (19, 'asdsadasd', 0, 64, '2023-10-25 18:22:19', '2023-10-25 18:22:19'),
                                                                                             (20, 'ITEM', 1, 65, '2023-10-25 18:22:23', '2023-10-25 18:22:23'),
                                                                                             (33, 'ITEM', 1, 65, '2023-10-26 19:15:45', '2023-10-27 01:11:35'),
                                                                                             (54, 'sdffsdsdf', 1, 65, '2023-10-27 01:08:00', '2023-10-27 01:11:33'),
                                                                                             (55, 'jordan', 1, 65, '2023-10-27 01:08:08', '2023-10-27 01:11:32'),
                                                                                             (77, 'Pão', 1, 70, '2023-10-27 03:23:04', '2023-10-27 03:24:14'),
                                                                                             (78, 'Ovo', 1, 70, '2023-10-27 03:23:10', '2023-10-27 03:24:11'),
                                                                                             (90, 'asasda', 0, 68, '2023-10-28 02:01:46', '2023-10-28 02:01:46'),
                                                                                             (91, 'asasda', 1, 68, '2023-10-28 02:01:47', '2023-10-28 02:01:54'),
                                                                                             (92, 'asasda', 1, 68, '2023-10-28 02:01:47', '2023-10-28 02:01:53'),
                                                                                             (93, 'asasda', 1, 68, '2023-10-28 02:01:47', '2023-10-28 02:01:54'),
                                                                                             (94, 'asasda', 1, 68, '2023-10-28 02:01:47', '2023-10-28 02:01:55'),
                                                                                             (95, 'asasda', 0, 68, '2023-10-28 02:01:47', '2023-10-28 02:01:47'),
                                                                                             (96, 'asasda', 0, 68, '2023-10-28 02:01:47', '2023-10-28 02:01:47'),
                                                                                             (97, 'asasda', 0, 68, '2023-10-28 02:01:47', '2023-10-28 02:01:47'),
                                                                                             (98, 'asasda', 1, 68, '2023-10-28 02:01:48', '2023-10-28 02:01:53'),
                                                                                             (120, 'fsdfdsfsdf', 0, 80, '2023-10-28 19:40:31', '2023-10-28 19:40:31'),
                                                                                             (122, 'fsdfdsfsdf', 0, 80, '2023-10-28 19:40:32', '2023-10-28 19:40:32'),
                                                                                             (123, 'fsdfdsfsdf', 0, 80, '2023-10-28 19:40:32', '2023-10-28 19:40:32'),
                                                                                             (124, 'fsdfdsfsdf', 0, 80, '2023-10-28 19:40:32', '2023-10-28 19:40:32'),
                                                                                             (125, 'fsdfdsfsdf', 0, 80, '2023-10-28 19:40:32', '2023-10-28 19:40:32');

-- --------------------------------------------------------

--
-- Estrutura para tabela `listas`
--

CREATE TABLE `listas` (
                          `id` int NOT NULL,
                          `titulo` varchar(50) NOT NULL,
                          `user_id` int NOT NULL,
                          `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                          `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `listas`
--

INSERT INTO `listas` (`id`, `titulo`, `user_id`, `created_at`, `updated_at`) VALUES
                                                                                 (64, 'Um título', 22, '2023-10-24 12:42:18', '2023-10-28 19:21:33'),
                                                                                 (65, 'Um títuloq', 22, '2023-10-25 17:38:50', '2023-10-25 17:38:50'),
                                                                                 (68, 'Um títuASDASDlo', 22, '2023-10-26 23:07:44', '2023-10-26 23:07:44'),
                                                                                 (70, 'Lista de compras', 23, '2023-10-27 03:22:51', '2023-10-27 03:22:51'),
                                                                                 (72, 'compras', 26, '2023-10-28 00:55:51', '2023-10-28 00:55:51'),
                                                                                 (75, 'testea', 22, '2023-10-28 17:01:07', '2023-10-28 17:36:54'),
                                                                                 (79, 'aaA', 23, '2023-10-28 19:26:27', '2023-10-28 19:26:27'),
                                                                                 (80, 'aaa', 24, '2023-10-28 19:29:06', '2023-10-28 19:29:06'),
                                                                                 (83, 'asdasd', 22, '2023-10-28 21:06:22', '2023-10-28 21:06:22'),
                                                                                 (84, 'sdasdasd', 22, '2023-10-28 21:06:25', '2023-10-28 21:06:25'),
                                                                                 (85, 'aaaa', 22, '2023-10-28 21:07:12', '2023-10-28 21:07:12'),
                                                                                 (86, 'asasasas', 22, '2023-10-28 21:07:15', '2023-10-28 21:07:15'),
                                                                                 (87, '231423434', 22, '2023-10-28 21:07:18', '2023-10-28 21:07:18'),
                                                                                 (88, '234234', 22, '2023-10-28 21:07:20', '2023-10-28 21:07:20'),
                                                                                 (89, '423423424', 22, '2023-10-28 21:07:23', '2023-10-28 21:07:23'),
                                                                                 (90, '234234234', 22, '2023-10-28 21:07:25', '2023-10-28 21:07:25'),
                                                                                 (91, '123123123', 22, '2023-10-28 21:07:29', '2023-10-28 21:07:29'),
                                                                                 (92, 'edfsdf', 22, '2023-10-28 21:21:37', '2023-10-28 21:21:37'),
                                                                                 (93, 'e564y', 22, '2023-10-28 21:21:41', '2023-10-28 21:21:41'),
                                                                                 (94, 'as', 22, '2023-10-28 21:21:48', '2023-10-28 21:21:48'),
                                                                                 (95, '6767', 22, '2023-10-28 21:21:53', '2023-10-28 21:21:53'),
                                                                                 (96, '67678', 22, '2023-10-28 21:21:58', '2023-10-28 21:21:58'),
                                                                                 (97, '45', 22, '2023-10-28 21:22:01', '2023-10-28 21:22:01'),
                                                                                 (98, '664', 22, '2023-10-28 21:22:03', '2023-10-28 21:22:03');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
                         `id` int NOT NULL,
                         `nome` varchar(255) NOT NULL,
                         `email` varchar(255) NOT NULL,
                         `senha` varchar(400) NOT NULL,
                         `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                         `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `nome`, `email`, `senha`, `created_at`, `updated_at`) VALUES
                                                                                     (22, 'jordan', 'jordan@gmail.com', '$2y$10$yUOUrdO34V4x/pJHCj2l.uNH0YStjT3XxuLlAzwr2o7kzdlcynWBq', '2023-10-21 02:33:50', '2023-10-21 02:33:50'),
                                                                                     (23, 'Amanda', 'amanda@gmail.com', '$2y$10$7A074n8at7w9dNDq4ixhieb25ZmE6ov6BIznF8mYjWOl9xgj3KDeC', '2023-10-21 15:26:37', '2023-10-21 15:26:37'),
                                                                                     (24, 'Amanda Ester Sarri Rosa', 'amanda2@gmail.com', '$2y$10$Zh4e3NqVFqqKwuXP/kFs3uCHHsscBGFIU5tVgbmDELywjeLldRZE6', '2023-10-21 15:27:22', '2023-10-21 15:27:22'),
                                                                                     (25, 'sdfsdf', 'jordandouglas8515@gmail.com', '$2y$10$Xk3nvSmOISgZbTg5VeqK4eiyXtMUNosLVmmAWlCh44waA3mWqunlO', '2023-10-28 00:50:57', '2023-10-28 00:50:57'),
                                                                                     (26, 'Amanda Ester Sarri Rosa', 'teste@gmail.com', '$2y$10$I83243KSdiWILgLbc1WJ8.wXfNvsOfna5Qz4WGFuSBe93f6CiEFo6', '2023-10-28 00:55:18', '2023-10-28 00:55:18'),
                                                                                     (27, 'assadasd', 'sarriribeiro@gmail.com', '$2y$10$kapwlrgdpAdY5spSk1PG9uDN/0sVIpon4x6vMWcaKwVN2Zw5guBly', '2023-10-28 01:27:17', '2023-10-28 01:27:17');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `itens`
--
ALTER TABLE `itens`
    ADD PRIMARY KEY (`id`),
    ADD KEY `lista_id` (`lista_id`);

--
-- Índices de tabela `listas`
--
ALTER TABLE `listas`
    ADD PRIMARY KEY (`id`),
    ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `itens`
--
ALTER TABLE `itens`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT de tabela `listas`
--
ALTER TABLE `listas`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `itens`
--
ALTER TABLE `itens`
    ADD CONSTRAINT `itens_ibfk_1` FOREIGN KEY (`lista_id`) REFERENCES `listas` (`id`);

--
-- Restrições para tabelas `listas`
--
ALTER TABLE `listas`
    ADD CONSTRAINT `listas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
