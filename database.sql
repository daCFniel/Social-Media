/*
SQLyog Community v11.01 (32 bit)
MySQL - 5.0.45-log : Database - sandbox_kriswelsh_com
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


/* Remove any (possible) pre-existing table with the same name */

DROP TABLE IF EXISTS `Messages`;

DROP TABLE IF EXISTS `User_Follows`;

DROP TABLE IF EXISTS `Users`;



/*Table structure for table `Users` */

CREATE TABLE `Users` (
  `username` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(128) default NULL,
  `avatar_url` varchar(256) default NULL,
  PRIMARY KEY  (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `Users` */

insert  into `Users`(`username`,`password`,`email`,`avatar_url`) values 
('lucas','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','lucas@unspam.us',NULL),
('hilde','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','hilde@unspam.us',NULL),
('keith','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','keith@unspam.us',NULL),
('peter','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','peter@unspam.us',NULL),
('chloe','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','chloe@unspam.us',NULL),
('tim','5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8','tim@unspam.us',NULL);




/*Table structure for table `Messages` */

CREATE TABLE `Messages` (
  `user_username` varchar(128) NOT NULL,
  `text` varchar(256) NOT NULL,
  `posted_at` datetime default NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`id`),
  KEY `userbane` (`user_username`),
  CONSTRAINT `userbane` FOREIGN KEY (`user_username`) REFERENCES `Users` (`username`) 
  ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `Messages` */

insert  into `Messages`(`user_username`,`text`,`posted_at`,`id`) values 
('peter','Lunch at the aspire? Sounds like more of a dinner thing','2019-08-14 11:56:45',1),
('chloe','What about the PI then? That\'s the 5th Oct','2020-08-14 11:57:55',2),
('lucas','I don\'t want to stay at the PI though, would just be a daytrip','2020-08-14 12:04:34',3),
('tim','Yummy yummy I want some more of that lamb we ate yesterday','2020-08-14 13:44:16',4),
('peter','I should probably post a second message, my last one is a year old now','2020-08-14 14:22:56',5),
('peter','This was posted using the web form','2020-08-14 15:51:48',6),
('peter','...and so was this new message from me!','2020-08-14 15:53:08',7),
('hilde','Guys, we\'ve lost another parcel. Hopefully the insurance will cover it','2020-08-14 16:20:42',8),
('peter','I should really try with a considerably longer message, just to see whether it displays it fully.','2020-08-14 17:14:40',9),
('chloe','I really needed to post a second message, I\'ve been too quiet.','2020-08-14 17:23:37',10);



/*Table structure for table `User_Follows` */

CREATE TABLE `User_Follows` (
  `follower_username` varchar(128) default NULL,
  `followed_username` varchar(128) default NULL,
  KEY `follower` (`follower_username`),
  KEY `followed` (`followed_username`),
  CONSTRAINT `follower` FOREIGN KEY (`follower_username`) REFERENCES `Users` (`username`) 
  ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `followed` FOREIGN KEY (`followed_username`) REFERENCES `Users` (`username`) 
  ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `User_Follows` */

insert  into `User_Follows`(`follower_username`,`followed_username`) values 
('peter','lucas'),
('peter','chloe'),
('peter','tim'),
('lucas','chloe'),
('lucas','peter'),
('chloe','lucas'),
('chloe','peter'),
('chloe','keith'),
('chloe','hilde'),
('hilde','chloe'),
('hilde','keith'),
('keith','chloe'),
('keith','hilde'),
('tim','peter');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
