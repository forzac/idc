-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 21 2015 г., 18:19
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
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `email`, `pass`, `auth_key`, `secret_key`, `type`, `surname`, `name`, `patronymic`, `phone`, `createTime`, `updateTime`, `status`) VALUES
(63, 'fzc@ukr.net', '$2y$13$YEXzj/b9O/LO0ErVmJuewOjUvcx6JW1u4Hj5fcNztbVpREycWDK/G', 'XBwyHOipAHBVvV8V6PE_NW9uK8EgNBkp', '_VpUZvKhMlWpTdOdF530ZqB-oJ71uSrl_1442848625', 0, 'Denis', 'Hanzera', 'Yurievuch', '0689542777', '2015-09-21 18:02:19', '0000-00-00 00:00:00', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
