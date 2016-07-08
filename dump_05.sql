-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 05 2015 г., 12:58
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
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=379 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `email`, `pass`, `auth_key`, `secret_key`, `type`, `surname`, `name`, `patronymic`, `phone`, `createTime`, `updateTime`, `status`) VALUES
(371, 'nogood_@mail.ru', '$2y$13$y/s207vPcicQw3Y.I34Dg.hxVsrHVaDvDAMvARtie9/EkKtaLIFa2', 'V3jjH9hLyKQnbucW3Y5PQx3861wHVuIN', 'eupx2rq6PLvHJt8V5t5rB1LDA_QTS_Nl_1443771810', 0, 'mail', 'Денис', '', '', '2015-10-02 10:43:30', '2015-10-02 10:43:30', 1),
(372, 'den.fzc@yandex.ru', '$2y$13$U7/GdQGMMwZ9xDorTwrJNOC3sw0NB5rRKwAQXktwXzoZlCfao4M9C', '1fY0giXvRzHxIXiOCEPXRC82v18GjOu3', 'D60exzcQ5wI1blJhvsBIxuTtsH1DOjbl_1443776414', 0, 'Hanzera', 'Denis', '', '', '2015-10-02 12:00:14', '2015-10-02 12:00:14', 1),
(373, 'idc.denisg@gmail.com', '$2y$13$MDuUmMw4kb8qHduE0.TWK.KmNFioEIbK3J6ofJ.KgieQUbwa9.eCC', 'yIQNo06ayfD6kY16VY6W72WurW7dRaog', '', 0, 'Hanzera', 'Denis', '', '', '2015-10-02 17:25:51', '2015-10-02 17:26:29', 1),
(374, 'forzaq91@gmail.com', '$2y$13$y3nUsEXrkaBZ9IU1BPXwSOSF0JjeiHIDvagtSIIWpYvd8zKn.8tay', 'CVt_uDMfCKA-IR35gEgVrJx9lFm3LJHR', 'MdSDH-01akrbpPVQA31KE2rA2TXWbtPp_1444035311', 0, 'Ганзера', 'денис', '', '', '2015-10-05 11:55:11', '2015-10-05 11:55:11', 1);

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
(1, 374, '102378669782620881899'),
(1, 373, '114169325146837216197'),
(4, 372, '335884595'),
(9, 371, 'RR2n2qSXfH');

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
