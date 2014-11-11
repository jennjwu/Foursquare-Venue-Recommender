SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `FS_Recommender` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `FS_Recommender` ;

-- -----------------------------------------------------
-- Table `FS_Recommender`.`Venue`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `FS_Recommender`.`Venue` ;

CREATE TABLE `Venue` (
  `Venue_ID` int(11) NOT NULL,
  `FS_ID` varchar(45) NOT NULL,
  `Name` varchar(45) NOT NULL,
  `Address` varchar(45) DEFAULT NULL,
  `ZipCode` int(11) DEFAULT NULL,
  `Latitude` varchar(45) NOT NULL,
  `Longitude` varchar(45) NOT NULL,
  `PhoneNumber` varchar(45) DEFAULT NULL,
  `Venue_Type` varchar(45) DEFAULT NULL COMMENT '{cafe, coffee shop, bakery, bar, restaurant, club, hotel, meeting}',
  `CheckIns` int(11) DEFAULT NULL,
  `Likes` int(11) DEFAULT NULL,
  `Rating` float DEFAULT NULL,
  `Price` varchar(5) DEFAULT NULL COMMENT '{$, $$, $$$, $$$$}',
  `Website` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`Venue_ID`)
) ENGINE=InnoDB;

-- -----------------------------------------------------
-- Table `FS_Recommender`.`User`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `FS_Recommender`.`User` ;

