-- MySQL dump 10.13  Distrib 8.0.21, for Linux (x86_64)
--
-- Host: localhost    Database: stock
-- ------------------------------------------------------
-- Server version	8.0.21-0ubuntu0.20.04.4

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `admin_menu`
--

LOCK TABLES `admin_menu` WRITE;
/*!40000 ALTER TABLE `admin_menu` DISABLE KEYS */;
INSERT INTO `admin_menu` VALUES (1,0,1,'首頁','fa-bar-chart','/',NULL,NULL,'2020-12-28 03:22:16'),(2,0,10,'後台系統管理','fa-tasks',NULL,NULL,NULL,'2021-01-12 15:26:40'),(3,2,11,'後台成員','fa-users','auth/users',NULL,NULL,'2021-01-12 15:26:40'),(4,2,12,'後台角色','fa-user','auth/roles',NULL,NULL,'2021-01-12 15:26:40'),(5,2,13,'後台權限','fa-ban','auth/permissions',NULL,NULL,'2021-01-12 15:26:40'),(6,2,14,'後台選單','fa-bars','auth/menu',NULL,NULL,'2021-01-12 15:26:40'),(7,2,15,'後台操作記錄','fa-history','auth/logs',NULL,NULL,'2021-01-12 15:26:40'),(8,0,2,'會員管理','fa-users','/users',NULL,'2020-12-28 03:25:18','2020-12-28 03:25:23'),(9,0,3,'商品管理','fa-cubes','/products',NULL,'2020-12-28 03:29:43','2020-12-28 03:29:50'),(10,0,4,'訂單管理','fa-th-list','/orders',NULL,'2021-01-07 14:44:09','2021-01-12 14:14:46'),(11,0,8,'影片管理','fa-file-video-o','/videos',NULL,'2021-01-12 10:58:47','2021-01-12 15:23:38'),(12,0,9,'標籤管理','fa-tags','/tags',NULL,'2021-01-12 11:00:41','2021-01-12 15:26:40'),(13,0,7,'影片分類管理','fa-film','/video_categories',NULL,'2021-01-12 13:49:08','2021-01-12 15:23:38'),(14,0,5,'文章分類管理','fa-file-word-o','/topic_categories',NULL,'2021-01-12 13:57:11','2021-01-12 13:57:20'),(15,0,6,'文章管理','fa-file-text-o','/topics',NULL,'2021-01-12 14:13:15','2021-01-12 14:14:52');
/*!40000 ALTER TABLE `admin_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_permissions`
--

LOCK TABLES `admin_permissions` WRITE;
/*!40000 ALTER TABLE `admin_permissions` DISABLE KEYS */;
INSERT INTO `admin_permissions` VALUES (1,'All permission','*','','*',NULL,NULL),(2,'Dashboard','dashboard','GET','/',NULL,NULL),(3,'Login','auth.login','','/auth/login\r\n/auth/logout',NULL,NULL),(4,'User setting','auth.setting','GET,PUT','/auth/setting',NULL,NULL),(5,'Auth management','auth.management','','/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs',NULL,NULL),(6,'會員管理','users','','/users*','2020-12-28 03:27:36','2020-12-28 03:27:36');
/*!40000 ALTER TABLE `admin_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_role_menu`
--

LOCK TABLES `admin_role_menu` WRITE;
/*!40000 ALTER TABLE `admin_role_menu` DISABLE KEYS */;
INSERT INTO `admin_role_menu` VALUES (1,2,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_role_permissions`
--

LOCK TABLES `admin_role_permissions` WRITE;
/*!40000 ALTER TABLE `admin_role_permissions` DISABLE KEYS */;
INSERT INTO `admin_role_permissions` VALUES (1,1,NULL,NULL),(2,2,NULL,NULL),(2,3,NULL,NULL),(2,4,NULL,NULL),(2,6,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_role_users`
--

LOCK TABLES `admin_role_users` WRITE;
/*!40000 ALTER TABLE `admin_role_users` DISABLE KEYS */;
INSERT INTO `admin_role_users` VALUES (1,1,NULL,NULL),(2,2,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_roles`
--

LOCK TABLES `admin_roles` WRITE;
/*!40000 ALTER TABLE `admin_roles` DISABLE KEYS */;
INSERT INTO `admin_roles` VALUES (1,'Administrator','administrator','2020-12-28 03:19:41','2020-12-28 03:19:41'),(2,'營運','operation','2020-12-28 03:28:14','2020-12-28 03:28:14');
/*!40000 ALTER TABLE `admin_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_user_permissions`
--

LOCK TABLES `admin_user_permissions` WRITE;
/*!40000 ALTER TABLE `admin_user_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_user_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `admin_users`
--

LOCK TABLES `admin_users` WRITE;
/*!40000 ALTER TABLE `admin_users` DISABLE KEYS */;
INSERT INTO `admin_users` VALUES (1,'admin','$2y$10$2Z4pATWBxkC5sazL9MnvdO9WgJplRc4V9Du7ikBMPg8Kbj.UPRhFS','Administrator',NULL,'SlYEVA5WlMOePZCeXWQ0p59ZtVIKUWUkBinCBrjq7ULrtpFK2RHsTyk5AKoD','2020-12-28 03:19:41','2020-12-28 03:19:41'),(2,'operator','$2y$10$cECQk3xeY74JgkVvGngG7e0PnTHDLOAANZj5u5DCWJXEedCPT.uY.','營運',NULL,NULL,'2020-12-28 03:29:02','2020-12-28 03:29:02');
/*!40000 ALTER TABLE `admin_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-01-14  0:50:44
