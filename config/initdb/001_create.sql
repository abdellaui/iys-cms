-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 21, 2023 at 08:06 PM
-- Server version: 5.7.36
-- PHP Version: 8.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `usr_web143_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bild` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `psw` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime NOT NULL,
  `admin_mode` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `mail`, `bild`, `psw`, `ip`, `last_login`, `admin_mode`) VALUES
(1, 'Administrator', 'admin@davinci-consulting.net', '/adm/dist/img/avatar5.png', 'da5fc7e08d41300619a4788ee201eaf2', '2003:e4:af07:267c:851a:c2d1:706b:b384', '2023-02-21 18:49:05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `boxes`
--

CREATE TABLE `boxes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `source` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `boxes`
--

INSERT INTO `boxes` (`id`, `name`, `source`) VALUES
(1, 'Box.Head', '    &lt;meta charset=\"utf-8\"&gt;\n    &lt;meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\"&gt;\n	&lt;meta http-equiv=\"content-language\" content=\"de\"&gt;\n	&lt;meta http-equiv=\"cache-control\" content=\"cache\"&gt;\n    &lt;meta name=\"robots\" content=\"index, follow, noodp, noydir\"&gt;\n	&lt;title&gt;{{$_GET::title}}&lt;/title&gt;\n	&lt;meta name=\"author\" content=\"{{author}}\"&gt;\n	&lt;meta name=\"publisher\" content=\"www.{{domain}}\"&gt;\n	&lt;meta name=\"copyright\" content=\"2016 (c) {{$_GET::title}}\"&gt;\n	&lt;meta name=\"date\" content=\"2016-24-08\"&gt;\n	&lt;meta name=\"keywords\" content=\"{{keywords}}\" lang=\"de\"&gt;\n	&lt;meta name=\"description\" content=\"{{$_GET::beschreibung}}\"&gt;\n	&lt;meta name=\"abstract\" lang=\"de\" content=\"{{abstraktebeschreibung}}\"&gt;\n	&lt;meta name=\"page-topic\" lang=\"de\" content=\"{{thema}}\"&gt;\n	&lt;meta name=\"page-type\" lang=\"de\" content=\"{{thematype}}\"&gt;\n	&lt;meta name=\"audience\" lang=\"de\" content=\"{{zielgruppe}}\"&gt;\n	&lt;meta name=\"distribution\" content=\"global\"&gt;\n	&lt;meta property=\"og:type\" content=\"website\"&gt;\n	&lt;meta property=\"og:site_name\" content=\"{{$_GET::title}}\"&gt;\n	&lt;meta property=\"og:title\" content=\"{{$_GET::title}}\"&gt;\n	&lt;meta property=\"og:description\" content=\"{{$_GET::beschreibung}}\"&gt;\n	&lt;meta property=\"og:url\" content=\"https://{{domain}}/\"&gt;\n	&lt;meta property=\"og:image\" content=\"/img/icons/grossesIcon.png\"&gt;\n	&lt;meta property=\"og:image:height\" content=\"628\"&gt;\n	&lt;meta property=\"og:image:width\" content=\"959\"&gt;\n	&lt;meta name=\"twitter:card\" content=\"summary_large_image\"&gt;\n	&lt;meta name=\"twitter:title\" content=\"{{$_GET::title}}\"&gt;\n	&lt;meta name=\"twitter:description\" content=\"{{$_GET::beschreibung}}\"&gt;\n	&lt;meta name=\"twitter:image\" content=\"/img/icons/grossesIcon.png\"&gt;\n	&lt;!--&lt;meta name=\"twitter:site\" content=\"@sahin.cloud_iysCms\"&gt;--&gt;\n	&lt;meta itemprop=\"name\" content=\"{{$_GET::title}}\"&gt;\n	&lt;meta itemprop=\"description\" content=\"{{$_GET::beschreibung}}\"&gt;\n	&lt;meta itemprop=\"image\" content=\"/img/icons/grossesIcon.png\"&gt;\n	&lt;meta name=\"viewport\" content=\"width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no,shrink-to-fit=no\"&gt;\n	&lt;meta name=\"theme-color\" content=\"#000000\"&gt;\n	&lt;meta name=\"application-name\" content=\"{{$_GET::title}}\" /&gt;\n	&lt;meta name=\"apple-mobile-web-app-title\" content=\"{{$_GET::title}}\"&gt;\n	&lt;meta name=\"apple-mobile-web-app-capable\" content=\"yes\"&gt;\n	&lt;meta name=\"apple-mobile-web-app-status-bar-style\" content=\"black\"&gt;\n	&lt;meta name=\"msapplication-TileColor\" content=\"#000000\"&gt;\n	&lt;meta name=\"msapplication-TileImage\" content=\"/img/icons/icon-144x144-precomposed.png\"&gt;\n	&lt;meta name=\"msapplication-config\" content=\"/browserconfig.xml\"&gt;\n	&lt;meta name=\"msapplication-task\" content=\"name={{$_GET::title}};action-uri=https://{{domain}}/;icon-uri=https://{{domain}}/favicon.ico\" /&gt;\n	&lt;meta name=\"msapplication-navbutton-color\" content=\"#000000\"&gt;\n	&lt;meta name=\"generator\" content=\"Abdullah Sahin\"&gt;\n	&lt;link rev=\"made\" href=\"mailto:abdullah@sahin.uk\"&gt;\n	&lt;link rel=\"manifest\" href=\"/manifest.json\"&gt;\n	&lt;link rel=\"icon\" href=\"/favicon.ico\" type=\"image/x-icon\"&gt;\n	&lt;link rel=\"apple-touch-icon\" href=\"/img/icons/apple/apple196.png\"&gt;\n	&lt;link rel=\"apple-touch-icon-precomposed\" sizes=\"57x57\" href=\"/img/icons/apple/apple57.png\"&gt;\n	&lt;link rel=\"apple-touch-icon-precomposed\" sizes=\"72x72\" href=\"/img/icons/apple/apple72.png\"&gt;\n	&lt;link rel=\"apple-touch-icon-precomposed\" sizes=\"114x114\" href=\"/img/icons/apple/apple114.png\"&gt;\n	&lt;link rel=\"apple-touch-icon-precomposed\" href=\"/img/icons/apple/apple64.png\"&gt;\n	&lt;link rel=\"apple-touch-startup-image\" sizes=\"320x460\" href=\"/img/icons/apple/homescreen/apple-touch-startup-image-320x460.png\" media=\"(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 1)\"&gt;\n	&lt;link rel=\"apple-touch-startup-image\" sizes=\"640x920\" href=\"/img/icons/apple/homescreen/apple-touch-startup-image-640x920.png\" media=\"(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 2)\"&gt;\n	&lt;link rel=\"apple-touch-startup-image\" sizes=\"640x1096\" href=\"/img/icons/apple/homescreen/apple-touch-startup-image-640x1096.png\" media=\"(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)\"&gt;\n	&lt;link rel=\"apple-touch-startup-image\" sizes=\"768x1004\" href=\"/img/icons/apple/homescreen/apple-touch-startup-image-768x1004.png\" media=\"(device-width: 768px) and (device-height: 1024px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 1)\"&gt;\n	&lt;link rel=\"apple-touch-startup-image\" sizes=\"748x1024\" href=\"/img/icons/apple/homescreen/apple-touch-startup-image-748x1024.png\" media=\"(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 1)\"&gt;\n	&lt;link rel=\"apple-touch-startup-image\" sizes=\"1536x2008\" href=\"/img/icons/apple/homescreen/apple-touch-startup-image-1536x2008.png\" media=\"(device-width: 768px) and (device-height: 1024px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)\"&gt;\n	&lt;link rel=\"apple-touch-startup-image\" sizes=\"1496x2048\" href=\"/img/icons/apple/homescreen/apple-touch-startup-image-1496x2048.png\" media=\"(device-width: 768px) and (device-height: 1024px) and (orientation: landscape) and (-webkit-device-pixel-ratio: 2)\"&gt;\n	&lt;link rel=\"shortcut icon\" sizes=\"196x196\" href=\"/img/icons/icon-196x196-precomposed.png\"&gt;\n	&lt;link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"/favicon.ico\"&gt;\n\n    &lt;!-- Google Fonts --&gt;\n    &lt;link href=\"https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i\" rel=\"stylesheet\"&gt;\n\n    &lt;!-- Vendor CSS Files --&gt;\n    &lt;link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css\" integrity=\"sha512-1cK78a1o+ht2JcaW6g8OXYwqpev9+6GqOkz9xmBN9iUUhIndKtxwILGWYOSibOKjLsEdjyjZvYDq/cZwNeak0w==\" crossorigin=\"anonymous\" referrerpolicy=\"no-referrer\" /&gt;\n    &lt;link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css\" integrity=\"sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==\" crossorigin=\"anonymous\" referrerpolicy=\"no-referrer\" /&gt;\n    &lt;link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css\" integrity=\"sha512-YFENbnqHbCRmJt5d+9lHimyEMt8LKSNTMLSaHjvsclnZGICeY/0KYEeiHwD1Ux4Tcao0h60tdcMv+0GljvWyHg==\" crossorigin=\"anonymous\" referrerpolicy=\"no-referrer\" /&gt;\n    &lt;link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css\" integrity=\"sha512-cn16Qw8mzTBKpu08X0fwhTSv02kK/FojjNLz0bwp2xJ4H+yalwzXKFw/5cLzuBZCxGWIA+95X4skzvo8STNtSg==\" crossorigin=\"anonymous\" referrerpolicy=\"no-referrer\" /&gt;\n    &lt;link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.2.0/css/glightbox.min.css\" integrity=\"sha512-T+KoG3fbDoSnlgEXFQqwcTC9AdkFIxhBlmoaFqYaIjq2ShhNwNao9AKaLUPMfwiBPL0ScxAtc+UYbHAgvd+sjQ==\" crossorigin=\"anonymous\" referrerpolicy=\"no-referrer\" /&gt;\n    &lt;link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.6/swiper-bundle.min.css\" integrity=\"sha512-TiHjTWyqR7jp0HDsbupyltYY6O5qkSn5uLypqLSgNRtc2tEAhD2Dhhfe+0uu3aPxe5LN+quKlyA+j07SRtzxUw==\" crossorigin=\"anonymous\" referrerpolicy=\"no-referrer\" /&gt;\n\n\n	&lt;link rel=\"stylesheet\" href=\"/css/style.css\"&gt;\n'),
(2, 'Box.Body_Startseite', '{{box.navigator}}\n{{box.header}}\n\n&lt;main id=\"main\"&gt;\n\n  &lt;section id=\"privacy\" class=\"privacy section-bg\"&gt;\n    &lt;div class=\"container\" data-aos=\"fade-up\"&gt;\n      &lt;div class=\"row\" data-aos=\"fade-up\" data-aos-delay=\"0\"&gt;\n        &lt;div class=\"col-lg-12\"&gt;\n		     &lt;div class=\"section-title\"&gt;\n			  &lt;h3&gt;{{ueberschrift1}}&lt;/h3&gt;\n			   &lt;/div&gt;\n			{{inhalt}}\n        &lt;/div&gt;\n      &lt;/div&gt;\n    &lt;/div&gt;\n  &lt;/section&gt;\n  \n  &lt;section id=\"services\" class=\"services\"&gt;\n    &lt;div class=\"container\" data-aos=\"fade-up\"&gt;\n\n        &lt;div class=\"section-title\"&gt;\n            &lt;h2&gt;{{panel.vorteile.title}}&lt;/h2&gt;\n            &lt;h3&gt;{{panel.vorteile.beschreibung}}&lt;/h3&gt;\n        &lt;/div&gt;\n	  &lt;div class=\"row\"&gt;\n		{{panel.vorteile}}\n	  &lt;/div&gt;\n    &lt;/div&gt;\n&lt;/section&gt;&lt;!-- End Services Section --&gt;\n\n&lt;/main&gt;&lt;!-- End #main --&gt;\n\n\n{{box.bigfooter}}\n{{box.footer}}'),
(3, 'Box.Header', '&lt;!-- ======= Hero Section ======= --&gt;\n&lt;section id=\"hero\" class=\"d-flex align-items-center\" style=\"background-image:url({{img.banner.url}})!important;\"&gt;\n  &lt;div class=\"container\" data-aos=\"zoom-out\" data-aos-delay=\"0\"&gt;\n	&lt;div class=\"row headerScreen\"&gt;\n	  &lt;div class=\"col-md-4 headerColumn\"&gt;&lt;div class=\"headerContent\"&gt;{{company.name}}&lt;/div&gt;&lt;/div&gt;\n	  &lt;div class=\"col-md-4 headerColumn\"&gt;&lt;figure class=\"headerContent\"&gt;\n		&lt;img src=\"{{img.logo.url}}\" alt=\"{{img.logo.text}}\" class=\"img-responsive center-block\" style=\"max-height:250px\"&gt;\n		&lt;/figure&gt;&lt;/div&gt;\n	  &lt;div class=\"col-md-4 headerColumn\"&gt;&lt;div class=\"headerContent\"&gt;{{company.description}}&lt;/div&gt;&lt;/div&gt;\n	&lt;/div&gt;\n  &lt;/div&gt;\n&lt;/section&gt;&lt;!-- End Hero --&gt;\n'),
(4, 'Box.Navigation', '&lt;!-- ======= Header ======= --&gt;\n&lt;header id=\"header\" class=\"d-flex align-items-center\"&gt;\n    &lt;div class=\"container d-flex align-items-center justify-content-between\"&gt;\n\n        &lt;h1 class=\"logo\"&gt;&lt;a href=\"/index.php\"&gt;&lt;img src=\"{{menueIcon}}\" alt=\"sahin.cloud iysCms\"&gt;&lt;/a&gt;&lt;/h1&gt;\n        &lt;nav id=\"navbar\" class=\"navbar\"&gt;\n            &lt;ul&gt;\n				{{panel.menulink}}\n            &lt;/ul&gt;\n            &lt;i class=\"bi bi-list mobile-nav-toggle\"&gt;&lt;/i&gt;\n        &lt;/nav&gt;&lt;!-- .navbar --&gt;\n\n    &lt;/div&gt;\n  \n  \n&lt;/header&gt;&lt;!-- End Header --&gt;\n'),
(5, 'Box.BigFooter', '&lt;footer id=\"footer\"&gt;\n  &lt;div class=\"footer-top\"&gt;\n    &lt;div class=\"container\"&gt;\n      &lt;div class=\"row\"&gt;\n\n        &lt;div class=\"col-lg-4 col-md-6 footer-contact\"&gt;	  \n          &lt;a href=\"{{routeplaner.link}}\" target=\"_blank\"&gt;{{adresse}}&lt;/a&gt;&lt;br&gt;\n          &lt;strong&gt;Telefonnummer: &lt;/strong&gt;&lt;a href=\"tel:{{telefonnummer}}\"&gt;{{telefonnummer}}&lt;/a&gt;&lt;br&gt;\n          &lt;strong&gt;E-Mail: &lt;/strong&gt;&lt;a href=\"mailto:{{mailadresse}}\"&gt;{{mailadresse}}&lt;/a&gt;&lt;br&gt;\n        &lt;/div&gt;\n\n\n        &lt;div class=\"col-lg-4 col-md-6 footer-links\"&gt;\n          &lt;h4&gt;Sitemap&lt;/h4&gt;\n		  &lt;ul&gt;\n            {{panel.sitemap}}\n		  &lt;/ul&gt;\n        &lt;/div&gt;\n\n        &lt;div class=\"col-lg-4 col-md-6 footer-links\"&gt;\n          &lt;h4&gt;Öffnungszeiten&lt;/h4&gt;\n		  &lt;ul&gt;\n			{{panel.oeffnungzeiten}}\n		  &lt;/ul&gt;\n        &lt;/div&gt;\n\n      &lt;/div&gt;\n    &lt;/div&gt;\n  &lt;/div&gt;\n  &lt;div class=\"container py-4\"&gt;\n    &lt;div class=\"copyright\"&gt;\n      &amp;copy; Copyright &lt;strong&gt;{{seiten.name}}&lt;/strong&gt;. All Rights Reserved\n    &lt;/div&gt;\n    &lt;div class=\"credits\"&gt;\n      Designed by &lt;a href=\"https://davinci-consulting.net/\"&gt;davinci-consulting.net&lt;/a&gt;\n    &lt;/div&gt;\n  &lt;/div&gt;\n&lt;/footer&gt;&lt;!-- End Footer --&gt;'),
(6, 'Box.Footer', '&lt;div id=\"preloader\"&gt;&lt;/div&gt;\n&lt;a href=\"#\" class=\"back-to-top d-flex align-items-center justify-content-center\"&gt;&lt;i class=\"bi bi-arrow-up-short\"&gt;&lt;/i&gt;&lt;/a&gt;\n\n&lt;!-- Vendor JS Files --&gt;\n\n&lt;script src=\"https://app.enzuzo.com/apps/enzuzo/static/js/__enzuzo-cookiebar.js?uuid=7702c176-97c2-11ed-b754-778fe7ccd63b\"&gt;&lt;/script&gt;\n&lt;script src=\"https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js\" integrity=\"sha512-A7AYk1fGKX6S2SsHywmPkrnzTZHrgiVT7GcQkLGDe2ev0aWb8zejytzS8wjo7PGEXKqJOrjQ4oORtnimIRZBtw==\" crossorigin=\"anonymous\" referrerpolicy=\"no-referrer\"&gt;&lt;/script&gt;\n&lt;script src=\"https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.bundle.min.js\" integrity=\"sha512-i9cEfJwUwViEPFKdC1enz4ZRGBj8YQo6QByFTF92YXHi7waCqyexvRD75S5NVTsSiTv7rKWqG9Y5eFxmRsOn0A==\" crossorigin=\"anonymous\" referrerpolicy=\"no-referrer\"&gt;&lt;/script&gt;\n&lt;script src=\"https://cdnjs.cloudflare.com/ajax/libs/glightbox/3.2.0/js/glightbox.min.js\" integrity=\"sha512-S/H9RQ6govCzeA7F9D0m8NGfsGf0/HjJEiLEfWGaMCjFzavo+DkRbYtZLSO+X6cZsIKQ6JvV/7Y9YMaYnSGnAA==\" crossorigin=\"anonymous\" referrerpolicy=\"no-referrer\"&gt;&lt;/script&gt;\n&lt;script src=\"https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js\" integrity=\"sha512-Zq2BOxyhvnRFXu0+WE6ojpZLOU2jdnqbrM1hmVdGzyeCa1DgM3X5Q4A/Is9xA1IkbUeDd7755dNNI/PzSf2Pew==\" crossorigin=\"anonymous\" referrerpolicy=\"no-referrer\"&gt;&lt;/script&gt;\n&lt;script src=\"https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.6/swiper-bundle.min.js\" integrity=\"sha512-s/ili339Sh6gM9omfUC6fRwZPU6MPcGJxvDqlbBzPcFcD649iqeO96YQr3VKj/jZSMd2/T9Qr2mp2w4DyCIOPQ==\" crossorigin=\"anonymous\" referrerpolicy=\"no-referrer\"&gt;&lt;/script&gt;\n&lt;script src=\"https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/noframework.waypoints.min.js\" integrity=\"sha512-fHXRw0CXruAoINU11+hgqYvY/PcsOWzmj0QmcSOtjlJcqITbPyypc8cYpidjPurWpCnlB8VKfRwx6PIpASCUkQ==\" crossorigin=\"anonymous\" referrerpolicy=\"no-referrer\"&gt;&lt;/script&gt;\n&lt;script src=\"https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js\" integrity=\"sha512-3P8rXCuGJdNZOnUx/03c1jOTnMn3rP63nBip5gOP2qmUh5YAdVAvFZ1E+QLZZbC1rtMrQb+mah3AfYW11RUrWA==\" crossorigin=\"anonymous\" referrerpolicy=\"no-referrer\"&gt;&lt;/script&gt;\n\n&lt;script src=\"/js/javascript.js\"&gt;&lt;/script&gt;\n&lt;script src=\"/js/map.js\"&gt;&lt;/script&gt;\n');
(8, 'Box.Body_Standort', '{{box.navigator}}\n{{box.header}}\n	\n&lt;main id=\"main\"&gt;\n\n  &lt;section id=\"privacy\" class=\"privacy section-bg\"&gt;\n    &lt;div class=\"container\" data-aos=\"fade-up\"&gt;\n      &lt;div class=\"row\" data-aos=\"fade-up\" data-aos-delay=\"0\"&gt;\n        &lt;div class=\"col-lg-12\"&gt;\n        &lt;div class=\"row\" data-aos=\"fade-up\" data-aos-delay=\"0\"&gt;\n            &lt;div class=\"col-lg-6\"&gt;\n			&lt;div class=\"info-box mb-4\" style=\"text-align:right\"&gt;\n           		&lt;img src=\"{{standort.bild}}\" style=\"max-height:250px;\" alt=\"sahin.cloud iysCms\" class=\"img-responsive center-block\"&gt;&lt;br&gt;\n				&lt;p&gt;&lt;b&gt;{{standort}}&lt;/b&gt;&lt;/p&gt;\n				&lt;p&gt;&lt;a href=\"{{routeplaner.link}}\" target=\"_blank\" class=\"btn btn-primary btn-block\"&gt;Routeplaner öffnen&lt;/a&gt;&lt;/p&gt;\n            &lt;/div&gt;\n			&lt;/div&gt;\n            &lt;div class=\"col-lg-6 \"&gt;\n                &lt;iframe class=\"mb-4 mb-lg-0\" src=\"{{routeplaner.iframe}}\" frameborder=\"0\" style=\"border:0; width: 100%; height: 384px;\" allowfullscreen&gt;&lt;/iframe&gt;\n            &lt;/div&gt;\n\n        &lt;/div&gt;\n\n        &lt;/div&gt;\n      &lt;/div&gt;\n    &lt;/div&gt;\n  &lt;/section&gt;\n&lt;/main&gt;\n\n{{box.bigfooter}}\n{{box.footer}}\n'),
(9, 'Box.Body_Kontakt', '{{box.navigator}}\n{{box.header}}\n\n&lt;!-- ======= Contact Section ======= --&gt;\n&lt;section id=\"contact\" class=\"contact\"&gt;\n    &lt;div class=\"container\" data-aos=\"fade-up\"&gt;\n\n        &lt;div class=\"section-title\"&gt;\n            &lt;h2&gt;Kontakt&lt;/h2&gt;\n            &lt;h3&gt;Kontaktiere &lt;span&gt;uns&lt;/span&gt;&lt;/h3&gt;\n        &lt;/div&gt;\n\n        &lt;div class=\"row\" data-aos=\"fade-up\" data-aos-delay=\"0\"&gt;\n            &lt;div class=\"col-lg-6\"&gt;\n                &lt;div class=\"info-box mb-4\"&gt;\n                    &lt;i class=\"bx bx-map\"&gt;&lt;/i&gt;\n                    &lt;h3&gt;Unsere Addresse&lt;/h3&gt;\n                    &lt;p&gt;&lt;a href=\"{{routeplaner.link}}\" target=\"_blank\"&gt;{{adresse}}&lt;/a&gt;&lt;/p&gt;\n                &lt;/div&gt;\n                &lt;div class=\"info-box mb-4\"&gt;\n                    &lt;i class=\"bx bx-envelope\"&gt;&lt;/i&gt;\n                    &lt;h3&gt;Email&lt;/h3&gt;\n                    &lt;p&gt;&lt;a href=\"mailto:{{mailadresse}}\"&gt;{{mailadresse}}&lt;/a&gt;&lt;/p&gt;\n                &lt;/div&gt;\n                &lt;div class=\"info-box mb-4\"&gt;\n                    &lt;i class=\"bx bx-phone-call\"&gt;&lt;/i&gt;\n                    &lt;h3&gt;Telefonnummer&lt;/h3&gt;\n                    &lt;p&gt;&lt;a href=\"tel:{{telefonnummer}}\"&gt;{{telefonnummer}}&lt;/a&gt;&lt;/p&gt;\n                &lt;/div&gt;\n			  \n			  	&lt;div class=\"info-box mb-4\"&gt;\n					{{portale}}\n				  &lt;/div&gt;\n            &lt;/div&gt;\n\n            &lt;div class=\"col-lg-6 \"&gt;\n                 &lt;form method=\"post\" class=\"form-horizontal\" id=\"kontaktFormular\" data-toggle=\"validator\" role=\"form\"&gt;\n\n&lt;!-- Text input--&gt;\n\n&lt;div class=\"form-group has-feedback\"&gt;\n  &lt;label class=\"col-md-3 control-label\"&gt;Ihr Name&lt;/label&gt;  \n  &lt;div class=\"col-md-9\"&gt;\n  &lt;div class=\"input-group\"&gt;\n  &lt;span class=\"input-group-addon\"&gt;&lt;i class=\"glyphicon glyphicon-user\"&gt;&lt;/i&gt;&lt;/span&gt;\n  &lt;input  name=\"vorname\" placeholder=\"Vor- und Nachname\" class=\"form-control\" type=\"text\" required&gt;\n	&lt;span class=\"glyphicon form-control-feedback\" aria-hidden=\"true\"&gt;&lt;/span&gt;\n    &lt;/div&gt;\n  &lt;/div&gt;\n&lt;/div&gt;\n&lt;!-- Text input--&gt;\n       &lt;div class=\"form-group has-feedback\"&gt;\n  &lt;label class=\"col-md-3 control-label\"&gt;E-Mail&lt;/label&gt;  \n    &lt;div class=\"col-md-9 inputGroupContainer\"&gt;\n    &lt;div class=\"input-group\"&gt;\n        &lt;span class=\"input-group-addon\"&gt;&lt;i class=\"glyphicon glyphicon-envelope\"&gt;&lt;/i&gt;&lt;/span&gt;\n  &lt;input name=\"email\" placeholder=\"E-Mail Addresse\" class=\"form-control\"  type=\"text\" pattern=\"^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,4}$\" required&gt;\n	  &lt;span class=\"glyphicon form-control-feedback\" aria-hidden=\"true\"&gt;&lt;/span&gt;\n    &lt;/div&gt;\n  &lt;/div&gt;\n&lt;/div&gt;\n\n&lt;!-- Text input--&gt;\n\n&lt;div class=\"form-group has-feedback\"&gt;\n  &lt;label class=\"col-md-3 control-label\" &gt;Betreff&lt;/label&gt; \n    &lt;div class=\"col-md-9\"&gt;\n    &lt;div class=\"input-group\"&gt;\n  &lt;span class=\"input-group-addon\"&gt;&lt;i class=\"glyphicon glyphicon-share-alt\"&gt;&lt;/i&gt;&lt;/span&gt;\n  &lt;input name=\"betreff\" placeholder=\"Betreff\" class=\"form-control\" type=\"text\" required&gt;\n	  &lt;span class=\"glyphicon form-control-feedback\" aria-hidden=\"true\"&gt;&lt;/span&gt;\n    &lt;/div&gt;\n  &lt;/div&gt;\n&lt;/div&gt;\n\n			\n&lt;div class=\"form-group has-feedback\"&gt;\n  &lt;label class=\"col-md-3 control-label\"&gt;&lt;/label&gt;\n    &lt;div class=\"col-md-9\"&gt;\n    &lt;div class=\"input-group\"&gt;\n        &lt;span class=\"input-group-addon\"&gt;&lt;i class=\"glyphicon glyphicon-pencil\"&gt;&lt;/i&gt;&lt;/span&gt;\n        	&lt;textarea class=\"form-control\" name=\"text\" placeholder=\"\" rows=\"10\" required&gt;&lt;/textarea&gt;\n  &lt;/div&gt;\n  &lt;/div&gt;\n&lt;/div&gt;\n\n&lt;!-- Button --&gt;\n&lt;div class=\"form-group has-feedback\"&gt;\n  &lt;label class=\"col-md-3 control-label\"&gt;&lt;/label&gt;\n  &lt;div class=\"col-md-9\"&gt;\n	\n    &lt;div class=\"input-check\"&gt;\n  &lt;input name=\"dsgvo\" class=\"form-check-input\" id=\"dsgvoCheckbox\" type=\"checkbox\" value=\"1\" required&gt;\n	&lt;label class=\"form-check-label\" for=\"dsgvoCheckbox\"&gt;\n	  &lt;span class=\"glyphicon form-control-feedback\" aria-hidden=\"true\"&gt;&lt;/span&gt;\n	  Bitte lesen und akzeptieren Sie die &lt;a href=\"/dsgvo\" target=\"_blank\"&gt;Datenschutzerklärung&lt;/a&gt;.\n	 &lt;/label&gt;\n    &lt;/div&gt;\n	\n	\n    &lt;button type=\"submit\" class=\"btn btn-primary btn-block\" &gt;Senden &lt;span class=\"glyphicon glyphicon-send\"&gt;&lt;/span&gt;&lt;/button&gt;\n  &lt;/div&gt;\n&lt;/div&gt;\n&lt;/form&gt;\n            &lt;/div&gt;\n\n        &lt;/div&gt;\n\n\n    &lt;/div&gt;\n&lt;/section&gt;&lt;!-- End Contact Section --&gt;\n&lt;div id=\"modalAlles\" class=\"modal fade\" role=\"dialog\"&gt;\n  &lt;div class=\"modal-dialog modal-sm\"&gt;\n    &lt;div class=\"modal-content\"&gt;\n      &lt;div class=\"modal-header\"&gt;\n		&lt;button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Schließen\"&gt;&lt;span aria-hidden=\"true\"&gt;&amp;times;&lt;/span&gt;&lt;/button&gt;\n        &lt;h4 class=\"modal-title\"&gt;Ladet...&lt;/h4&gt;\n      &lt;/div&gt;\n      &lt;div class=\"modal-body\"&gt;\n        &lt;p&gt;Ladet...&lt;/p&gt;\n      &lt;/div&gt;\n      &lt;div class=\"modal-footer\"&gt;\n		&lt;button type=\"button\" class=\"btn btn-danger\"  data-dismiss=\"modal\"&gt;Schließen&lt;/button&gt;\n      &lt;/div&gt;\n    &lt;/div&gt;\n  &lt;/div&gt;\n&lt;/div&gt;\n{{box.bigfooter}}\n{{box.footer}}'),
(11, 'Box.Body_Impressum', '{{box.navigator}}\n{{box.header}}\n	\n&lt;main id=\"main\"&gt;\n\n  &lt;section id=\"privacy\" class=\"privacy section-bg\"&gt;\n    &lt;div class=\"container\" data-aos=\"fade-up\"&gt;\n      &lt;div class=\"row\" data-aos=\"fade-up\" data-aos-delay=\"0\"&gt;\n        &lt;div class=\"col-lg-12\"&gt;\n		{{Impressum}}\n        &lt;/div&gt;\n      &lt;/div&gt;\n    &lt;/div&gt;\n  &lt;/section&gt;\n&lt;/main&gt;\n\n{{box.bigfooter}}\n{{box.footer}}\n'),
(12, 'Box.Body_DSGVO', '{{box.navigator}}\n{{box.header}}\n	\n&lt;main id=\"main\"&gt;\n\n  &lt;section id=\"privacy\" class=\"privacy section-bg\"&gt;\n    &lt;div class=\"container\" data-aos=\"fade-up\"&gt;\n      &lt;div class=\"row\" data-aos=\"fade-up\" data-aos-delay=\"0\"&gt;\n        &lt;div class=\"col-lg-12\"&gt;\n		{{inhalt}}\n        &lt;/div&gt;\n      &lt;/div&gt;\n    &lt;/div&gt;\n  &lt;/section&gt;\n&lt;/main&gt;\n\n{{box.bigfooter}}\n{{box.footer}}\n');

-- --------------------------------------------------------

--
-- Table structure for table `mvc_parameter`
--

CREATE TABLE `mvc_parameter` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mvc_parameter`
--

INSERT INTO `mvc_parameter` (`id`, `name`, `type`) VALUES
(1, 'title', 1),
(2, 'beschreibung', 3);

-- --------------------------------------------------------

--
-- Table structure for table `mvc_parameterinhalt`
--

CREATE TABLE `mvc_parameterinhalt` (
  `id` int(11) NOT NULL,
  `pageid` int(11) NOT NULL,
  `wert` text COLLATE utf8_unicode_ci NOT NULL,
  `parentid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mvc_parameterinhalt`
--

INSERT INTO `mvc_parameterinhalt` (`id`, `pageid`, `wert`, `parentid`) VALUES
(1, 1, 'sahin.cloud iysCms | Autohändler Ihres Vertrauens!', 1),
(2, 1, 'sahin.cloud iysCms ist Ihr fairer exklusiv Gebrauchtwagen An- und Verkaufspartner mit Sitz in Ratingen. Lernen Sie uns kennen und überzeugen Sie sich selbst! Wir stehen gerne jederzeit mit Rat und Tat zur Ihrer Seite. Schauen Sie einfach vorbei und nutzen Sie die Gelegenheit einer Probefahrt.', 2),
(3, 3, 'sahin.cloud iysCms | Standort', 1),
(4, 3, 'Adresse bzw. Standort von sahin.cloud iysCms finden Sie hier!', 2),
(5, 4, 'sahin.cloud iysCms | Kontakt', 1),
(6, 4, 'Kontaktformular  und Kontaktdaten von sahin.cloud iysCms finden Sie hier!', 2),
(7, 5, 'sahin.cloud iysCms | Wir kaufen Ihr Auto!', 1),
(8, 5, 'Wir, sahin.cloud iysCms, sind gespannt auf Ihre Angebote!', 2),
(9, 2, 'sahin.cloud iysCms | Fahrzeuge', 1),
(10, 2, 'sahin.cloud iysCms Fahrzeugbestand', 2),
(11, 6, 'sahin.cloud iysCms | Impressum', 1),
(12, 6, 'sahin.cloud iysCms, Borsigstraße 7, 40880 Ratingen', 2),
(13, 7, 'sahin.cloud iysCms | Datenschutzerklärung', 1),
(14, 7, 'sahin.cloud iysCms | Datenschutzerklärung', 2);

-- --------------------------------------------------------

--
-- Table structure for table `panels`
--

CREATE TABLE `panels` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `source` text CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `panels`
--

INSERT INTO `panels` (`id`, `name`, `source`) VALUES
(3, 'Panel.Navigator.Links', '&lt;li&gt;&lt;a class=\"nav-link scrollto\" href=\"{{link}}\" title=\"{{name}}\"&gt;{{name}}&lt;/a&gt;&lt;/li&gt;'),
(4, 'Panel.Sitemap', '&lt;li&gt;&lt;i class=\"bx bx-chevron-right\"&gt;&lt;/i&gt; &lt;a href=\"{{link}}\" title=\"{{name}}\"&gt;{{name}}&lt;/a&gt;&lt;/li&gt;'),
(5, 'Panel.Oeffnungzeiten', '&lt;li&gt;&lt;i class=\"bx bx-chevron-right\"&gt;&lt;/i&gt;{{tag}}: {{uhrzeit}}&lt;/li&gt;'),
(6, 'Panel.btnPortale', '&lt;a href=\"{{link}}\" target=\"_blank\" class=\"btn btn-default btn-block\"&gt;&lt;span&gt;{{name}}&lt;/span&gt;&lt;/a&gt;'),
(7, 'Panel.Vorteile', '           &lt;div class=\"col-lg-3 col-md-6 d-flex align-items-stretch mt-4\" data-aos=\"zoom-in\" data-aos-delay=\"0\"&gt;\n                &lt;div class=\"icon-box\"&gt;\n                        &lt;div class=\"icon\"&gt;&lt;i class=\"{{icon}}\"&gt;&lt;/i&gt;&lt;/div&gt;\n                        &lt;h4&gt;\n                            {{title}}\n                        &lt;/h4&gt;\n                        {{beschreibung}}\n                &lt;/div&gt;\n            &lt;/div&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `parameter`
--

CREATE TABLE `parameter` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fremdid` int(11) NOT NULL,
  `sorte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `parameter`
--

INSERT INTO `parameter` (`id`, `name`, `type`, `fremdid`, `sorte`) VALUES
(2, 'author', '1', 1, 1),
(3, 'domain', '1', 1, 1),
(4, 'keywords', '3', 1, 1),
(6, 'abstraktebeschreibung', '1', 1, 1),
(7, 'thema', '1', 1, 1),
(8, 'thematype', '1', 1, 1),
(9, 'zielgruppe', '1', 1, 1),
(10, 'img.logo.url', '2', 3, 1),
(11, 'img.logo.text', '1', 3, 1),
(12, 'box.header', '6_3', 2, 1),
(13, 'box.navigator', '6_4', 2, 1),
(14, 'box.bigfooter', '6_5', 2, 1),
(15, 'box.footer', '6_6', 2, 1),
(19, 'ueberschrift1', '1', 2, 1),
(20, 'inhalt', '4', 2, 1),
(26, 'link', '1', 3, 2),
(27, 'name', '1', 3, 2),
(28, 'panel.menulink', '5_3', 4, 1),
(29, 'menueIcon', '2', 4, 1),
(33, 'routeplaner.link', '1', 5, 1),
(34, 'adresse', '3', 5, 1),
(35, 'telefonnummer', '1', 5, 1),
(36, 'mailadresse', '1', 5, 1),
(37, 'link', '1', 4, 2),
(38, 'name', '1', 4, 2),
(39, 'tag', '1', 5, 2),
(40, 'uhrzeit', '1', 5, 2),
(41, 'panel.sitemap', '5_4', 5, 1),
(42, 'panel.oeffnungzeiten', '5_5', 5, 1),
(51, 'box.header', '6_3', 8, 1),
(52, 'box.navigator', '6_4', 8, 1),
(53, 'box.bigfooter', '6_5', 8, 1),
(54, 'box.footer', '6_6', 8, 1),
(55, 'box.header', '6_3', 9, 1),
(56, 'box.navigator', '6_4', 9, 1),
(57, 'box.bigfooter', '6_5', 9, 1),
(58, 'box.footer', '6_6', 9, 1),
(59, 'standort', '3', 8, 1),
(60, 'routeplaner.link', '1', 8, 1),
(61, 'standort.bild', '2', 8, 1),
(62, 'routeplaner.link', '1', 9, 1),
(63, 'adresse', '3', 9, 1),
(64, 'telefonnummer', '1', 9, 1),
(65, 'mailadresse', '1', 9, 1),
(73, 'box.header', '6_3', 11, 1),
(74, 'box.navigator', '6_4', 11, 1),
(75, 'box.bigfooter', '6_5', 11, 1),
(76, 'box.footer', '6_6', 11, 1),
(77, 'Impressum', '4', 11, 1),
(81, 'name', '1', 6, 2),
(82, 'link', '1', 6, 2),
(83, 'portale', '5_6', 9, 1),
(84, 'box.header', '6_3', 12, 1),
(85, 'box.navigator', '6_4', 12, 1),
(86, 'inhalt', '4', 12, 1),
(87, 'box.bigfooter', '6_5', 12, 1),
(88, 'box.footer', '6_6', 12, 1),
(92, 'img.banner.url', '2', 3, 1),
(93, 'company.name', '4', 3, 1),
(94, 'company.description', '4', 3, 1),
(95, 'seiten.name', '1', 5, 1),
(96, 'icon', '1', 7, 2),
(97, 'title', '1', 7, 2),
(98, 'beschreibung', '4', 7, 2),
(99, 'panel.vorteile', '5_7', 2, 1),
(100, 'routeplaner.iframe', '1', 8, 1),
(101, 'panel.vorteile.title', '1', 2, 1),
(102, 'panel.vorteile.beschreibung', '1', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `parameterinhalt`
--

CREATE TABLE `parameterinhalt` (
  `id` int(11) NOT NULL,
  `paraid` int(11) NOT NULL,
  `parentid` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `sorte` int(11) NOT NULL,
  `fremdid` int(11) NOT NULL,
  `wert` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `parameterinhalt`
--

INSERT INTO `parameterinhalt` (`id`, `paraid`, `parentid`, `type`, `sorte`, `fremdid`, `wert`) VALUES
(2, 2, 2, 1, 1, 1, 'Ahmet-Kamil Arik'),
(3, 3, 3, 1, 1, 1, 'sahin.cloud'),
(4, 4, 4, 3, 1, 1, 'sahin.cloud, autohändler, sahin.cloud iysCms, iysCms sahin.cloud, sahin.cloud-iysCms, iysCms, sahin.cloud-iysCms ratingen, sahin.cloud ratingen, gebrauchwagen, autohaus, autogalerie, auto, mobile, resi, auto resi, auto residenz, sahin.cloud residenz'),
(6, 6, 6, 1, 1, 1, 'sahin.cloud iysCms bietet Ihnen die preiswertigsten und leistungsfähigsten sahin.cloudn!'),
(7, 7, 7, 1, 1, 1, 'Dienstleistung'),
(8, 8, 8, 1, 1, 1, 'Produktinfo'),
(9, 9, 9, 1, 1, 1, 'Alle'),
(10, 37, 1, 1, 2, 4, '/startseite'),
(11, 38, 1, 1, 2, 4, 'Startseite'),
(18, 33, 33, 1, 1, 5, 'https://goo.gl/maps/4JGCEXmVb52V49Sd9'),
(19, 34, 34, 3, 1, 5, 'Hofsteder Str. 141\n44809 Bochum'),
(20, 35, 35, 1, 1, 5, '+49 234 60 29 182'),
(21, 36, 36, 1, 1, 5, 'admin@davinci-consulting.net'),
(25, 10, 10, 2, 1, 3, '/img/icons/grossesIcon.png'),
(26, 11, 11, 1, 1, 3, 'sahin.cloud iysCms'),
(27, 29, 29, 2, 1, 4, '/img/icons/grossesIcon.png'),
(28, 19, 19, 1, 1, 2, 'Dienstleister Ihres Vertrauens'),
(29, 20, 20, 4, 1, 2, '<h4>sahin.cloud iysCms ist Ihr fairer exklusiv Dienstleister mit Sitz in Bochum.</h4>\n\n<h4>Wir stehen gerne jederzeit mit Rat und Tat zur Ihrer Seite. Schauen Sie einfach vorbei und nutzen Sie die Gelegenheit für ein Kennenlernen.</h4>\n\n<h4>Lernen Sie uns kennen und überzeugen Sie sich selbst!</h4>\n\n<p> </p>\n\n<p> </p>\n'),
(50, 26, 12, 1, 2, 3, '/startseite'),
(51, 27, 12, 1, 2, 3, 'Startseite'),
(58, 39, 5, 1, 2, 5, 'Montag'),
(59, 40, 5, 1, 2, 5, '9.00 - 18:30 Uhr'),
(60, 39, 6, 1, 2, 5, 'Dienstag'),
(61, 40, 6, 1, 2, 5, '9.00 - 18:30 Uhr'),
(62, 39, 7, 1, 2, 5, 'Mittwoch'),
(63, 40, 7, 1, 2, 5, '9.00 - 18:30 Uhr'),
(64, 39, 8, 1, 2, 5, 'Donnerstag'),
(65, 40, 8, 1, 2, 5, '9.00 - 18:30 Uhr'),
(66, 39, 9, 1, 2, 5, 'Freitag'),
(67, 40, 9, 1, 2, 5, '9.00 - 18:30 Uhr'),
(68, 39, 10, 1, 2, 5, 'Samstag'),
(69, 40, 10, 1, 2, 5, '9.00 - 15:00 Uhr'),
(70, 39, 11, 1, 2, 5, 'Sonntag'),
(71, 40, 11, 1, 2, 5, 'geschlossen'),
(73, 60, 60, 1, 1, 8, 'https://goo.gl/maps/4JGCEXmVb52V49Sd9'),
(74, 59, 59, 3, 1, 8, 'Hofsteder Str. 141\n44809 Bochum'),
(75, 61, 61, 2, 1, 8, '/img/icons/grossesIcon.png'),
(76, 62, 62, 1, 1, 9, 'https://maps.google.com/maps/dir/\'\'/sahin.cloud-iysCms.de/@51.3024366,6.7661576,12z/data=!3m1!4b1!4m8!4m7!1m0!1m5!1m1!1s0x47b8957d6a3f852d:0x71f26855b844d6e9!2m2!1d6.8361971!2d51.3024575'),
(77, 63, 63, 3, 1, 9, 'Hofsteder Str. 141\n44809 Bochum'),
(78, 64, 64, 1, 1, 9, '+49 234 60 29 182'),
(79, 65, 65, 1, 1, 9, 'admin@davinci-consulting.net'),
(81, 37, 24, 1, 2, 4, '/standort'),
(82, 38, 24, 1, 2, 4, 'Standort'),
(83, 26, 25, 1, 2, 3, '/standort'),
(84, 27, 25, 1, 2, 3, 'Standort'),
(89, 37, 26, 1, 2, 4, '/kontakt'),
(90, 38, 26, 1, 2, 4, 'Kontakt'),
(93, 37, 27, 1, 2, 4, '/impressum'),
(94, 38, 27, 1, 2, 4, 'Impressum'),
(95, 26, 28, 1, 2, 3, '/kontakt'),
(96, 27, 28, 1, 2, 3, 'Kontakt'),
(104, 86, 86, 4, 1, 12, '<h1 style=\"word-break: inherit;\">Datenschutzerkl&auml;rung</h1>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 15px;\">sahin.cloud iysCms<br style=\"box-sizing: border-box;\" />\nHofsteder Str. 141<br style=\"box-sizing: border-box;\" />\n44809 Bochum</p>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 15px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">Vertreten Gesch&auml;ftsf&uuml;hrer:&nbsp;</span><br style=\"box-sizing: border-box;\" />\nA. Sahin</p>\n\n<p style=\"box-sizing: border-box; margin: 0px 0px 10px; font-family: Arial, Helvetica, sans-serif; font-size: 15px;\"><span style=\"box-sizing: border-box; font-weight: 700;\">Kontakt:</span><br style=\"box-sizing: border-box;\" />\nTelefon: +49 234 60 29 182<br style=\"box-sizing: border-box;\" />\nE-Mail: admin@davinci-consulting.net</p>\n\n<p>Link zum Impressum: https://sahin.cloud-iysCms.de/impressum</p>\n\n<p>Bei der Kontaktaufnahme mit uns (z.B. per Kontaktformular, E-Mail, Telefon oder via sozialer Medien) werden die Angaben des Nutzers zur Bearbeitung der Kontaktanfrage und deren Abwicklung gem. Art. 6 Abs. 1 lit. b. (im Rahmen vertraglicher-/vorvertraglicher Beziehungen), Art. 6 Abs. 1 lit. f. (andere Anfragen) DSGVO verarbeitet.. Die Angaben der Nutzer k&ouml;nnen in einem Customer-Relationship-Management System (&quot;CRM System&quot;) oder vergleichbarer Anfragenorganisation gespeichert werden.</p>\n\n<p>Wir l&ouml;schen die Anfragen, sofern diese nicht mehr erforderlich sind. Wir &uuml;berpr&uuml;fen die Erforderlichkeit alle zwei Jahre; Ferner gelten die gesetzlichen Archivierungspflichten.</p>\n\n<p>&nbsp;</p>\n\n<h3 open=\"\" sans=\"\" style=\"box-sizing: border-box; font-family: \">Geltungsbereich</h3>\n\n<p open=\"\" sans=\"\" style=\"font-size: 16px; box-sizing: border-box; margin: 0px 0px 10px; caret-color: rgb(34, 34, 34); color: rgb(34, 34, 34); font-family: \">Diese Datenschutzerkl&auml;rung soll die Nutzer dieser Website gem&auml;&szlig; europ&auml;schischer Datenschutzgrundverordnung (DSGVO) &uuml;ber die Art, den Umfang und den Zweck der Erhebung und Verwendung personenbezogener Daten durch den Websitebetreiber Sebastian Prohaska informieren.<br style=\"box-sizing: border-box;\" />\nDer Websitebetreiber nimmt Ihren Datenschutz sehr ernst und behandelt Ihre personenbezogenen Daten vertraulich und entsprechend der gesetzlichen Vorschriften.<br style=\"box-sizing: border-box;\" />\nBedenken Sie, dass die Daten&uuml;bertragung im Internet grunds&auml;tzlich mit Sicherheitsl&uuml;cken bedacht sein kann. Ein vollumf&auml;nglicher Schutz vor dem Zugriff durch Fremde ist nicht realisierbar.</p>\n\n<h3 open=\"\" sans=\"\" style=\"box-sizing: border-box; font-family: \"><br style=\"box-sizing: border-box;\" />\nZugriffsdaten</h3>\n\n<p open=\"\" sans=\"\" style=\"font-size: 16px; box-sizing: border-box; margin: 0px 0px 10px; caret-color: rgb(34, 34, 34); color: rgb(34, 34, 34); font-family: \">Der Websitebetreiber bzw. Seitenprovider erhebt Daten &uuml;ber Zugriffe auf die Seite und speichert diese als &bdquo;Server-Logfiles&ldquo; ab. Folgende Daten werden so protokolliert:<br style=\"box-sizing: border-box;\" />\n&bull; Besuchte Website<br style=\"box-sizing: border-box;\" />\n&bull; Uhrzeit zum Zeitpunkt des Zugriffes<br style=\"box-sizing: border-box;\" />\n&bull; Menge der gesendeten Daten in Byte<br style=\"box-sizing: border-box;\" />\n&bull; Quelle/Verweis, von welchem Sie auf die Seite gelangten<br style=\"box-sizing: border-box;\" />\n&bull; Verwendeter Browser<br style=\"box-sizing: border-box;\" />\n&bull; Verwendetes Betriebssystem<br style=\"box-sizing: border-box;\" />\n&bull; Verwendete IP-Adresse<br style=\"box-sizing: border-box;\" />\nDie erhobenen Daten dienen lediglich statistischen Auswertungen und zur Verbesserung der Website. Der Websitebetreiber beh&auml;lt sich allerdings vor, die Server-Logfiles nachtr&auml;glich zu &uuml;berpr&uuml;fen, sollten konkrete Anhaltspunkte auf eine rechtswidrige Nutzung hinweisen.</p>\n\n<h3 open=\"\" sans=\"\" style=\"box-sizing: border-box; font-family: \"><br style=\"box-sizing: border-box;\" />\nCookies</h3>\n\n<p open=\"\" sans=\"\" style=\"font-size: 16px; box-sizing: border-box; margin: 0px 0px 10px; caret-color: rgb(34, 34, 34); color: rgb(34, 34, 34); font-family: \">Diese Website verwendet Cookies. Dabei handelt es sich um kleine Textdateien, welche auf Ihrem Endger&auml;t gespeichert werden. Diese richten keinerlei Schaden an. Ihr Browser greift auf diese Dateien zu. Durch den Einsatz von Cookies erh&ouml;ht sich die Benutzerfreundlichkeit und Sicherheit dieser Website.<br style=\"box-sizing: border-box;\" />\nG&auml;ngige Browser bieten die Einstellungsoption, Cookies nicht zuzulassen. Hinweis: Es ist nicht gew&auml;hrleistet, dass Sie auf alle Funktionen dieser Website ohne Einschr&auml;nkungen zugreifen k&ouml;nnen, wenn Sie entsprechende Einstellungen vornehmen.</p>\n\n<h3 open=\"\" sans=\"\" style=\"box-sizing: border-box; font-family: \"><br style=\"box-sizing: border-box;\" />\nUmgang mit personenbezogenen Daten</h3>\n\n<p open=\"\" sans=\"\" style=\"font-size: 16px; box-sizing: border-box; margin: 0px 0px 10px; caret-color: rgb(34, 34, 34); color: rgb(34, 34, 34); font-family: \">Der Websitebetreiber erhebt, nutzt und gibt Ihre personenbezogenen Daten nur dann weiter, wenn dies im gesetzlichen Rahmen erlaubt ist oder Sie in die Datenerhebung einwilligen.<br style=\"box-sizing: border-box;\" />\nAls personenbezogene Daten gelten s&auml;mtliche Informationen, welche dazu dienen, Ihre Person zu bestimmen und welche zu Ihnen zur&uuml;ckverfolgt werden k&ouml;nnen &ndash; also beispielsweise Ihr Name, Ihre E-Mail-Adresse und Telefonnummer.</p>\n\n<h3 open=\"\" sans=\"\" style=\"box-sizing: border-box; font-family: \"><br style=\"box-sizing: border-box;\" />\nUmgang mit Kontaktdaten</h3>\n\n<p open=\"\" sans=\"\" style=\"font-size: 16px; box-sizing: border-box; margin: 0px 0px 10px; caret-color: rgb(34, 34, 34); color: rgb(34, 34, 34); font-family: \">Nehmen Sie mit dem Websitebetreiber durch die angebotenen Kontaktm&ouml;glichkeiten Verbindung auf, werden Ihre Angaben f&uuml;r einen Zeitraum von sechs Monaten gespeichert, damit auf diese zur Bearbeitung und Beantwortung Ihrer Anfrage und f&uuml;r den Fall von Anschlussfragen zur&uuml;ckgegriffen werden kann. Ohne Ihre Einwilligung werden diese Daten nicht an Dritte weitergegeben.</p>\n\n<h3 open=\"\" sans=\"\" style=\"box-sizing: border-box; font-family: \"><br style=\"box-sizing: border-box;\" />\nUmgang mit Kommentaren und Beitr&auml;gen - Discqus</h3>\n\n<p open=\"\" sans=\"\" style=\"font-size: 16px; box-sizing: border-box; margin: 0px 0px 10px; caret-color: rgb(34, 34, 34); color: rgb(34, 34, 34); font-family: \">Hinterlassen Sie auf dieser Website einen Beitrag oder Kommentar, wird Ihre IP-Adresse gespeichert. Dies dient der Sicherheit des Websitebetreibers: Verst&ouml;&szlig;t Ihr Text gegen das Recht, m&ouml;chte er Ihre Identit&auml;t nachverfolgen k&ouml;nnen.</p>\n\n<p open=\"\" sans=\"\" style=\"font-size: 16px; box-sizing: border-box; margin: 0px 0px 10px; caret-color: rgb(34, 34, 34); color: rgb(34, 34, 34); font-family: \">Wir bieten Ihnen an, auf unseren Internetseiten Fragen, Antworten, Meinungen oder Bewertungen, nachfolgend nur &bdquo;Beitr&auml;ge genannt, zu ver&ouml;ffentlichen. Sofern Sie dieses Angebot in Anspruch nehmen, verarbeiten und ver&ouml;ffentlichen wir Ihren Beitrag, Datum und Uhrzeit der Einreichung sowie das von Ihnen ggf. genutzte Pseudonym.</p>\n\n<p open=\"\" sans=\"\" style=\"font-size: 16px; box-sizing: border-box; margin: 0px 0px 10px; caret-color: rgb(34, 34, 34); color: rgb(34, 34, 34); font-family: \">Rechtsgrundlage hierbei ist Art. 6 Abs. 1 lit. a) DSGVO. Die Einwilligung k&ouml;nnen Sie gem&auml;&szlig; Art. 7 Abs. 3 DSGVO jederzeit mit Wirkung f&uuml;r die Zukunft widerrufen. Hierzu m&uuml;ssen Sie uns lediglich &uuml;ber Ihren Widerruf in Kenntnis setzen.</p>\n\n<p open=\"\" sans=\"\" style=\"font-size: 16px; box-sizing: border-box; margin: 0px 0px 10px; caret-color: rgb(34, 34, 34); color: rgb(34, 34, 34); font-family: \">Dar&uuml;ber hinaus verarbeiten wir auch Ihre IP- und E-Mail-Adresse. Die IP-Adresse wird verarbeitet, weil wir ein berechtigtes Interesse daran haben, weitere Schritte einzuleiten oder zu unterst&uuml;tzen, sofern Ihr Beitrag in Rechte Dritter eingreift und/oder er sonst wie rechtswidrig erfolgt.</p>\n\n<p open=\"\" sans=\"\" style=\"font-size: 16px; box-sizing: border-box; margin: 0px 0px 10px; caret-color: rgb(34, 34, 34); color: rgb(34, 34, 34); font-family: \">Rechtsgrundlage ist in diesem Fall Art. 6 Abs. 1 lit. f) DSGVO. Unser berechtigtes Interesse liegt in der ggf. notwendigen Rechtsverteidigung.</p>\n\n<h3 open=\"\" sans=\"\" style=\"box-sizing: border-box; font-family: \"><br style=\"box-sizing: border-box;\" />\nAbonnements</h3>\n\n<p open=\"\" sans=\"\" style=\"font-size: 16px; box-sizing: border-box; margin: 0px 0px 10px; caret-color: rgb(34, 34, 34); color: rgb(34, 34, 34); font-family: \">Sie haben die M&ouml;glichkeit, sowohl die gesamte Website als auch Nachfolgekommentare auf Ihren Beitrag zu abonnieren. Sie erhalten eine E-Mail zur Best&auml;tigung Ihrer E-Mail-Adresse. Neben dieser werden keine weiteren Daten erhoben. Die gespeicherten Daten werden nicht an Dritte weitergereicht. Sie k&ouml;nnen ein Abonnement jederzeit abbestellen.</p>\n\n<h3 open=\"\" sans=\"\" style=\"box-sizing: border-box; font-family: \"><br style=\"box-sizing: border-box;\" />\nGoogle Analytics</h3>\n\n<p open=\"\" sans=\"\" style=\"font-size: 16px; box-sizing: border-box; margin: 0px 0px 10px; caret-color: rgb(34, 34, 34); color: rgb(34, 34, 34); font-family: \">Diese Website nutzt den Dienst &bdquo;Google Analytics&ldquo;, welcher von der Google Inc. (1600 Amphitheatre Parkway Mountain View, CA 94043, USA) angeboten wird, zur Analyse der Websitebenutzung durch Nutzer. Der Dienst verwendet &bdquo;Cookies&ldquo; &ndash; Textdateien, welche auf Ihrem Endger&auml;t gespeichert werden. Die durch die Cookies gesammelten Informationen werden im Regelfall an einen Google-Server in den USA gesandt und dort gespeichert.<br style=\"box-sizing: border-box;\" />\n<br style=\"box-sizing: border-box;\" />\nAuf dieser Website greift die IP-Anonymisierung. Die IP-Adresse der Nutzer wird innerhalb der Mitgliedsstaaten der EU und des Europ&auml;ischen Wirtschaftsraum gek&uuml;rzt. Durch diese K&uuml;rzung entf&auml;llt der Personenbezug Ihrer IP-Adresse. Im Rahmen der Vereinbarung zur Auftragsdatenvereinbarung, welche die Websitebetreiber mit der Google Inc. geschlossen haben, erstellt diese mithilfe der gesammelten Informationen eine Auswertung der Websitenutzung und der Websiteaktivit&auml;t und erbringt mit der Internetnutzung verbundene Dienstleistungen.<br style=\"box-sizing: border-box;\" />\nSie haben die M&ouml;glichkeit, die Speicherung des Cookies auf Ihrem Ger&auml;t zu verhindern, indem Sie in Ihrem Browser entsprechende Einstellungen vornehmen. Es ist nicht gew&auml;hrleistet, dass Sie auf alle Funktionen dieser Website ohne Einschr&auml;nkungen zugreifen k&ouml;nnen, wenn Ihr Browser keine Cookies zul&auml;sst.<br style=\"box-sizing: border-box;\" />\n<br style=\"box-sizing: border-box;\" />\nWeiterhin k&ouml;nnen Sie durch ein Browser-Plugin verhindern, dass die durch Cookies gesammelten Informationen (inklusive Ihrer IP-Adresse) an die Google Inc. gesendet und von der Google Inc. genutzt werden. Folgender Link f&uuml;hrt Sie zu dem entsprechenden Plugin:&nbsp;<a href=\"https://tools.google.com/dlpage/gaoptout?hl=de\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(82, 182, 232); text-decoration: none; transition: color 400ms, background-color 400ms;\">https://tools.google.com/dlpage/gaoptout?hl=de</a><br style=\"box-sizing: border-box;\" />\n<br style=\"box-sizing: border-box;\" />\nAlternativ verhindern Sie mit einem Klick auf diesen Link (WICHTIG! Opt-Out-Link einf&uuml;gen), dass Google Analytics innerhalb dieser Website Daten &uuml;ber Sie erfasst. Mit dem Klick auf obigen Link laden Sie ein &bdquo;Opt-Out-Cookie&ldquo; herunter. Ihr Browser muss die Speicherung von Cookies also hierzu grunds&auml;tzlich erlauben. L&ouml;schen Sie Ihre Cookies regelm&auml;&szlig;ig, ist ein erneuter Klick auf den Link bei jedem Besuch dieser Website vonn&ouml;ten.<br style=\"box-sizing: border-box;\" />\nHier finden Sie weitere Informationen zur Datennutzung durch die Google Inc.:&nbsp;<a href=\"https://support.google.com/analytics/answer/6004245?hl=de\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(82, 182, 232); text-decoration: none; transition: color 400ms, background-color 400ms;\">https://support.google.com/analytics/answer/6004245?hl=de</a></p>\n\n<h3 open=\"\" sans=\"\" style=\"box-sizing: border-box; font-family: \"><br style=\"box-sizing: border-box;\" />\nNutzung von Social-Media-Plugins</h3>\n\n<p open=\"\" sans=\"\" style=\"font-size: 16px; box-sizing: border-box; margin: 0px 0px 10px; caret-color: rgb(34, 34, 34); color: rgb(34, 34, 34); font-family: \">Diese Website verwendet Facebook Social Plugins, welches von der Facebook Inc. (1 Hacker Way, Menlo Park, California 94025, USA) betrieben wird. Erkennbar sind die Einbindungen an dem Facebook-Logo bzw. an den Begriffen &bdquo;Like&ldquo;, &bdquo;Gef&auml;llt mir&ldquo;, &bdquo;Teilen&ldquo; in den Farben Facebooks (Blau und Wei&szlig;). Informationen zu allen Facebook-Plugins finden Sie im folgenden Link:&nbsp;<a href=\"https://developers.facebook.com/docs/plugins/\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(82, 182, 232); text-decoration: none; transition: color 400ms, background-color 400ms;\">https://developers.facebook.com/docs/plugins/</a></p>\n\n<p open=\"\" sans=\"\" style=\"font-size: 16px; box-sizing: border-box; margin: 0px 0px 10px; caret-color: rgb(34, 34, 34); color: rgb(34, 34, 34); font-family: \">Das Plugin stellt eine direkte Verbindung zwischen Ihrem Browser und den Facebook-Servern her. Der Websitebetreiber hat keinerlei Einfluss auf die Natur und den Umfang der Daten, welche das Plugin an die Server der Facebook Inc. &uuml;bermittelt. Informationen dazu finden Sie hier: https://www.facebook.com/help/186325668085084<br style=\"box-sizing: border-box;\" />\nDas Plugin informiert die Facebook Inc. dar&uuml;ber, dass Sie Nutzer diese Website besucht hat. Es besteht hierbei die M&ouml;glichkeit, dass Ihre IP-Adresse gespeichert wird. Sind Sie w&auml;hrend des Besuchs auf dieser Website in Ihrem Facebook-Konto eingeloggt, werden die genannten Informationen mit diesem verkn&uuml;pft.</p>\n\n<p open=\"\" sans=\"\" style=\"font-size: 16px; box-sizing: border-box; margin: 0px 0px 10px; caret-color: rgb(34, 34, 34); color: rgb(34, 34, 34); font-family: \">Nutzen Sie die Funktionen des Plugins &ndash; etwa indem Sie einen Beitrag teilen oder &bdquo;liken&ldquo; &ndash; werden die entsprechenden Informationen ebenfalls an die Facebook Inc. &uuml;bermittelt.<br style=\"box-sizing: border-box;\" />\n<br style=\"box-sizing: border-box;\" />\nM&ouml;chten Sie verhindern, dass die Facebook. Inc. diese Daten mit Ihrem Facebook-Konto verkn&uuml;pft, loggen Sie sich bitte vor dem Besuch dieser Website bei Facebook aus.<br style=\"box-sizing: border-box;\" />\n<br style=\"box-sizing: border-box;\" />\nWeiterhin nutzt diese Website die &bdquo;+1&ldquo;-Schaltfl&auml;che von Google Plus. Betrieben wird diese von der Google Inc. (1600 Amphitheatre Parkway Mountain View, CA 94043, USA). Besuchen Sie eine Seite, welche die &bdquo;+1&ldquo;-Schaltfl&auml;che enth&auml;lt, entsteht eine direkte Verbindung zwischen Ihrem Browser und den Google-Servern. Der Websitebetreiber hat daher keinerlei Einfluss auf die Natur und den Umfang der Daten, welche das Plugin an die Server der Google Inc. &uuml;bermitteln. Klicken Sie auf den &bdquo;+1&ldquo;-Button, w&auml;hrend Sie in Google + angemeldet sind, teilen Sie die Inhalte der Seite auf Ihrem &ouml;ffentlichen Profil.<br style=\"box-sizing: border-box;\" />\n<br style=\"box-sizing: border-box;\" />\nPersonenbezogene Daten werden laut der Google Inc. erst dann erhoben, wenn Sie auf die Schaltfl&auml;che klicken. Auch bei eingeloggten Google-Nutzern wird unter anderem die IP-Adresse gespeichert. M&ouml;chten Sie verhindern, dass die Google Inc. diese Daten speichert und mit Ihrem Konto verkn&uuml;pft, loggen Sie sich bitte vor dem Besuch dieser Website aus.<br style=\"box-sizing: border-box;\" />\n<br style=\"box-sizing: border-box;\" />\nInformationen zur &bdquo;+1&ldquo;-Schaltfl&auml;che finden Sie hier:&nbsp;<a href=\"https://developers.google.com/+/web/buttons-policy\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(82, 182, 232); text-decoration: none; transition: color 400ms, background-color 400ms;\">https://developers.google.com/+/web/buttons-policy</a>.<br style=\"box-sizing: border-box;\" />\n<br style=\"box-sizing: border-box;\" />\nWeiterhin nutzt diese Website Twitter-Schlatfl&auml;chen. Betrieben werden diese von der Twitter Inc. (795 Folsom St., Suite 600, San Francisco, CA 94107, USA). Besuchen Sie eine Seite, welche eine solche Schaltfl&auml;che enth&auml;lt, entsteht eine direkte Verbindung zwischen Ihrem Browser und den Twitter-Servern. Der Websitebetreiber hat daher keinerlei Einfluss &uuml;ber die Natur und den Umfang der Daten, welche das Plugin an die Server Twitter Inc. &uuml;bermittelt.<br style=\"box-sizing: border-box;\" />\n<br style=\"box-sizing: border-box;\" />\nGem&auml;&szlig; der Twitter Inc. wird dabei allein Ihre IP-Adresse erhoben und gespeichert.<br style=\"box-sizing: border-box;\" />\nInformationen zu dem Umgang mit personenbezogenen Daten durch die Twitter Inc. finden Sie hier:&nbsp;<a href=\"https://twitter.com/privacy?lang=de\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(82, 182, 232); text-decoration: none; transition: color 400ms, background-color 400ms;\">https://twitter.com/privacy?lang=de</a></p>\n\n<h3 open=\"\" sans=\"\" style=\"box-sizing: border-box; font-family: \"><br style=\"box-sizing: border-box;\" />\nNewsletter-Abonnement</h3>\n\n<p open=\"\" sans=\"\" style=\"font-size: 16px; box-sizing: border-box; margin: 0px 0px 10px; caret-color: rgb(34, 34, 34); color: rgb(34, 34, 34); font-family: \">Der Websitebetreiber bietet Ihnen einen Newsletter an, in welchem er Sie &uuml;ber aktuelle Geschehnisse und Angebote informiert. M&ouml;chten Sie den Newsletter abonnieren, m&uuml;ssen Sie eine valide E-Mail-Adresse angeben. Diese wird lediglich f&uuml;r den Versand des abonnierten Newsletters verwendet&nbsp;und nicht an Dritte weitergereicht. Sie k&ouml;nnen das Abonnement jederzeit abbestellen.</p>\n\n<h3 open=\"\" sans=\"\" style=\"box-sizing: border-box; font-family: \"><br style=\"box-sizing: border-box;\" />\nRechte des Nutzers: Auskunft, Berichtigung und L&ouml;schung</h3>\n\n<p open=\"\" sans=\"\" style=\"font-size: 16px; box-sizing: border-box; margin: 0px 0px 10px; caret-color: rgb(34, 34, 34); color: rgb(34, 34, 34); font-family: \">Sie als Nutzer erhalten auf Antrag Ihrerseits kostenlose Auskunft dar&uuml;ber, welche personenbezogenen Daten &uuml;ber Sie gespeichert wurden. Sofern Ihr Wunsch nicht mit einer gesetzlichen Pflicht zur Aufbewahrung von Daten (z. B. Vorratsdatenspeicherung) kollidiert, haben Sie ein Anrecht auf Berichtigung falscher Daten und auf die Sperrung oder L&ouml;schung Ihrer personenbezogenen Daten.</p>\n\n<p open=\"\" sans=\"\" style=\"font-size: 16px; box-sizing: border-box; margin: 0px 0px 10px; caret-color: rgb(34, 34, 34); color: rgb(34, 34, 34); font-family: \">Diese Datenschutzerkl&auml;rung wurde von&nbsp;<a href=\"https://www.ithelps.at/datenschutzerklaerung#link_tab\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(82, 182, 232); text-decoration: none; transition: color 400ms, background-color 400ms;\" target=\"_blank\">ithelps</a>&nbsp;rechtm&auml;&szlig;ig kopiert.SEO Agentur und Webdesign Wien</p>\n\n<h3 open=\"\" sans=\"\" style=\"box-sizing: border-box; font-family: \"><br style=\"box-sizing: border-box;\" />\nYouTube</h3>\n\n<p open=\"\" sans=\"\" style=\"font-size: 16px; box-sizing: border-box; margin: 0px 0px 10px; caret-color: rgb(34, 34, 34); color: rgb(34, 34, 34); font-family: \">Unsere Seite verwendet f&uuml;r die Einbindung von Videos den Anbieter&nbsp;YouTube LLC ,&nbsp;901 Cherry Avenue, San Bruno, CA 94066, USA,&nbsp;vertreten durch Google Inc., 1600 Amphitheatre Parkway, Mountain View, CA 94043, USA. Normalerweise wird&nbsp;bereits bei Aufruf einer Seite mit&nbsp;eingebetteten Videos Ihre&nbsp;IP-Adresse an&nbsp;YouTube gesendet und Cookies auf Ihrem&nbsp;Rechner installiert. Wir haben unsere YouTube-Videos jedoch mit dem erweiterten Datenschutzmodus eingebunden (in diesem Fall nimmt&nbsp;YouTube immer noch Kontakt zu dem Dienst Double Klick von Google auf, doch werden&nbsp;dabei laut der Datenschutzerkl&auml;rung von Google personenbezogene Daten nicht ausgewertet). Dadurch&nbsp;werden von YouTube keine Informationen &uuml;ber die Besucher mehr&nbsp;gespeichert, es sei denn, sie sehen sich das Video an. Wenn Sie das&nbsp;Video anklicken, wird Ihre&nbsp;IP-Adresse an&nbsp;YouTube &uuml;bermittelt und&nbsp;YouTube erf&auml;hrt, dass Sie das&nbsp;Video angesehen haben. Sind Sie bei&nbsp;YouTube eingeloggt, wird diese Information auch Ihrem Benutzerkonto zugeordnet (dies k&ouml;nnen Sie verhindern, indem Sie sich vor dem Aufrufen des Videos bei&nbsp;YouTube ausloggen).</p>\n\n<p open=\"\" sans=\"\" style=\"font-size: 16px; box-sizing: border-box; margin: 0px 0px 10px; caret-color: rgb(34, 34, 34); color: rgb(34, 34, 34); font-family: \">Von der dann m&ouml;glichen Erhebung und Verwendung Ihrer Daten durch&nbsp;YouTube haben wir keine Kenntnis und darauf auch keinen Einfluss. N&auml;here Informationen k&ouml;nnen Sie der Datenschutzerkl&auml;rung von&nbsp;YouTube &nbsp;unter&nbsp;<a href=\"http://www.google.de/intl/de/policies/privacy/\" rel=\"noopener noreferrer\" style=\"box-sizing: border-box; background-color: transparent; color: rgb(82, 182, 232); text-decoration: none; transition: color 400ms, background-color 400ms;\" target=\"_blank\">www.google.de/intl/de/policies/privacy/</a>&nbsp;entnehmen. Zudem verweisen wir f&uuml;r den generellen Umgang mit und die Deaktivierung von Cookies auf unsere allgemeine Darstellung in dieser Datenschutzerkl&auml;rung.</p>\n'),
(107, 81, 32, 1, 2, 6, 'Test-Link Beispiel'),
(108, 82, 32, 1, 2, 6, 'https://example.com'),
(110, 37, 33, 1, 2, 4, '/dsgvo'),
(111, 38, 33, 1, 2, 4, 'Datenschutzerklärung'),
(112, 26, 34, 1, 2, 3, '/impressum'),
(113, 27, 34, 1, 2, 3, 'Impressum'),
(114, 26, 35, 1, 2, 3, '/dsgvo'),
(115, 27, 35, 1, 2, 3, 'DSGVO'),
(116, 92, 92, 2, 1, 3, '/img/content/bg.jpg'),
(118, 94, 94, 4, 1, 3, '<ul>\n	<li>Produkt 1</li>\n	<li>Produkt 2</li>\n	<li>Produkt 3</li>\n</ul>\n'),
(119, 93, 93, 4, 1, 3, '<p>iys-cms</p>\n'),
(120, 95, 95, 1, 1, 5, 'sahin.cloud iysCMS'),
(121, 77, 77, 4, 1, 11, '<h1 style=\"word-break: inherit;\">Impressum</h1>\n\n<p>Angaben gem&auml;&szlig; &sect; 5 TMG</p>\n\n<p>sahin.cloud iysCms<br />\nHofsteder Str. 141<br />\n44809 Bochum</p>\n\n<p><strong>Vertreten Gesch&auml;ftsf&uuml;hrer:&nbsp;</strong><br />\nA. Sahin</p>\n\n<p><strong>Kontakt:</strong><br />\nTelefon:&nbsp;<a href=\"tel:+49 234 60 29 182\">+49 234 60 29 182</a><br />\nE-Mail: admin@alpha-barbier.net</p>\n\n<p>&nbsp;</p>\n\n<p>Umsatzsteuer-Identifikationsnr. nach &sect;27a Umsatzsteuergesetzt:</p>\n\n<p>USt-ID-Nr.&nbsp;(engl. VAT ID): DE XXXXXX</p>\n\n<p>&nbsp;</p>\n\n<p><strong>Haftungsausschluss:&nbsp;</strong><br />\n<br />\n<strong>Haftung f&uuml;r Inhalte</strong><br />\n<br />\nDie Inhalte unserer Seiten wurden mit gr&ouml;&szlig;ter Sorgfalt erstellt. F&uuml;r die Richtigkeit, Vollst&auml;ndigkeit und Aktualit&auml;t der Inhalte k&ouml;nnen wir jedoch keine Gew&auml;hr &uuml;bernehmen. Als Diensteanbieter sind wir gem&auml;&szlig; &sect; 7 Abs.1 TMG f&uuml;r eigene Inhalte auf diesen Seiten nach den allgemeinen Gesetzen verantwortlich. Nach &sect;&sect; 8 bis 10 TMG sind wir als Diensteanbieter jedoch nicht verpflichtet, &uuml;bermittelte oder gespeicherte fremde Informationen zu &uuml;berwachen oder nach Umst&auml;nden zu forschen, die auf eine rechtswidrige T&auml;tigkeit hinweisen. Verpflichtungen zur Entfernung oder Sperrung der Nutzung von Informationen nach den allgemeinen Gesetzen bleiben hiervon unber&uuml;hrt. Eine diesbez&uuml;gliche Haftung ist jedoch erst ab dem Zeitpunkt der Kenntnis einer konkreten Rechtsverletzung m&ouml;glich. Bei Bekanntwerden von entsprechenden Rechtsverletzungen werden wir diese Inhalte umgehend entfernen.<br />\n<br />\n<strong>Haftung f&uuml;r Links</strong><br />\n<br />\nUnser Angebot enth&auml;lt Links zu externen Webseiten Dritter, auf deren Inhalte wir keinen Einfluss haben. Deshalb k&ouml;nnen wir f&uuml;r diese fremden Inhalte auch keine Gew&auml;hr &uuml;bernehmen. F&uuml;r die Inhalte der verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber der Seiten verantwortlich. Die verlinkten Seiten wurden zum Zeitpunkt der Verlinkung auf m&ouml;gliche Rechtsverst&ouml;&szlig;e &uuml;berpr&uuml;ft. Rechtswidrige Inhalte waren zum Zeitpunkt der Verlinkung nicht erkennbar. Eine permanente inhaltliche Kontrolle der verlinkten Seiten ist jedoch ohne konkrete Anhaltspunkte einer Rechtsverletzung nicht zumutbar. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Links umgehend entfernen.<br />\n<br />\n<strong>Urheberrecht</strong><br />\n<br />\nDie durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem deutschen Urheberrecht. Die Vervielf&auml;ltigung, Bearbeitung, Verbreitung und jede Art der Verwertung au&szlig;erhalb der Grenzen des Urheberrechtes bed&uuml;rfen der schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers. Downloads und Kopien dieser Seite sind nur f&uuml;r den privaten, nicht kommerziellen Gebrauch gestattet. Soweit die Inhalte auf dieser Seite nicht vom Betreiber erstellt wurden, werden die Urheberrechte Dritter beachtet. Insbesondere werden Inhalte Dritter als solche gekennzeichnet. Sollten Sie trotzdem auf eine Urheberrechtsverletzung aufmerksam werden, bitten wir um einen entsprechenden Hinweis. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Inhalte umgehend entfernen.<br />\n<br />\n<strong>Datenschutz</strong><br />\n<br />\nDie Nutzung unserer Webseite ist in der Regel ohne Angabe personenbezogener Daten m&ouml;glich. Soweit auf unseren Seiten personenbezogene Daten (beispielsweise Name, Anschrift oder eMail-Adressen) erhoben werden, erfolgt dies, soweit m&ouml;glich, stets auf freiwilliger Basis. Diese Daten werden ohne Ihre ausdr&uuml;ckliche Zustimmung nicht an Dritte weitergegeben.<br />\nWir weisen darauf hin, dass die Daten&uuml;bertragung im Internet (z.B. bei der Kommunikation per E-Mail) Sicherheitsl&uuml;cken aufweisen kann. Ein l&uuml;ckenloser Schutz der Daten vor dem Zugriff durch Dritte ist nicht m&ouml;glich.<br />\nDer Nutzung von im Rahmen der Impressumspflicht ver&ouml;ffentlichten Kontaktdaten durch Dritte zur &Uuml;bersendung von nicht ausdr&uuml;cklich angeforderter Werbung und Informationsmaterialien wird hiermit ausdr&uuml;cklich widersprochen. Die Betreiber der Seiten behalten sich ausdr&uuml;cklich rechtliche Schritte im Falle der unverlangten Zusendung von Werbeinformationen, etwa durch Spam-Mails, vor.</p>\n'),
(122, 96, 36, 1, 2, 7, 'bx bx-money-withdraw'),
(123, 97, 36, 1, 2, 7, 'Ads and social media'),
(124, 98, 36, 4, 2, 7, '<div>Advertising your services via Google AdSense or other possible advertise-providers and managing your social media. Read more.</div>\n'),
(125, 96, 37, 1, 2, 7, 'bx bx-book-content'),
(126, 97, 37, 1, 2, 7, 'Content-Creating'),
(127, 98, 37, 4, 2, 7, '<div>Creating search-engine optimized content for your website or video channel. Read more...</div>\n'),
(128, 96, 38, 1, 2, 7, 'bx bxs-graduation'),
(129, 97, 38, 1, 2, 7, 'Coaching and mentoring'),
(130, 98, 38, 4, 2, 7, '<div>Teaching and mentoring your employeers state-of-the-art technology-stacks, so you do not need us more. Read more...</div>\n'),
(131, 96, 39, 1, 2, 7, 'bx bx-book-content'),
(132, 97, 39, 1, 2, 7, 'Project-Management'),
(133, 98, 39, 4, 2, 7, '<div>Taking over your project-management and getting your project in short time to success. Read more...</div>\n'),
(134, 100, 100, 1, 1, 8, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2483.9092438767234!2d7.204379051520276!3d51.496532919218446!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47b8e12d41ae4be1%3A0x9e5d1399f10152c9!2sdavinci-consulting.net%20GmbH%20-%20it%20consulting!5e0!3m2!1sen!2sde!4v1677005419760!5m2!1sen!2sde'),
(135, 101, 101, 1, 1, 2, 'Unsere Vorteile'),
(136, 102, 102, 1, 1, 2, 'Diese Vorteile bieten wir Ihnen!');

-- --------------------------------------------------------

--
-- Table structure for table `parameterpanelitem`
--

CREATE TABLE `parameterpanelitem` (
  `id` int(11) NOT NULL,
  `panel_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `parameterpanelitem`
--

INSERT INTO `parameterpanelitem` (`id`, `panel_id`, `name`) VALUES
(1, 41, 'Startseite'),
(5, 42, 'Montag'),
(6, 42, 'Dienstag'),
(7, 42, 'Mittwoch'),
(8, 42, 'Donnerstag'),
(9, 42, 'Freitag'),
(10, 42, 'Samstag'),
(11, 42, 'Sonntag'),
(12, 28, 'Startseite'),
(16, 18, 'Preiswertig und Leistungsfähig'),
(17, 18, 'Probefahrt innerhalb 24 Stunden'),
(18, 18, 'Inzahlungnahme'),
(19, 18, 'Garantierte Kilometerlaufleistung'),
(20, 45, 'Beratung und Hilfe'),
(21, 45, 'Große Auswahl an Autos'),
(22, 45, 'Kundenzufriedenheit und Service'),
(23, 45, 'Zuverlässigkeit'),
(24, 41, 'Standort'),
(25, 28, 'Standort'),
(26, 41, 'Kontakt'),
(27, 41, 'Impressum'),
(28, 28, 'Kontakt'),
(32, 83, 'Test-Link Beispiel'),
(33, 41, 'Datenschutzerklärung'),
(34, 28, 'Impressum'),
(35, 28, 'DSGVO'),
(36, 99, 'Vorteil 1'),
(37, 99, 'Vorteil 2'),
(38, 99, 'Vorteil 3'),
(39, 99, 'Vorteil 4');

-- --------------------------------------------------------

--
-- Table structure for table `seiten`
--

CREATE TABLE `seiten` (
  `id` int(11) NOT NULL,
  `urls` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `names` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `headtag` int(11) NOT NULL,
  `bodytag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `seiten`
--

INSERT INTO `seiten` (`id`, `urls`, `names`, `headtag`, `bodytag`) VALUES
(1, 'startseite', 'Startseite', 1, 2),
(3, 'standort', 'Standort', 1, 8),
(4, 'kontakt', 'Kontakt', 1, 9),
(6, 'impressum', 'Impressum', 1, 11),
(7, 'dsgvo', 'Datenschutzerklärung', 1, 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boxes`
--
ALTER TABLE `boxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mvc_parameter`
--
ALTER TABLE `mvc_parameter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mvc_parameterinhalt`
--
ALTER TABLE `mvc_parameterinhalt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `panels`
--
ALTER TABLE `panels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parameter`
--
ALTER TABLE `parameter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parameterinhalt`
--
ALTER TABLE `parameterinhalt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parameterpanelitem`
--
ALTER TABLE `parameterpanelitem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seiten`
--
ALTER TABLE `seiten`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `boxes`
--
ALTER TABLE `boxes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mvc_parameter`
--
ALTER TABLE `mvc_parameter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mvc_parameterinhalt`
--
ALTER TABLE `mvc_parameterinhalt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `panels`
--
ALTER TABLE `panels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `parameter`
--
ALTER TABLE `parameter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `parameterinhalt`
--
ALTER TABLE `parameterinhalt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `parameterpanelitem`
--
ALTER TABLE `parameterpanelitem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `seiten`
--
ALTER TABLE `seiten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
