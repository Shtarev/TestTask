-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 23 2021 г., 12:26
-- Версия сервера: 10.3.13-MariaDB
-- Версия PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `testtask`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(3) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `title`, `url`) VALUES
(1, 'Home', '/'),
(2, 'Link', '/link');

-- --------------------------------------------------------

--
-- Структура таблицы `task`
--

CREATE TABLE `task` (
  `id` int(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `task` varchar(510) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `redact` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `task`
--

INSERT INTO `task` (`id`, `name`, `email`, `task`, `status`, `redact`) VALUES
(1, 'Иван', 'ivan@test.com', 'Разгон облаков', 1, 0),
(2, 'Раиса', 'raica@test.com', 'Разгрузка вагонов', 1, 0),
(3, 'Жора', 'jora@test.com', 'Уход за котом', 0, 0),
(4, 'Марк', 'mark@test.com', 'Уборка прилегающей территории', 1, 1),
(5, 'Степан', 'stepan@test.com', 'Чтение кулинарных книг', 0, 1),
(6, 'Глеб', 'gleb@test.com', 'Ловля рыбы', 0, 1),
(7, 'Гуля', 'gula@test.com', 'Стирка белья', 1, 0),
(8, 'Варя', 'varja@test.com', 'Закупка овощей', 0, 1),
(11, 'Гришка', 'raica@test.com', 'Ловля Пакемонов', 0, 0),
(13, 'Лилианна', 'lilianna@test.com', 'Странная помощь людям', 0, 0),
(14, 'Саня', 'sanja@test.com', 'Полет на Луну', 0, 0),
(15, 'Вольдемар', 'voldemar@test.com', 'скручивание суши', 0, 0),
(31, 'Яша', 'a.shtarev@gmail.com', 'Присмотр за козлами', 1, 0),
(33, 'Адольф', 'a.shtarev@gmail.com', 'Уборка снега', 1, 1),
(36, 'Мухтар', 'a.shtarev@gmail.com', 'Сольфеджио', 0, 1),
(85, 'а Текст до  текст после', 'qq@qq.qq', 'Текст до  текст после', 0, 0),
(86, 'а Текст до alert(Hallo) текст после', 'qq@qq.qq', 'о', 0, 0),
(87, 'афффффффф Текст до alert(Hallo) текст после', 'qq@qq.qq', 'ф', 0, 0),
(89, 'афффффффф Текст до alert(Hallo) текст после', 'qq@qq.qq', 'sss', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(3) NOT NULL,
  `login` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `pass`) VALUES
(1, 'admin', '123');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `task`
--
ALTER TABLE `task`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
