SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `habbolar_com`
--
CREATE DATABASE IF NOT EXISTS `iys_cms` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `iys_cms`;


--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `mail`, `bild`, `psw`, `ip`, `last_login`, `admin_mode`) VALUES
(1, 'Administrator', 'gmail@gmail.de', '/adm/dist/img/avatar5.png', '5f4dcc3b5aa765d61d8327deb882cf99', 'x', '2020-05-07 20:48:40', 1);
