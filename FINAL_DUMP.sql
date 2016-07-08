-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 13 2015 г., 16:26
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.4.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `social`
--

CREATE TABLE IF NOT EXISTS `social` (
  `social_id` int(11) NOT NULL AUTO_INCREMENT,
  `social` varchar(50) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`social_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `social`
--

INSERT INTO `social` (`social_id`, `social`, `url`, `status`) VALUES
(1, 'google', 'www.gmail.com', 0),
(2, 'facebook', 'www.facebook.com', 0),
(3, 'vk', 'www.vk.com', 0),
(4, 'yandex', 'www.yandex.ru', 0),
(5, 'mailru', 'www.mail.ru', 0),
(6, 'odnoklassniki', 'www.ok.ru', 0),
(7, 'instagram', 'www.instagram.com', 0),
(8, 'twitter', 'www.twitter.com', 0),
(9, 'linkedin', 'www.linkedin.com', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `auth_key` varchar(100) NOT NULL,
  `secret_key` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `patronymic` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `createTime` datetime NOT NULL,
  `updateTime` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `old_email` varchar(100) NOT NULL,
  `avatar` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=414 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `email`, `pass`, `auth_key`, `secret_key`, `type`, `surname`, `name`, `patronymic`, `phone`, `createTime`, `updateTime`, `status`, `old_email`, `avatar`) VALUES
(411, 'fzc@ukr.net', '$2y$13$t9lKQFz0zb2ci2hfBTM3sutiV/wegotclyyt7L63lPhEgcKuLCrQm', 'GZ_n__jBAmKNoaEYwSH-ymAYzOgmvI0V', 'vlwdhZHMqEzWCAsVwgmjFKd3jvfva3rU_1444213066', 0, 'Denis', 'Hanzeras', '', '', '2015-10-07 13:17:46', '2015-10-07 13:19:25', 1, '', ''),
(412, 'idc.denisg@gmail.com', '$2y$13$bnT9t91CRFgyHTzPB9GRtOt0WAwupAu/GMschX7osQJL/UDZZHAYi', 'YXGEQmMJhOAiv0vhSxmGZUUXGx34QjIC', 'SeT44DmOCJlmGKVwITBMsMvIjRl92PPk_1444217325', 0, 'Hanzera', 'Denis', '', '', '2015-10-07 14:28:45', '2015-10-07 14:28:45', 1, '', ''),
(413, 'ganzera@ukr.net', '123', '123', '123', 1, 'Defiter', 'DUxles', 'Duxless', '0689562727', '2015-10-07 00:00:00', '2015-10-23 00:00:00', 1, '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `userSettings`
--

CREATE TABLE IF NOT EXISTS `userSettings` (
  `user_id` int(11) NOT NULL,
  `seting_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` tinyint(1) NOT NULL,
  `mailing` tinyint(1) NOT NULL,
  `search_notif` tinyint(1) NOT NULL,
  `hide_name` tinyint(1) NOT NULL,
  `answer_comment` tinyint(1) NOT NULL,
  PRIMARY KEY (`seting_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `userSettings`
--

INSERT INTO `userSettings` (`user_id`, `seting_id`, `comment`, `mailing`, `search_notif`, `hide_name`, `answer_comment`) VALUES
(411, 10, 0, 0, 0, 0, 0),
(412, 11, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user_social`
--

CREATE TABLE IF NOT EXISTS `user_social` (
  `social_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `user_social_id` varchar(100) NOT NULL,
  PRIMARY KEY (`user_social_id`),
  KEY `user_id` (`user_id`),
  KEY `social_id` (`social_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_social`
--

INSERT INTO `user_social` (`social_id`, `user_id`, `user_social_id`) VALUES
(2, 411, '1012140945502651'),
(1, 412, '114169325146837216197');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `userSettings`
--
ALTER TABLE `userSettings`
  ADD CONSTRAINT `users_seting_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Ограничения внешнего ключа таблицы `user_social`
--
ALTER TABLE `user_social`
  ADD CONSTRAINT `social_ibfk_1` FOREIGN KEY (`social_id`) REFERENCES `social` (`social_id`),
  ADD CONSTRAINT `user_social_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
