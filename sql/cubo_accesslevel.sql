
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `accesslevel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accesslevel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(99) DEFAULT NULL,
  `access` int(11) DEFAULT NULL,
  `author` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `description` text,
  `editor` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `published` datetime DEFAULT NULL,
  `publisher` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `title` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `accesslevel` WRITE;
/*!40000 ALTER TABLE `accesslevel` DISABLE KEYS */;
INSERT INTO `accesslevel` VALUES (0,'none',0,1,'1968-12-10 00:00:00','No one can access, not even administrators',NULL,NULL,NULL,NULL,1,'No access'),
                                 (1,'public',1,1,'1968-12-10 00:00:00','Everyone can access',NULL,NULL,NULL,NULL,1,'Public'),
								 (2,'registered',1,1,'1968-12-10 00:00:00','Only users who have logged in can access',NULL,NULL,NULL,NULL,1,'Registered'),
								 (3,'guest',1,1,'1968-12-10 00:00:00','Only users who have not logged in can access',NULL,NULL,NULL,NULL,1,'Guest'),
								 (4,'private',1,1,'1968-12-10 00:00:00','Only users who know how to reach the item can access it',NULL,NULL,NULL,NULL,1,'Private');
/*!40000 ALTER TABLE `accesslevel` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

