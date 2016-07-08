-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 30 2015 г., 18:14
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
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=344 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `email`, `pass`, `auth_key`, `secret_key`, `type`, `surname`, `name`, `patronymic`, `phone`, `createTime`, `updateTime`, `status`) VALUES
(341, 'fzc@ukr.net', '$2y$13$GruykNd0zISsqy05sOPj3.4hM1MGREcq4MsAiJJBtBMXaXknhXDsi', 'VTrRLSmvoA8QH5e4j_u4Gctgl-vxl-YH', '', 0, 'Ганзера', 'Денис', 'Юрьевич', '0689542777', '2015-09-30 15:23:57', '2015-09-30 15:26:56', 1),
(343, 'idc.denisg@gmail.com', '$2y$13$8rB5bW.m47fjSxMzU/.6SObEkT9gwWtfWIcqMSITlZW6Qm7vWh3L6', '1lv2UdTKTezC7INkkH-zXXZWpL7bX8sE', '', 0, 'Ганзера', 'Hanzera', 'Юрьевич', '0689542777', '2015-09-30 17:56:33', '2015-09-30 17:57:09', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user_social`
--

CREATE TABLE IF NOT EXISTS `user_social` (
  `social_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `social_type` int(11) NOT NULL,
  PRIMARY KEY (`social_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `user_social`
--
ALTER TABLE `user_social`
  ADD CONSTRAINT `user_social_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
