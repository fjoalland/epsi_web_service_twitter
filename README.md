Web Service - API Twitter (Symfony 3)
========================
Projet destiné au cours du web service a l'EPSI.

Requirements
--------------

* php
* composer -> https://getcomposer.org/

Installation
--------------
Utiliser composer pour installer toutes les dépendances dont le projet a besoin.


Configuration
--------------

###app/config/config.yml

Déjà intégrer dans la config, saisir vos clés d'accès.
```yaml
endroid_twitter:
    consumer_key: "..."
    consumer_secret: "..."
    access_token: "..."
    access_token_secret: "..."
```

###app/config/parameters.yml

```yaml
parameters:
    database_host: ...
    database_port: ...
    database_name: ...
    database_user: ...
    database_password: ...
    mailer_transport: ...
    mailer_host: ...
    mailer_user: ...
    mailer_password: ...
    secret: ...
```

###Create Database Mysql

```mysql
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tweet`
--

CREATE TABLE `tweet` (
  `idtweet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datetest` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `idTwitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `idTwitter` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `screenname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `urlphoto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tweet`
--
ALTER TABLE `tweet`
  ADD PRIMARY KEY (`idtweet`),
  ADD KEY `IDX_3D660A3B6D31044` (`idTwitter`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idTwitter`),
  ADD UNIQUE KEY `UNIQ_8D93D6496D31044` (`idTwitter`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tweet`
--
ALTER TABLE `tweet`
  ADD CONSTRAINT `FK_3D660A3B6D31044` FOREIGN KEY (`idTwitter`) REFERENCES `user` (`idTwitter`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
```

Routing
--------------

Pour accéder à l'application une fois le serveur apache lancé -> localhost/epsi_web_service_twitter/web/app_dev.php/twitterapi/