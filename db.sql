/*
SQLyog Ultimate v11.12 (64 bit)
MySQL - 5.5.45 : Database - testdb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`testdb` /*!40100 DEFAULT CHARACTER SET euckr */;

USE `testdb`;

/*Table structure for table `tb_category` */

DROP TABLE IF EXISTS `tb_category`;

CREATE TABLE `tb_category` (
  `category_no` int(11) NOT NULL DEFAULT '0',
  `category_title` varchar(30) NOT NULL,
  PRIMARY KEY (`category_no`)
) ENGINE=InnoDB DEFAULT CHARSET=euckr COMMENT='카테고리';

/*Data for the table `tb_category` */

insert  into `tb_category`(`category_no`,`category_title`) values (0,'일반직무'),(1,'산업직무'),(2,'공통역량'),(3,'어학 및 자격증');

/*Table structure for table `tb_file` */

DROP TABLE IF EXISTS `tb_file`;

CREATE TABLE `tb_file` (
  `file_no` int(6) NOT NULL AUTO_INCREMENT COMMENT '첨부파일관리번호',
  `file_name` varchar(100) DEFAULT NULL COMMENT '파일명',
  `file_ori_name` varchar(100) DEFAULT NULL COMMENT '서버파일명',
  `file_type` char(5) DEFAULT NULL COMMENT '파일확장자',
  `file_path` varchar(100) DEFAULT NULL COMMENT '파일패스',
  `reg_date` date DEFAULT NULL COMMENT '등록일',
  `id` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`file_no`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=euckr;

/*Data for the table `tb_file` */

insert  into `tb_file`(`file_no`,`file_name`,`file_ori_name`,`file_type`,`file_path`,`reg_date`,`id`) values (1,'1540858574.jpg','9.jpg','jpg','../upload/file/1540858574.jpg','2018-10-30','test'),(2,'1540858602.jpg','7.jpg','jpg','../upload/file/1540858602.jpg','2018-10-30','test'),(3,'1540858638.jpg','10.jpg','jpg','../upload/file/1540858638.jpg','2018-10-30','test'),(4,'1540861994.JPG','11.JPG','JPG','../upload/file/1540861994.JPG','2018-10-30','test'),(5,'1540861962.JPG','4.JPG','JPG','../upload/file/1540861962.JPG','2018-10-30','test'),(6,'1540858720.jpg','1.jpg','jpg','../upload/file/1540858720.jpg','2018-10-30','test'),(7,'1540858751.jpg','12.jpg','jpg','../upload/file/1540858751.jpg','2018-10-30','test'),(8,'1540858784.jpg','5.jpg','jpg','../upload/file/1540858784.jpg','2018-10-30','test'),(9,'1540858813.jpg','13.jpg','jpg','../upload/file/1540858813.jpg','2018-10-30','test');

/*Table structure for table `tb_lecture` */

DROP TABLE IF EXISTS `tb_lecture`;

CREATE TABLE `tb_lecture` (
  `lecture_no` int(11) NOT NULL AUTO_INCREMENT,
  `category_no` int(11) DEFAULT NULL COMMENT '분류명',
  `lecture_title` varchar(100) DEFAULT NULL COMMENT '강의명',
  `time` int(11) DEFAULT NULL COMMENT '교육시간',
  `lecture_level` char(1) DEFAULT NULL COMMENT '학습난이도',
  `file_no` int(6) DEFAULT NULL COMMENT '강의썸네일',
  `teacher` varchar(15) DEFAULT NULL,
  `id` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`lecture_no`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=euckr;

/*Data for the table `tb_lecture` */

insert  into `tb_lecture`(`lecture_no`,`category_no`,`lecture_title`,`time`,`lecture_level`,`file_no`,`teacher`,`id`) values (1,0,'S.M.A.R.T 프레젠테이션, 단번에 청중을 사로잡는 설득의 노하우',18,'하',1,'김기동','test'),(2,0,'100년 기업의 변화경영',19,'하',2,'윤정구','test'),(3,0,'[회계ⓔ코칭]쉽게 따라하는 재무회계',17,'하',3,'이병권','test'),(4,3,'해커스 Talk! 호텔 영어',20,'하',4,'로즈리','test'),(5,3,'해커스 Talk! 호텔 중국어',21,'하',5,'찐','test'),(6,2,'스마트 팀장의 리더십 매뉴얼 15가지',16,'중',6,'정진호','test'),(7,2,'박재희 교수의 동양철학과 창의역량',16,'중',7,'박재희','test'),(8,1,'Smart 금융소비자보호, 고객 신뢰를 디자인하라!',18,'하',8,'조남희','test'),(9,1,'ACE 핵심만 콕 찍어주는 무역실무',20,'하',9,'김덕권','test');

/*Table structure for table `tb_review` */

DROP TABLE IF EXISTS `tb_review`;

CREATE TABLE `tb_review` (
  `board_no` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(25) DEFAULT NULL,
  `title` varchar(100) NOT NULL COMMENT '리뷰제목',
  `contents` text NOT NULL COMMENT '내용',
  `cnt` int(10) NOT NULL COMMENT '조회수',
  `category_no` int(11) NOT NULL COMMENT '카테고리 연결번호',
  `reg_date` datetime NOT NULL COMMENT '등록일',
  `lecture_no` int(11) NOT NULL,
  `satisfy` int(11) DEFAULT NULL,
  PRIMARY KEY (`board_no`),
  KEY `FK_tb_review_category_no_tb_category_category_no` (`category_no`),
  CONSTRAINT `FK_tb_review_category_no_tb_category_category_no` FOREIGN KEY (`category_no`) REFERENCES `tb_category` (`category_no`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=euckr COMMENT='수강후기';

/*Data for the table `tb_review` */

insert  into `tb_review`(`board_no`,`user_id`,`title`,`contents`,`cnt`,`category_no`,`reg_date`,`lecture_no`,`satisfy`) values (1,'test','토익준비 열심히!!','토익준비를 해야돼&nbsp;',16,2,'2018-10-30 09:40:44',6,1),(2,'test','토익준비','<b><span style=\"font-size: 24pt;\">지웠다..&nbsp;</span><br style=\"clear:both;\"><span style=\"font-size: 24pt;\">다시넣었다.&nbsp;<img src=\"/upload/temp/15408601121540860112811__6.jpg\" title=\"15408601121540860112811__6.jpg\"><br style=\"clear:both;\"></span></b>',14,3,'2018-10-30 09:47:57',4,1),(3,'test','재밌다~','<img src=\"/upload/temp/15408597661540859766906__13.jpg\" title=\"15408597661540859766906__13.jpg\"><br style=\"clear:both;\"><img src=\"/upload/temp/15408597661540859766909__12.jpg\" title=\"15408597661540859766909__12.jpg\"><br style=\"clear:both;\"><br>',2,3,'2018-10-30 09:36:09',4,5),(4,'test','리더십을 준비중 ','ㅇㅇ<img src=\"/upload/temp/15408601451540860145638__10.jpg\" title=\"15408601451540860145638__10.jpg\"><br style=\"clear:both;\">',4,2,'2018-10-30 09:42:27',6,5),(5,'test4','설득하자 ','<img src=\"/upload/temp/15408628771540862877269__Hydrangeas.jpg\" title=\"15408628771540862877269__Hydrangeas.jpg\"><br style=\"clear:both;\"><br>',3,0,'2018-10-30 10:27:59',1,4),(6,'test4','영어가 늘었어요~','<img src=\"/upload/temp/15408632031540863203356__11.JPG\" title=\"15408632031540863203356__11.JPG\"><br style=\"clear:both;\"><img src=\"/upload/temp/15408632031540863203354__12.jpg\" title=\"15408632031540863203354__12.jpg\"><br style=\"clear:both;\"><br>',3,3,'2018-10-30 10:33:24',4,5),(7,'test4','재밌다.','ㅎㅎ',2,1,'2018-10-30 10:34:28',8,5),(8,'test4','','ㅌㅌ',0,0,'2018-10-30 10:35:05',0,5),(9,'test4','','<br>',0,0,'2018-10-30 10:43:08',0,5),(10,'test4','','<br>',0,0,'2018-10-30 10:43:44',0,5),(11,'test4','','<br>',0,0,'2018-10-30 10:45:05',0,5),(12,'test4','프레젠테이션 ','재미있게 준비중&nbsp;',36,0,'2018-10-30 10:45:41',1,5),(13,'test4','무역실무 ','<img src=\"/upload/temp/15408672711540867271374__7.jpg\" title=\"15408672711540867271374__7.jpg\"><br style=\"clear:both;\"><br>',1,1,'2018-10-30 11:41:13',9,3),(14,'test1','설득의노하우 ','좋았따.,ㅇㅇㅇㅇ',2,0,'2018-11-01 18:09:48',1,1),(16,'test01','좋아요!','<img src=\"/upload/temp/15411222091541122209115__Jellyfish.jpg\" title=\"15411222091541122209115__Jellyfish.jpg\"><br style=\"clear:both;\"><br>',2,2,'2018-11-02 10:30:11',6,2);

/*Table structure for table `tb_review_file` */

DROP TABLE IF EXISTS `tb_review_file`;

CREATE TABLE `tb_review_file` (
  `file_no` int(11) NOT NULL AUTO_INCREMENT,
  `sys_name` varchar(100) DEFAULT NULL,
  `file_type` char(5) NOT NULL COMMENT '파일확장자',
  `file_path` varchar(100) NOT NULL COMMENT '파일패스',
  `board_no` int(10) NOT NULL COMMENT '글번호',
  `ori_name` varchar(100) NOT NULL COMMENT '원본파일명',
  `file_size` int(10) NOT NULL COMMENT '파일사이즈',
  `file_group_no` int(11) NOT NULL COMMENT '첨부파일그룹번호',
  PRIMARY KEY (`file_no`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=euckr COMMENT='수강후기 첨부파일';

/*Data for the table `tb_review_file` */

insert  into `tb_review_file`(`file_no`,`sys_name`,`file_type`,`file_path`,`board_no`,`ori_name`,`file_size`,`file_group_no`) values (1,'15408597491540859749713__9.jpg','jpg','/upload/temp/15408597491540859749713__9.jpg',2,'9.jpg',228,0),(2,'15408597661540859766906__13.jpg','jpg','/upload/temp/15408597661540859766906__13.jpg',3,'13.jpg',83,0),(3,'15408597661540859766909__12.jpg','jpg','/upload/temp/15408597661540859766909__12.jpg',3,'12.jpg',273,0),(4,'15408601451540860145638__10.jpg','jpg','/upload/temp/15408601451540860145638__10.jpg',4,'10.jpg',166,0),(5,'15408628771540862877269__Hydrangeas.jpg','jpg','/upload/temp/15408628771540862877269__Hydrangeas.jpg',5,'Hydrangeas.jpg',582,0),(6,'15408632031540863203356__11.JPG','JPG','/upload/temp/15408632031540863203356__11.JPG',6,'11.JPG',115,0),(7,'15408632031540863203354__12.jpg','jpg','/upload/temp/15408632031540863203354__12.jpg',6,'12.jpg',273,0),(8,'15408672711540867271374__7.jpg','jpg','/upload/temp/15408672711540867271374__7.jpg',13,'7.jpg',200,0),(9,'15411222091541122209115__Jellyfish.jpg','jpg','/upload/temp/15411222091541122209115__Jellyfish.jpg',16,'Jellyfish.jpg',758,0);

/*Table structure for table `tb_review_file_group` */

DROP TABLE IF EXISTS `tb_review_file_group`;

CREATE TABLE `tb_review_file_group` (
  `file_group_no` int(11) NOT NULL AUTO_INCREMENT,
  `file_no` int(6) DEFAULT NULL COMMENT '파일번호',
  PRIMARY KEY (`file_group_no`)
) ENGINE=InnoDB DEFAULT CHARSET=euckr COMMENT='수강후기 첨부파일 그룹';

/*Data for the table `tb_review_file_group` */

/*Table structure for table `tb_satisfy` */

DROP TABLE IF EXISTS `tb_satisfy`;

CREATE TABLE `tb_satisfy` (
  `satisfy_no` int(11) NOT NULL DEFAULT '0',
  `satisfy_title` varchar(30) NOT NULL,
  PRIMARY KEY (`satisfy_no`)
) ENGINE=InnoDB DEFAULT CHARSET=euckr;

/*Data for the table `tb_satisfy` */

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(25) NOT NULL,
  `name` varchar(15) NOT NULL,
  `pw` varchar(25) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` char(12) DEFAULT NULL,
  `tel` varchar(14) DEFAULT NULL,
  `post` char(6) NOT NULL,
  `addr` varchar(40) NOT NULL,
  `receive_mail` char(1) NOT NULL DEFAULT 'Y',
  `receive_sms` char(1) NOT NULL DEFAULT 'Y',
  `detail_addr` varchar(20) NOT NULL,
  `user_gb` varchar(5) NOT NULL DEFAULT 'user',
  `lecture_no` int(11) DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

/*Data for the table `tb_user` */

insert  into `tb_user`(`no`,`id`,`name`,`pw`,`email`,`phone`,`tel`,`post`,`addr`,`receive_mail`,`receive_sms`,`detail_addr`,`user_gb`,`lecture_no`) values (3,'egoing','홍길동','6fec2a9601d5b3581c94f2150','dfsfsdf@naver.com','1234',NULL,'05263','서울 강동구 암사길 11234','Y','Y','','user',NULL),(4,'test','홍길동','6fec2a9601d5b3581c94f2150','test2@naver.com','01023456789','','05525','서울 송파구 풍성로 42233','N','Y','','admin',NULL),(12,'test3','김구','9f86d081884c7d659a2feaa0c','dfsfsdf@sfddsfsf','01044445555','2221111111','42957','대구 달성군 화원읍 류목정길 5333','N','Y','','user',NULL),(17,'asd','홍길동','9f86d081884c7d659a2feaa0c','dfsfsdf@hanmail.net','01012341111',NULL,'06313','서울 강남구 양재대로 333','N','Y','23123','user',NULL),(18,'test1','김기동','6fec2a9601d5b3581c94f2150','test@naver.com','01033333333',NULL,'06267','서울 강남구 강남대로 238','N','N','스카이쏠라빌딩','user',NULL),(20,'test2','김숙','9f86d081884c7d659a2feaa0c','et@naver.com','01011111313','0','61763','광주 남구 판촌길 23-4','N','N','1층','user',NULL),(22,'test4','김태리','9f86d081884c7d659a2feaa0c','test2@gmail.com','01022221111','024500000','13480','경기 성남시 분당구 대왕판교로 477','N','Y','낙생고등학교','user',NULL),(23,'asdfd','김숙','9f86d081884c7d659a2feaa0c','test2@hanmail.net','01022221111','0300000000','08848','서울 관악구 광신길 86','N','N','신림2단지주공아파트','user',NULL),(25,'test5','이준','9f86d081884c7d659a2feaa0c','test@gmail.com','01012345678','024560000','04973','서울 광진구 강변북로 423','Y','N','한국재난구조단','user',NULL),(27,'test10','박병은','9f86d081884c7d659a2feaa0c','test@hanmail.net','01012345678','0224501111','13485','경기 성남시 분당구 판교로 20','N','Y','판교원마을3단지아파트','user',NULL),(29,'test20','김태리','9f86d081884c7d659a2feaa0c','test@hanmail.net','01012341111','034-4042-0','06267','서울 강남구 강남대로 238','N','Y','스카이쏠라빌딩','user',NULL),(31,'test01','조승우','9f86d081884c7d659a2feaa0c','test2@hanmail.net','01011115678','02-4504-0444','61763','광주 남구 판촌길 23-3','N','Y','23-1','user',NULL),(32,'test02','김상','8fa675cc452a44a9ca2816714','test33@hanmail.net','01012341111','--','05208','서울 강동구 풍산로 235','N','Y','강일어린이집','user',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
