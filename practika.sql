-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 16 2024 г., 01:04
-- Версия сервера: 8.0.30
-- Версия PHP: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `practika`
--
CREATE DATABASE IF NOT EXISTS `practika` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `practika`;

-- --------------------------------------------------------

--
-- Структура таблицы `AdminLog`
--

CREATE TABLE `AdminLog` (
  `LogID` int NOT NULL,
  `AdminID` int NOT NULL,
  `Action` varchar(255) NOT NULL,
  `TargetUserID` int NOT NULL,
  `TargetAdID` int NOT NULL,
  `Time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `Adverisements`
--

CREATE TABLE `Adverisements` (
  `AdID` int NOT NULL,
  `UserID` int NOT NULL,
  `CategoryID` int NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `AdPhoto` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Adverisements`
--

INSERT INTO `Adverisements` (`AdID`, `UserID`, `CategoryID`, `Title`, `Description`, `AdPhoto`, `Status`, `Created_at`, `Updated_at`) VALUES
(1, 42, 1, 'Заголовок', 'Комментарий', 'путь до фото', 'Одобрено', '2024-02-13 17:11:52', NULL),
(3, 45, 1, 'Заголовок', 'Текст', 'images/ad/123.jpg', 'Одобрено', '2024-02-14 22:20:22', NULL),
(4, 45, 1, 'Заголовок', 'Комментарий', '', 'Одобрено', '2024-02-13 17:11:52', NULL),
(6, 45, 1, 'Заголовок', 'Текст', 'images/ad/123.jpg', 'Отклонено', '2024-02-14 22:20:22', NULL),
(7, 45, 1, 'Заголовок', 'Текст', 'images/ad/123.jpg', 'Одобрено', '2024-02-14 22:20:22', NULL),
(9, 45, 1, 'Заголовок', 'Текст', 'images/ad/123.jpg', 'На рассмотрении', '2024-02-14 22:20:22', NULL),
(11, 45, 1, 'asd', 'asasdasd', 'images/ad/170795401284.jpg', 'Одобрено', '2024-02-15 02:40:12', NULL),
(12, 46, 1, 'asd', 'Banned', 'images/ad/170795401284.jpg', 'Одобрено', '2024-02-15 02:40:12', NULL),
(13, 46, 1, 'asdasd', 'asdasd', 'images/ad/1707998956146.jpg', 'На рассмотрении', '2024-02-15 15:09:16', NULL),
(14, 45, 2, 'asdasd', 'asdasd', 'images/ad/1708000308250.jpg', 'На рассмотрении', '2024-02-15 15:31:48', NULL),
(15, 45, 2, '123', 'asdasd', 'images/ad/1708000829249.jpg', 'Одобрено', '2024-02-15 15:40:29', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `Categories`
--

CREATE TABLE `Categories` (
  `CategoryID` int NOT NULL,
  `CategoryName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Categories`
--

INSERT INTO `Categories` (`CategoryID`, `CategoryName`) VALUES
(1, 'Мужская одежда'),
(2, 'Компьютерные комплектующие');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `Users`
--

CREATE TABLE `Users` (
  `UserID` int NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `UserPhoto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Пользователь',
  `Banned` int NOT NULL DEFAULT '0',
  `remember_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Users`
--

INSERT INTO `Users` (`UserID`, `Username`, `Password`, `Email`, `UserPhoto`, `Role`, `Banned`, `remember_token`) VALUES
(45, 'qwe', '$2y$10$wWrsXNKdZTqBPRM8Yr/RAOigCHNUyB19qJVbAo7ILI4WnT2SmtA/y', 'qwe@mail.ru', 'images/users/170792676359.jpg', 'Администратор', 0, NULL),
(46, 'qwee12', '$2y$10$xewMhhpIJVChgEmROPJBLeuvFodgDp1UisLcBIxf3oSVxhaARI35e', 'qwee@mail.ru', 'images/users/1707931363247.gif', 'Пользователь', 0, NULL),
(47, 'qweeee', '$2y$10$QqUh8RAE84pOrCg1VpB7gedL6/3argnVUgJPRQlqQ5kJ1QlDBQ/Je', 'qweeee@mail.ru', 'images/users/default.png', 'Пользователь', 0, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `AdminLog`
--
ALTER TABLE `AdminLog`
  ADD PRIMARY KEY (`LogID`),
  ADD KEY `AdminID` (`AdminID`),
  ADD KEY `TargetUserID` (`TargetUserID`),
  ADD KEY `TargetAdID` (`TargetAdID`);

--
-- Индексы таблицы `Adverisements`
--
ALTER TABLE `Adverisements`
  ADD PRIMARY KEY (`AdID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Индексы таблицы `Categories`
--
ALTER TABLE `Categories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `AdminLog`
--
ALTER TABLE `AdminLog`
  MODIFY `LogID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `Adverisements`
--
ALTER TABLE `Adverisements`
  MODIFY `AdID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `Categories`
--
ALTER TABLE `Categories`
  MODIFY `CategoryID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `Users`
--
ALTER TABLE `Users`
  MODIFY `UserID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `AdminLog`
--
ALTER TABLE `AdminLog`
  ADD CONSTRAINT `adminlog_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `Users` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `adminlog_ibfk_2` FOREIGN KEY (`TargetUserID`) REFERENCES `Users` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `adminlog_ibfk_3` FOREIGN KEY (`TargetAdID`) REFERENCES `Adverisements` (`AdID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `Adverisements`
--
ALTER TABLE `Adverisements`
  ADD CONSTRAINT `adverisements_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `Users` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `adverisements_ibfk_2` FOREIGN KEY (`CategoryID`) REFERENCES `Categories` (`CategoryID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
