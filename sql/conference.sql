-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.20 - MySQL Community Server (GPL)
-- Операционная система:         Win32
-- HeidiSQL Версия:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица conference.profile
CREATE TABLE IF NOT EXISTS `profile` (
  `idProfile` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `aboutMe` text,
  `photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idProfile`),
  KEY `FK_profile_user` (`idUser`),
  CONSTRAINT `FK_profile_user` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы conference.profile: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` (`idProfile`, `idUser`, `company`, `position`, `aboutMe`, `photo`) VALUES
	(1, 1, '', 'Web-developer', NULL, NULL);
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;

-- Дамп структуры для таблица conference.user
CREATE TABLE IF NOT EXISTS `user` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `reportSubject` varchar(255) NOT NULL,
  `country` varchar(2) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы conference.user: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`idUser`, `firstname`, `lastname`, `birthday`, `reportSubject`, `country`, `phone`, `email`) VALUES
	(1, 'Oksana', 'Egorova', '1999-01-25', 'Report', 'UA', '+380662326591', 'oksana.yegorova99@gmail.com');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
