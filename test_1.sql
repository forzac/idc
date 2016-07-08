-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 01 2015 г., 18:30
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

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
(8, 'twitter', 'www.twitter.com', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=369 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `email`, `pass`, `auth_key`, `secret_key`, `type`, `surname`, `name`, `patronymic`, `phone`, `createTime`, `updateTime`, `status`) VALUES
(364, 'idc.denisg@gmail.com', '$2y$13$D.DiR3EH.fWNWwwD3lcTkesORJR8EOwknm8PtpIAe1TuD0dxMHGSC', 'hy-P-8_reFu4xR2nrRl3pmwSRb4BeKKB', '', 0, 'Hanzera', 'Denis', '', '', '2015-10-01 17:30:38', '2015-10-01 17:32:28', 1),
(365, 'fzc@ukr.net', '$2y$13$voy5Gs6uAmLEs82w1ZteVes5wPyhtLQTtavstYW8IGGDbCvlxBRrW', '41mGSOZVSlzSMifLc_xJRnLIMi6U9bUN', '', 0, 'Ганзера', 'Денис', 'Юрьевич', '0689542777', '2015-10-01 17:35:53', '2015-10-01 17:36:19', 1),
(366, 'nogood_@mail.ru', '$2y$13$n.hriiBAonReim0QTAgz0.EdyxfbRsUVcx00.Pldr0RS8/5gWLa8a', '_ym7fG2zhN5nR3hcJ2YZthiSORFS73IB', 'JD04jPPhhTSeqbNiIz-i7QZqCFnESRRd_1443710331', 0, 'mail', 'Денис', '', '', '2015-10-01 17:38:51', '2015-10-01 17:38:51', 1),
(367, 'forzac94@yandex.ru', '$2y$13$GzdtlCGEX.HaczjOT3QTQ.ztFLmHHcxYqAiT3MEV9/J3sGuAFJWEa', 'nzThIcmtyogX_f7cUtTZFTUz-ySC-fK-', 'zGyuWS5XvqpEpmtQcbUJotQ49JR4_A3J_1443710614', 0, 'Фишер', 'Денис', '', '', '2015-10-01 17:43:34', '2015-10-01 17:43:34', 1),
(368, 'den.fzc@yandex.ru', '$2y$13$fBCrqmuAUDuCQiRoX1kbkumoTOGwpRz8.e.nA8kSaj8Qgjj3aYa3i', 'tHtqLVElBSdjmXSHLZ6LieUZwr7yahRp', '', 0, 'Hanzera', 'Denis', '', '', '2015-10-01 17:48:16', '2015-10-01 17:49:51', 1);

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
(2, 365, '1012140945502651'),
(1, 364, '114169325146837216197'),
(3, 365, '16167181'),
(4, 367, '334161348'),
(4, 368, '335884595'),
(5, 366, '5683111283201999157');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `user_social`
--
ALTER TABLE `user_social`
  ADD CONSTRAINT `social_ibfk_1` FOREIGN KEY (`social_id`) REFERENCES `social` (`social_id`),
  ADD CONSTRAINT `user_social_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
