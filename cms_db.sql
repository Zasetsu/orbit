-- -------------------------------------------------------------
-- TablePlus 6.1.8(574)
--
-- https://tableplus.com/
--
-- Database: cms_db
-- Generation Time: 2024-11-04 09:20:46.0610
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


CREATE TABLE `about_intro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title1` varchar(255) DEFAULT NULL,
  `title2` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `about_promo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `about_why_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `order_number` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `order_number` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `contact_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` text DEFAULT NULL,
  `directions` text DEFAULT NULL,
  `working_hours` text DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `home_about` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title1` varchar(255) DEFAULT NULL,
  `title2` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `home_promo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `button_text` varchar(100) DEFAULT NULL,
  `button_link` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `why_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `order_number` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `about_intro` (`id`, `title1`, `title2`, `content`, `image`, `updated_at`) VALUES
(1, 'HER YUDUMDA', 'MÜKEMMELLİK', '<p>Orbit Coffee Co., Karam&uuml;rsel&rsquo;in sahilinde kaliteyi ve kahve tutkusunu bir araya getiriyor. Sizleri eşsiz kahve deneyimimizle buluşturmak i&ccedil;in buradayız.</p>\r\n<p>Kahveye olan tutkumuzu her bir fincanda yansıtıyor, en kaliteli &ccedil;ekirdekleri &ouml;zenle kavuruyoruz. Amacımız, geleneksel kahve k&uuml;lt&uuml;r&uuml;n&uuml; modern dokunuşlarla harmanlayarak unutulmaz bir kahve deneyimi sunmaktır. Kaliteyi ve m&uuml;şteri memnuniyetini her zaman &ouml;n planda tutarak, kahve d&uuml;nyasında kendimizi s&uuml;rekli geliştiriyoruz.</p>', '67285dd098723_test1-3.png', '2024-11-04 08:38:24');

INSERT INTO `about_promo` (`id`, `title`, `content`, `image`, `updated_at`) VALUES
(1, 'HER YUDUMDA KALİTEYİ VE UZMANLIĞI HİSSEDİN.', '<p>Kahve &ccedil;ekirdekleri, doğanın sunduğu bir armağandır. Biz, bu armağanı en y&uuml;ksek kaliteyle kavurup sizlere sunuyoruz.</p>\r\n<p><br>Orbit Coffee Co., her bir kahve fincanında m&uuml;kemmeliyeti hedefleyerek, en kaliteli &ccedil;ekirdekleri &ouml;zenle kavurur ve en taze &uuml;r&uuml;nleri sunar. Misyonumuz, kahve tutkunlarına sadece bir i&ccedil;ecek değil, unutulmaz bir deneyim yaşatmaktır. Her adımda m&uuml;şteri memnuniyetini &ouml;n planda tutarak, kahve k&uuml;lt&uuml;r&uuml;n&uuml; yenilik&ccedil;i yaklaşımlarımızla zenginleştiririz.</p>', '67285eb2ed367_best-coffe-1.jpg', '2024-11-04 08:42:10');

INSERT INTO `about_why_us` (`id`, `title`, `content`, `image`, `order_number`, `created_at`) VALUES
(1, 'Eşsiz Kahve Deneyimi', 'Sizleri eşsiz kahve deneyimimizle buluşturmak için buradayız.', '67285dfc05526_wcu-1.png', 1, '2024-11-04 08:39:08'),
(2, 'Mükemmel Konum', 'Orbit Coffee Co., Karamürsel’in sahilinde kaliteyi ve kahve tutkusunu bir araya getiriyor.', '67285e1d97025_wcu-2.png', 2, '2024-11-04 08:39:19'),
(3, 'Kahve Kalitesi', 'En iyi kahve çekirdeklerini özenle kavurup, mükemmel bir tat deneyimi sunuyoruz.', '67285e14821d9_wcu-1-2.png', 3, '2024-11-04 08:39:32');

INSERT INTO `categories` (`id`, `title`, `order_number`, `created_at`) VALUES
(1, 'test', 1, '2024-11-03 18:38:01'),
(3, 'Bardaklar', 999, '2024-11-04 09:19:22');

INSERT INTO `contact_settings` (`id`, `address`, `directions`, `working_hours`, `instagram_url`, `updated_at`) VALUES
(1, 'KAYACIK MAHALLESİ, İNÖNÜ CADDESİ, NO : 81/B, KARAMÜRSEL, KOCAELİ', 'https://www.google.com/maps/dir//Kayacık,+İnönü+Cd.+No:81+D:b,+41500+Karamürsel%2FKocaeli/@40.692915,29.6079381,17z/data=!4m9!4m8!1m0!1m5!1m1!1s0x14cb17f3e921a121:0x5f21d1599d67d3b4!2m2!1d29.610513!2d40.692911!3e0?entry=ttu&g_ep=EgoyMDI0MTAwMi4xIKXMDSoASAFQAw%3D%3D', 'Pzt - Pzr (10:00 - 01:00)', 'https://www.instagram.com/orbitcoffeecom/', '2024-11-03 18:47:11');

INSERT INTO `home_about` (`id`, `title1`, `title2`, `content`, `image`, `updated_at`) VALUES
(1, 'Her Yudumda', 'Mükemmellik', '<p>Orbit Coffee Co., Karam&uuml;rsel&rsquo;in sahilinde kaliteyi ve kahve tutkusunu bir araya getiriyor. Sizleri eşsiz kahve deneyimimizle buluşturmak i&ccedil;in buradayız.</p>\r\n<p>Kahveye olan tutkumuzu her bir fincanda yansıtıyor, en kaliteli &ccedil;ekirdekleri &ouml;zenle kavuruyoruz. Amacımız, geleneksel kahve k&uuml;lt&uuml;r&uuml;n&uuml; modern dokunuşlarla harmanlayarak unutulmaz bir kahve deneyimi sunmaktır. Kaliteyi ve m&uuml;şteri memnuniyetini her zaman &ouml;n planda tutarak, kahve d&uuml;nyasında kendimizi s&uuml;rekli geliştiriyoruz.</p>', '67285cc7ed56b_test1-2.png', '2024-11-04 08:33:59');

INSERT INTO `home_promo` (`id`, `title`, `content`, `button_text`, `button_link`, `image`, `updated_at`) VALUES
(1, 'KAHVE DÜNYASINA ADIM ATIN!', '<p>Promo i&ccedil;eriği buraya gelecekAOrbit Coffee, kahve tutkunlarının buluşma noktası !</p>\r\n<p>Karam&uuml;rsel sahildeki yeni şubemizle, sizleri eşsiz kahve deneyimlerimizle buluşturmaktan mutluluk duyuyoruz.</p>\r\n<p>Her yudumda kaliteyi ve ustalığı hissedin. En iyi kahve &ccedil;ekirdeklerini se&ccedil;erek, titizlikle kavuruyor ve size en taze kahve deneyimini sunuyoruz.</p>', 'Hakkımızda', 'https://orbitcoffee.co/hakkimizda', '67285b9badf41_hero-img-2-1.png', '2024-11-04 08:28:59');

INSERT INTO `products` (`id`, `category_id`, `title`, `description`, `image`, `created_at`) VALUES
(2, 3, 'Test Ürünü', 'Test Açıklaması', '6728678530560_7m0ox2mu7-Pumpkin_Spice_Latte-720x720px.jpg', '2024-11-03 18:42:40');

INSERT INTO `users` (`id`, `email`, `password`, `created_at`) VALUES
(2, 'admin@orbitcoffee.co', '$2y$10$e6WROmFYD2RjENQsnS1aMupC6lghEy/T81miSJornfUSEfDwV4Ij2', '2024-11-03 18:32:10');

INSERT INTO `why_us` (`id`, `title`, `content`, `image`, `order_number`, `created_at`) VALUES
(1, 'Eşsiz Kahve Deneyimi', 'Orbit Coffee Co., Karamürsel’in sahilinde kaliteyi ve kahve tutkusunu bir araya getiriyor. Sizleri eşsiz kahve deneyimimizle buluşturmak için buradayız.', '67285bce7132e_f-1.jpg', 1, '2024-11-04 08:29:50'),
(2, 'Paket Kahveler', 'Orbit Coffee\'nin özel paket kahveleri, evde de profesyonel kahve deneyimi yaşamanız için hazırlandı. Geniş ürün yelpazemizle her damağa hitap eden lezzetler sunuyoruz.', '67285be7203aa_f-2.jpg', 2, '2024-11-04 08:30:15'),
(3, 'Kahve Kavurma', 'En iyi kahve çekirdeklerini özenle kavurup, mükemmel bir tat deneyimi sunuyoruz.', '67285c02a9fc1_f-3.jpg', 3, '2024-11-04 08:30:42');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;