CREATE TABLE IF NOT EXISTS `FS_Recommender`.`User` (
  `User_ID` INT NOT NULL,
  `Name` VARCHAR(45) NOT NULL,
  `ZipCode` INT NULL,
  PRIMARY KEY (`User_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `FS_Recommender`.`Category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `FS_Recommender`.`Category` ;

CREATE TABLE IF NOT EXISTS `FS_Recommender`.`Category` (
  `Category_ID` INT NOT NULL,
  `Criteria` VARCHAR(45) NULL,
  `Description` VARCHAR(45) NULL,
  PRIMARY KEY (`Category_ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `FS_Recommender`.`Venue_Category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `FS_Recommender`.`Venue_Category` ;

CREATE TABLE IF NOT EXISTS `FS_Recommender`.`Venue_Category` (
  `Venue_ID` INT NOT NULL,
  `Category_ID` INT NOT NULL,
  PRIMARY KEY (`Venue_ID`, `Category_ID`),
  INDEX `fk_Venue_Category_Venue1_idx` (`Venue_ID` ASC),
  INDEX `fk_Venue_Category_Category1_idx` (`Category_ID` ASC),
  CONSTRAINT `fk_Venue_Category_Venue1`
    FOREIGN KEY (`Venue_ID`)
    REFERENCES `FS_Recommender`.`Venue` (`Venue_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Venue_Category_Category1`
    FOREIGN KEY (`Category_ID`)
    REFERENCES `FS_Recommender`.`Category` (`Category_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `FS_Recommender`.`Amenities`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `FS_Recommender`.`Amenities` ;

CREATE TABLE `Amenities` (
  `Venue_ID` int(11) NOT NULL,
  `Reservations` varchar(1) DEFAULT NULL,
  `Credit_Cards` varchar(1) DEFAULT NULL,
  `Outdoor_Seating` varchar(1) DEFAULT NULL,
  `Alcohol` varchar(1) DEFAULT NULL,
  `Wifi` varchar(1) DEFAULT NULL,
  `Menus` varchar(45) DEFAULT NULL,
  `Events_Count` int(11) DEFAULT NULL,
  PRIMARY KEY (`Venue_ID`),
  CONSTRAINT `fk_Amenities_Venue1` FOREIGN KEY (`Venue_ID`) REFERENCES `Venue` (`Venue_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB;


-- -----------------------------------------------------
-- Table `FS_Recommender`.`User_Favs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `FS_Recommender`.`User_Favs` ;

CREATE TABLE IF NOT EXISTS `FS_Recommender`.`User_Favs` (
  `User_ID` INT NOT NULL,
  `Venue_ID` INT NOT NULL,
  `Date_Visiting` DATE NULL,
  INDEX `fk_User_Favs_User1_idx` (`User_ID` ASC),
  INDEX `fk_User_Favs_Venue1_idx` (`Venue_ID` ASC),
  PRIMARY KEY (`User_ID`, `Venue_ID`),
  CONSTRAINT `fk_User_Favs_User1`
    FOREIGN KEY (`User_ID`)
    REFERENCES `FS_Recommender`.`User` (`User_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_User_Favs_Venue1`
    FOREIGN KEY (`Venue_ID`)
    REFERENCES `FS_Recommender`.`Venue` (`Venue_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `FS_Recommender`.`Accounts`
-- -----------------------------------------------------
/*For user login authentication*/
DROP TABLE IF EXISTS `FS_Recommender`.`Accounts` ;

CREATE TABLE `Accounts` (
  `login_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(45) NOT NULL,
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`login_id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=utf8;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;



/*Inserts*/
INSERT INTO `User` (`User_ID`, `Name`, `ZipCode`) VALUES ('1001', 'Jenn', '95192');
INSERT INTO `User` (`User_ID`, `Name`, `ZipCode`) VALUES ('1002', 'Xiaoli', '95192');
INSERT INTO `User` (`User_ID`,`Name`,`ZipCode`) VALUES (1003,'Bob',95113);


INSERT INTO `Category` (`Category_ID`,`Criteria`,`Description`) VALUES (1,'Popular','rating > 7 and likes > 50');
INSERT INTO `Category` (`Category_ID`,`Criteria`,`Description`) VALUES (2,'Special Event','reservations = \'Y\' and events_count = 0');
INSERT INTO `Category` (`Category_ID`,`Criteria`,`Description`) VALUES (3,'Mingle','alcohol=\'Y\' or menus like \'%Happy Hour%\' or Venue_type like \'%Bar%\'');
INSERT INTO `Category` (`Category_ID`,`Criteria`,`Description`) VALUES (4,'Economical','price=\'$\'');
INSERT INTO `Category` (`Category_ID`,`Criteria`,`Description`) VALUES (5,'Study','(venue_type like \'%Coffee%\' or venue_type like \'%Cafe%\') and wifi = \'Y\'');
INSERT INTO `Category` (`Category_ID`,`Criteria`,`Description`) VALUES (6,'Large Group','reservations = \'Y\' or venue_type like \'%Restaurant%\'');
INSERT INTO `Category` (`Category_ID`,`Criteria`,`Description`) VALUES (7,'Surprise Me','5 random venues');


INSERT INTO `Venue` (`Venue_ID`,`FS_ID`,`Name`,`Address`,`ZipCode`,`Latitude`,`Longitude`,`PhoneNumber`,`Venue_Type`,`CheckIns`,`Likes`,`Rating`,`Price`,`Website`) VALUES (9001,'50d13d8de4b0dda2f3343f74','Vyne Bistro','110 Paseo de San Antonio',95125,'37.301273808095225','-121.88433051109313',NULL,'Wine Bar',415,16,7.3,'$$',NULL);
INSERT INTO `Venue` (`Venue_ID`,`FS_ID`,`Name`,`Address`,`ZipCode`,`Latitude`,`Longitude`,`PhoneNumber`,`Venue_Type`,`CheckIns`,`Likes`,`Rating`,`Price`,`Website`) VALUES (9002,'51d3860f498ec834e85ea625','San Pedro Square Market Bar',NULL,NULL,'37.33649','-121.894275',NULL,'Bar',734,14,7.4,'$$',NULL);
INSERT INTO `Venue` (`Venue_ID`,`FS_ID`,`Name`,`Address`,`ZipCode`,`Latitude`,`Longitude`,`PhoneNumber`,`Venue_Type`,`CheckIns`,`Likes`,`Rating`,`Price`,`Website`) VALUES (9003,'51525423e4b00706114833dc','The Blackbird Tavern','200 S 1st St',95113,'37.33299422537002','-121.88797645983344','(408) 286-1313','Pub',985,41,7.1,'$$','http://www.theblackbirdtavern.com');
INSERT INTO `Venue` (`Venue_ID`,`FS_ID`,`Name`,`Address`,`ZipCode`,`Latitude`,`Longitude`,`PhoneNumber`,`Venue_Type`,`CheckIns`,`Likes`,`Rating`,`Price`,`Website`) VALUES (9004,'4ac65788f964a520dab320e3','Cafe Pomegranate','221 E San Fernando St',95112,'37.3366418112803','-121.88469166416216','(408) 271-8822','Cafe',400,7,7.9,'$','http://cafepomegranate.com');
INSERT INTO `Venue` (`Venue_ID`,`FS_ID`,`Name`,`Address`,`ZipCode`,`Latitude`,`Longitude`,`PhoneNumber`,`Venue_Type`,`CheckIns`,`Likes`,`Rating`,`Price`,`Website`) VALUES (9005,'50f71858e4b0a61af5c67758','Amor Cafe & Tea','110 San Fernando St',95113,'37.335550368324114','-121.88659252228861',NULL,'Cafe',690,13,6.4,'$',NULL);
INSERT INTO `Venue` (`Venue_ID`,`FS_ID`,`Name`,`Address`,`ZipCode`,`Latitude`,`Longitude`,`PhoneNumber`,`Venue_Type`,`CheckIns`,`Likes`,`Rating`,`Price`,`Website`) VALUES (9006,'4e1defb76284d5831b3f82e0','Crema Coffee Roasting Company','50 W San Fernando St',95113,'37.33307464105361','-121.8889331817627',NULL,'Coffee Shop',421,8,6.9,'$',NULL);
INSERT INTO `Venue` (`Venue_ID`,`FS_ID`,`Name`,`Address`,`ZipCode`,`Latitude`,`Longitude`,`PhoneNumber`,`Venue_Type`,`CheckIns`,`Likes`,`Rating`,`Price`,`Website`) VALUES (9007,'4e750a41483b0cf5ec930841','B2 Coffee','87 N San Pedro St',95110,'37.33670272501864','-121.89444572110283','(408) 244-2457','Coffee Shop',4564,99,9.4,'$','http://bellanocoffee.com');
INSERT INTO `Venue` (`Venue_ID`,`FS_ID`,`Name`,`Address`,`ZipCode`,`Latitude`,`Longitude`,`PhoneNumber`,`Venue_Type`,`CheckIns`,`Likes`,`Rating`,`Price`,`Website`) VALUES (9008,'4a55473ef964a520fcb31fe3','Philz Coffee','118 Paseo de San Antonio',95112,'37.33373725744867','-121.88510852181264','(408) 971-4212','Coffee Shop',16725,231,9.2,'$','http://www.philzcoffee.com');
INSERT INTO `Venue` (`Venue_ID`,`FS_ID`,`Name`,`Address`,`ZipCode`,`Latitude`,`Longitude`,`PhoneNumber`,`Venue_Type`,`CheckIns`,`Likes`,`Rating`,`Price`,`Website`) VALUES (9009,'40c3b000f964a520e3001fe3','La Victoria Taqueria','140 E San Carlos St',95112,'37.332663708429294','-121.88436929316791','(408) 298-5335','Restaurant',10815,136,8.7,'$','http://lavicsj.com');
INSERT INTO `Venue` (`Venue_ID`,`FS_ID`,`Name`,`Address`,`ZipCode`,`Latitude`,`Longitude`,`PhoneNumber`,`Venue_Type`,`CheckIns`,`Likes`,`Rating`,`Price`,`Website`) VALUES (9010,'512ab7f619a9da9433ee0fd3','Cafe Stritch','374 S 1st St',95113,'37.33054096556296','-121.88618659973143','(408) 280-6161','Bar, Cafe',2080,72,8.5,'$$',NULL);
INSERT INTO `Venue` (`Venue_ID`,`FS_ID`,`Name`,`Address`,`ZipCode`,`Latitude`,`Longitude`,`PhoneNumber`,`Venue_Type`,`CheckIns`,`Likes`,`Rating`,`Price`,`Website`) VALUES (9011,'464ee7fef964a520c0461fe3','Pita Pit','151 S 2nd St',95113,'37.334121','-121.887392','(408) 694-3200','Restaurant',2094,24,8.6,'$',NULL);
INSERT INTO `Venue` (`Venue_ID`,`FS_ID`,`Name`,`Address`,`ZipCode`,`Latitude`,`Longitude`,`PhoneNumber`,`Venue_Type`,`CheckIns`,`Likes`,`Rating`,`Price`,`Website`) VALUES (9012,'4a52ba72f964a520f4b11fe3','Gombei Japanese Restaurant','193 Jackson St',95112,'37.348895','-121.89478328333334','(408) 279-4311','Restaurant',1951,36,9,'$','http://gombei.com');
INSERT INTO `Venue` (`Venue_ID`,`FS_ID`,`Name`,`Address`,`ZipCode`,`Latitude`,`Longitude`,`PhoneNumber`,`Venue_Type`,`CheckIns`,`Likes`,`Rating`,`Price`,`Website`) VALUES (9013,'40c3b000f964a520e2001fe3','Iguanas Taqueria','330 S 3rd St',95118,'37.332170605659485','-121.88458800315857','(408) 995-6023','Restaurant',6509,67,8.5,'$',NULL);
INSERT INTO `Venue` (`Venue_ID`,`FS_ID`,`Name`,`Address`,`ZipCode`,`Latitude`,`Longitude`,`PhoneNumber`,`Venue_Type`,`CheckIns`,`Likes`,`Rating`,`Price`,`Website`) VALUES (9014,'4bae7821f964a52050b63be3','Quickly','140 Paseo de San Antonio',95112,'37.33382107797452','-121.88485085964203','(408) 292-6160','Cafe',3166,18,6.8,'$','http://quicklyusa.com');
INSERT INTO `Venue` (`Venue_ID`,`FS_ID`,`Name`,`Address`,`ZipCode`,`Latitude`,`Longitude`,`PhoneNumber`,`Venue_Type`,`CheckIns`,`Likes`,`Rating`,`Price`,`Website`) VALUES (9015,'4a584ec8f964a52083b71fe3','Angelou\'s Cafe & Grill','21 N 2nd St',95113,'37.337037','-121.88987883','(408) 971-2287','Restaurant',908,19,8.1,'$','http://www.angelousmexicangrill.com');
INSERT INTO `Venue` (`Venue_ID`,`FS_ID`,`Name`,`Address`,`ZipCode`,`Latitude`,`Longitude`,`PhoneNumber`,`Venue_Type`,`CheckIns`,`Likes`,`Rating`,`Price`,`Website`) VALUES (9016,'4be5fdd3d4f7c9b635422620','Starbucks','150 S 1st St',95113,'37.33347091457388','-121.88706495271596','(408) 293-9945','Coffee Shop',6970,45,6.9,'$$','http://www.starbucks.com');
INSERT INTO `Venue` (`Venue_ID`,`FS_ID`,`Name`,`Address`,`ZipCode`,`Latitude`,`Longitude`,`PhoneNumber`,`Venue_Type`,`CheckIns`,`Likes`,`Rating`,`Price`,`Website`) VALUES (9017,'49e57056f964a520d1631fe3','Pizza My Heart','117 E San Carlos St',95112,'37.33265094','-121.88462022','(408) 280-0707','Pizza Place',3169,56,8.8,'$','http://pizzamyheart.com/Pizza_My_Heart_Home.html');


INSERT INTO `Amenities` (`Venue_ID`,`Reservations`,`Credit_Cards`,`Outdoor_Seating`,`Alcohol`,`Wifi`,`Menus`,`Events_Count`) VALUES (9001,'N','Y','Y','Y','Y','Happy Hour',0);
INSERT INTO `Amenities` (`Venue_ID`,`Reservations`,`Credit_Cards`,`Outdoor_Seating`,`Alcohol`,`Wifi`,`Menus`,`Events_Count`) VALUES (9002,'N','Y','Y','Y','N','Happy Hour',0);
INSERT INTO `Amenities` (`Venue_ID`,`Reservations`,`Credit_Cards`,`Outdoor_Seating`,`Alcohol`,`Wifi`,`Menus`,`Events_Count`) VALUES (9003,'Y','Y','Y','Y','Y','Dinner, Happy Hour',1);
INSERT INTO `Amenities` (`Venue_ID`,`Reservations`,`Credit_Cards`,`Outdoor_Seating`,`Alcohol`,`Wifi`,`Menus`,`Events_Count`) VALUES (9004,'N','N','N','N','N','Lunch',0);
INSERT INTO `Amenities` (`Venue_ID`,`Reservations`,`Credit_Cards`,`Outdoor_Seating`,`Alcohol`,`Wifi`,`Menus`,`Events_Count`) VALUES (9005,'N','Y','Y','N','Y','Brunch, Lunch, Dinner',0);
INSERT INTO `Amenities` (`Venue_ID`,`Reservations`,`Credit_Cards`,`Outdoor_Seating`,`Alcohol`,`Wifi`,`Menus`,`Events_Count`) VALUES (9006,'N','Y','Y','N','Y',NULL,0);
INSERT INTO `Amenities` (`Venue_ID`,`Reservations`,`Credit_Cards`,`Outdoor_Seating`,`Alcohol`,`Wifi`,`Menus`,`Events_Count`) VALUES (9007,'N','Y','Y','N','Y',NULL,0);
INSERT INTO `Amenities` (`Venue_ID`,`Reservations`,`Credit_Cards`,`Outdoor_Seating`,`Alcohol`,`Wifi`,`Menus`,`Events_Count`) VALUES (9008,'N','Y','Y','N','Y','Breakfast',0);
INSERT INTO `Amenities` (`Venue_ID`,`Reservations`,`Credit_Cards`,`Outdoor_Seating`,`Alcohol`,`Wifi`,`Menus`,`Events_Count`) VALUES (9009,'N','Y','N','Y','N','Happy Hour, Brunch, Lunch, Dinner',0);
INSERT INTO `Amenities` (`Venue_ID`,`Reservations`,`Credit_Cards`,`Outdoor_Seating`,`Alcohol`,`Wifi`,`Menus`,`Events_Count`) VALUES (9010,'Y','Y','Y','Y','Y','Brunch, Dinner',1);
INSERT INTO `Amenities` (`Venue_ID`,`Reservations`,`Credit_Cards`,`Outdoor_Seating`,`Alcohol`,`Wifi`,`Menus`,`Events_Count`) VALUES (9011,'N','Y','N','N','N','Brunch, Lunch, Dinner',0);
INSERT INTO `Amenities` (`Venue_ID`,`Reservations`,`Credit_Cards`,`Outdoor_Seating`,`Alcohol`,`Wifi`,`Menus`,`Events_Count`) VALUES (9012,'N','N','N','N','N','Lunch, Dinner',0);
INSERT INTO `Amenities` (`Venue_ID`,`Reservations`,`Credit_Cards`,`Outdoor_Seating`,`Alcohol`,`Wifi`,`Menus`,`Events_Count`) VALUES (9013,'N','Y','Y','N','N','Brunch, Lunch, Dinner',0);
INSERT INTO `Amenities` (`Venue_ID`,`Reservations`,`Credit_Cards`,`Outdoor_Seating`,`Alcohol`,`Wifi`,`Menus`,`Events_Count`) VALUES (9014,'N','N','Y','N','Y','Brunch, Lunch, Dinner',0);
INSERT INTO `Amenities` (`Venue_ID`,`Reservations`,`Credit_Cards`,`Outdoor_Seating`,`Alcohol`,`Wifi`,`Menus`,`Events_Count`) VALUES (9015,'N','Y','Y','N','N','Lunch, Dinner',0);
INSERT INTO `Amenities` (`Venue_ID`,`Reservations`,`Credit_Cards`,`Outdoor_Seating`,`Alcohol`,`Wifi`,`Menus`,`Events_Count`) VALUES (9016,'N','Y','Y','N','Y','Breakfast',0);
INSERT INTO `Amenities` (`Venue_ID`,`Reservations`,`Credit_Cards`,`Outdoor_Seating`,`Alcohol`,`Wifi`,`Menus`,`Events_Count`) VALUES (9017,'Y','Y','Y','Y','N','Brunch, Lunch, Dinner',0);

INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9001,3);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9002,3);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9003,3);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9003,6);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9004,4);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9005,4);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9005,5);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9006,4);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9006,5);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9007,1);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9007,4);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9007,5);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9008,1);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9008,4);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9008,5);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9009,1);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9009,3);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9009,4);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9009,6);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9010,1);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9010,3);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9010,5);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9010,6);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9011,4);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9011,6);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9012,4);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9012,6);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9013,1);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9013,4);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9013,6);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9014,4);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9014,5);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9015,4);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9015,6);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9016,5);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9017,1);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9017,2);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9017,3);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9017,4);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9017,6);

INSERT INTO `User_Favs` (`User_ID`,`Venue_ID`,`Date_Visiting`) VALUES (1001,9004,'2014-10-20');
INSERT INTO `User_Favs` (`User_ID`,`Venue_ID`,`Date_Visiting`) VALUES (1001,9016,'2014-11-25');
INSERT INTO `User_Favs` (`User_ID`,`Venue_ID`,`Date_Visiting`) VALUES (1001,9017,'2014-11-30');
INSERT INTO `User_Favs` (`User_ID`,`Venue_ID`,`Date_Visiting`) VALUES (1002,9001,'2014-11-01');
INSERT INTO `User_Favs` (`User_ID`,`Venue_ID`,`Date_Visiting`) VALUES (1002,9016,'2014-11-25');
INSERT INTO `User_Favs` (`User_ID`,`Venue_ID`,`Date_Visiting`) VALUES (1003,9009,'2014-11-18');

/*Insert for user login information*/
INSERT INTO `Accounts` (`email`,`password`,`last_login`) VALUES ('jennifer.j.wu@sjsu.edu','cmpe226',now());
INSERT INTO `Accounts` (`email`,`password`,`last_login`) VALUES ('xiaoli.jiang@sjsu.edu','cmpe226pw',now());
