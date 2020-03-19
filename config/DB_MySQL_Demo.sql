-- MySQL dump 10.13  Distrib 8.0.18, for macos10.14 (x86_64)
--
-- Host: localhost    Database: p5zkmp_blog
-- ------------------------------------------------------
-- Server version	8.0.18

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (2,'Symfony4','symfony4'),(5,'PHP','php'),(6,'MySQL','mysql'),(7,'Backend','backend'),(8,'Frontend','frontend'),(9,'OpenClassroom','openclassroom'),(12,'DEV','dev');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `is_validated` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comment_post_idx` (`post_id`),
  KEY `fk_comment_user_idx` (`user_id`),
  CONSTRAINT `fk_comment_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  CONSTRAINT `fk_comment_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (13,33,1,'egergeregr','2020-02-25 18:04:23',1),(15,2,8,'zzefzeffez','2020-02-25 19:13:38',1),(20,2,1,'azdazdazd','2020-02-25 20:09:40',1),(21,2,1,'azdazdazd','2020-02-25 20:09:43',1),(22,2,1,'zadazazdadz','2020-02-25 20:09:46',1),(23,37,1,'Bonjour à tous !','2020-02-26 12:01:31',1),(24,37,1,'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte.','2020-02-26 12:12:43',1),(27,37,1,'Salut','2020-03-10 13:28:20',1);
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `content` longtext NOT NULL,
  `image` longtext,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_validated` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_post_user_idx` (`user_id`),
  CONSTRAINT `fk_post_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (1,1,12,'ce-que-personne-ne-te-dira-sur-le-metier-de-developpeur','Ce que personne ne te dira sur le métier de développeur','Le métier de développeur a beaucoup d’avantages. Mais crois-moi quand je te dis qu’on est loin de la promenade à Walt Disney.','Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.','3JbH3jo.jpg','2010-04-02 15:28:22','2020-02-26 10:48:04',1),(2,1,5,'conseils-pour-developpeur-junior','Conseils pour développeur junior','Les développeur(euse)s junior sont ceux qui prennent le plus cher. Et pourtant y’a des choses simples à savoir pour limité la casse.','Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.','HrWz5E2.jpg','2010-04-02 15:28:22','2020-02-26 10:49:03',1),(3,1,5,'ecris-ta-documentation-technique-bordel-de-merde','Écris ta documentation technique bordel de merde','Apparemment, tout le monde a décidé que la documentation technique c’était de la merde et que ça servait à rien. Ça me fait péter un plomb.','Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.','StdWhPN.jpg','2010-04-02 15:28:22','2020-02-26 10:50:10',1),(4,1,0,'configurer-php-pour-afficher-les-erreurs','Configurer PHP pour afficher les erreurs','Dans ce petit tutoriel, nous allons voir comment afficher les erreurs PHP afin de mieux déboguer vos scripts. En effet, par défaut, lorsqu’un script plante, PHP ne nous affiche.','Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.','code.jpg','2010-04-02 15:28:22','2010-04-02 15:28:22',1),(32,1,12,'competences-clefs-pour-developpeurs','Compétences clefs pour développeurs','Les compétences clefs pour tous développeurs ne sont pas une liste sans fin de langages et de technologies. Je vois partout ces check lists interminables.','Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.','v45Grq5.jpg','2020-02-21 14:41:35','2020-02-26 10:48:13',0),(33,1,12,'comment-devenir-developpeur-web-en-2020','Comment devenir développeur web en 2020','Comment devenir développeur web ? Si c’est une question que tu te poses, t’es au bon endroit. Oui t’es capable, il est temps d’oser et de te lancer.','Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.','DjNns1l.jpg','2020-02-21 14:43:24','2020-02-26 10:48:18',1),(34,1,12,'comment-sont-considere(e)s-les-developpeurs-en-france-?','Comment sont considéré(e)s les développeurs en France ?','Beaucoup de monde s’accorde à dire que les développeurs en France sont considérés comme des subalternes bas de gamme. Un centre de coût méprisé.','Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.','UXlWZep.jpg','2020-02-21 14:44:44','2020-02-26 10:48:22',1),(35,1,12,'l’incroyable-ego-des-developpeur(euse)s','L’incroyable ego des développeur(euse)s','L’ego des développeurs est incroyable. J’entends beaucoup parler du syndrome de l’imposteur mais le syndrome de l’énorme boulard est tout aussi présent.','Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.','s5ar6WQego-800x500.jpg','2020-02-21 14:45:57','2020-02-26 10:31:07',1),(37,1,5,'activer-l\'option-case-sensitive-sur-phpstorm','Activer l\'option case-sensitive sur PHPSTORM','Lorsque vous utilisez un système de fichier sensible avec PHPStorm, celui ci devrait vous montrer le message erreur suivant vous indiquant que le logiciel n\'est pas configurer pour gérer la casse. Filesystem Case-Sensitivity Mismatch The project seems to be located on a case-sensitive file system','Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.','5c2c95943c73d_phpstorm.jpg','2020-02-25 08:26:27','2020-02-26 10:26:04',1);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` longtext,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `disabled` tinyint(4) NOT NULL,
  `role` enum('USER','ADMINISTRATOR') NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin@admin.com','$2y$10$Zd48Y65.yhx1TGRPeNvtBuftHdLKldSJjyi8UgJDzmIlSxlY9Cavy','v45Grq5.jpg','Bastien','CLEMENT',0,'ADMINISTRATOR','2010-04-02 15:28:22'),(8,'lucie.landeaud@lechatgraphique.fr','$2y$10$IyqIbisl7RdRXIVo5hilne8gPkFIVf6aBKg4fR8y4q6YyZ6zfTYzq','code.jpg','Lucie','LANDEAUD',0,'USER','2020-02-20 15:46:08'),(9,'loic.landeaud@lechatgraphique.fr','$2y$10$/JX4mPelfBvubJ6c7/OweOrnHT74q4m4yJ9vzWix3mu7I9nr3yEAW','code.jpg','Loic','LANDEAUD',0,'USER','2020-02-20 15:46:29'),(10,'damien.michel@lechatgraphique.fr','$2y$10$XbMlY1cjVikEsnp.zEhg5Os5izmh/lcOu/LsyC6wat9MlVAoUHBqq','code.jpg','Damien','MICHEL',1,'USER','2020-02-20 15:46:56'),(11,'admin@admin.fr','$2y$10$WL794xR/hVcHgd.6DEMy8ufZZTledN8e57B/I6DhlxqMpZac3RarG','code.jpg','admin','ADMIN',1,'ADMINISTRATOR','2020-02-20 15:47:17'),(12,'f.clerc@gmail.com','$2y$10$YYTAztuPXI9AxIxOqIVZmOYjmNli71pE/DrOs1eA7pmjd5g5VS016','code.jpg','Florent','Clerc',0,'USER','2020-02-20 15:47:48'),(13,'hoo@gmail.com','$2y$10$8OW5anKoPL3rsOSKqTmZKe1u7M/wmHhh2YjpEe/eQcI/ZzKj5Tfe.','code.jpg','toto','TOTO',0,'USER','2020-02-20 23:05:59'),(14,'lola@gmail.com','$2y$10$nn09MzmlKrKZ1cp/8RGCD.4fnwq7qEjkG54DsA0X3yNKpumoKN/hS',NULL,'aaa','aaa',0,'USER','2020-02-20 23:13:12');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-03-19 10:19:59
