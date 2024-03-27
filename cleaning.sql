-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 27 2024 г., 05:26
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cleaning`
--

-- --------------------------------------------------------

--
-- Структура таблицы `requests`
--

CREATE TABLE `requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `fio` varchar(255) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `service_type` varchar(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `price` float NOT NULL,
  `status` enum('В ожидании','Выполняется','Готов') NOT NULL DEFAULT 'В ожидании'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `requests`
--

INSERT INTO `requests` (`id`, `fio`, `product_description`, `service_type`, `order_date`, `price`, `status`) VALUES
(2, 'Петренко awdwadКонстантин Анатольевич', 'Sasha', '5', '2024-06-06 11:00:00', 229.99, 'В ожидании'),
(3, 'Петренко awdwadКонстантин Анатольевич', 'Sasha', '5', '2024-06-06 11:00:00', 229.99, 'Выполняется'),
(4, 'Петренко awdwadКонстантин Анатольевич', 'Sasha', '5', '2024-06-06 11:00:00', 229.99, 'В ожидании'),
(5, 'Петренко awdwadКонстантин Анатольевич', 'Sasha', '5', '2024-06-06 11:00:00', 229.99, 'В ожидании'),
(6, 'Петренко awdwadКонстантин Анатольевич', 'Sasha', '5', '2024-06-06 11:00:00', 229.99, 'В ожидании'),
(7, 'Петренко awdwadКонстантин Анатольевич', 'Sasha', '5', '2024-06-06 11:00:00', 229.99, 'В ожидании'),
(8, 'Петренко awdwadКонстантин Анатольевич', 'Sasha', '5', '2024-06-06 11:00:00', 229.99, 'В ожидании'),
(9, 'Петренко awdwadКонстантин Анатольевич', 'Sasha', '5', '2024-06-06 11:00:00', 229.99, 'В ожидании');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'Авторизованный пользователь'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Авторизованный пользователь'),
(2, 'Администратор');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`) VALUES
(5, 'sasha', 'Password1', 'sasha@mail.ru'),
(10, 'masha', 'Password1', 'masha@mail.ru'),
(11, 'hasah', 'Password1', 'hasha@mail.ru'),
(12, 'mama', 'mama', 'mama@mail.ru'),
(13, 'ashan', 'Password1', 'ashan@mail.ru'),
(14, 'nasha', 'Password1', 'nasha@mail.ru'),
(15, 'admin', 'admin', 'admin@mail.ru');

-- --------------------------------------------------------

--
-- Структура таблицы `user_requests`
--

CREATE TABLE `user_requests` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `request_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user_requests`
--

INSERT INTO `user_requests` (`user_id`, `request_id`) VALUES
(12, 0),
(12, 12),
(12, 13),
(12, 14),
(12, 15),
(14, 16),
(14, 17);

-- --------------------------------------------------------

--
-- Структура таблицы `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user_roles`
--

INSERT INTO `user_roles` (`id`, `user_id`, `role_id`) VALUES
(1, 13, 1),
(3, 13, 2),
(4, 14, 1),
(5, 15, 1),
(6, 15, 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `user_requests`
--
ALTER TABLE `user_requests`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `request_id` (`request_id`);

--
-- Индексы таблицы `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
