
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
DROP TABLE IF EXISTS `publishingstatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publishingstatus` (
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `publishingstatus` WRITE;
/*!40000 ALTER TABLE `publishingstatus` DISABLE KEYS */;
INSERT INTO `publishingstatus` VALUES (1,'published',1,1,'1968-12-10 00:00:00','The item is visible to everyone',NULL,NULL,NULL,NULL,1,'Published'),
                                      (2,'unpublished',1,1,'1968-12-10 00:00:00','The item is not yet visible to everyone',NULL,NULL,NULL,NULL,1,'Unpublished'),
									  (3,'trashed',1,1,'1968-12-10 00:00:00','The item has been trashed and is not visible',NULL,NULL,NULL,NULL,1,'Trashed');
/*!40000 ALTER TABLE `publishingstatus` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

