SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `FS_Recommender` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `FS_Recommender` ;

-- -----------------------------------------------------
-- Table `FS_Recommender`.`Venue`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `FS_Recommender`.`Venue` ;

CREATE TABLE IF NOT EXISTS `FS_Recommender`.`Venue` (
  `Venue_ID` int(11) NOT NULL,
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
  `HereNowCount` int(11) DEFAULT NULL,
  `Price` varchar(5) DEFAULT NULL COMMENT '{$, $$, $$$, $$$$}',
  `Website` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`Venue_ID`))
ENGINE = InnoDB;

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

CREATE TABLE IF NOT EXISTS `FS_Recommender`.`Amenities` (
  `Venue_ID` int(11) NOT NULL,
  `Reservations` varchar(1) DEFAULT NULL,
  `Credit_Cards` varchar(1) DEFAULT NULL,
  `Takeout` varchar(1) DEFAULT NULL,
  `Drivethru` varchar(1) DEFAULT NULL,
  `Outdoor_Seating` varchar(1) DEFAULT NULL,
  `Alcohol` varchar(1) DEFAULT NULL,
  `Wifi` varchar(1) DEFAULT NULL,
  `Events_Count` int(11) DEFAULT NULL,
  PRIMARY KEY (`Venue_ID`),
  CONSTRAINT `fk_Amenities_Venue1`
    FOREIGN KEY (`Venue_ID`)
    REFERENCES `FS_Recommender`.`Venue` (`Venue_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

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


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;



/*Inserts*/
INSERT INTO `FS_Recommender`.`User` (`User_ID`, `Name`, `ZipCode`) VALUES ('1001', 'Jenn', '95192');
INSERT INTO `FS_Recommender`.`User` (`User_ID`, `Name`, `ZipCode`) VALUES ('1002', 'Xiaoli', '95192');


INSERT INTO `Category` (`Category_ID`,`Criteria`,`Description`) VALUES (1,'Relax','Type = coffee,cafe, checkinsCount <=5, or events == []');
INSERT INTO `Category` (`Category_ID`,`Criteria`,`Description`) VALUES (2,'Popular','checkinsCount >=20, isOpen != false');
INSERT INTO `Category` (`Category_ID`,`Criteria`,`Description`) VALUES (3,'Special Event','reservations == \'Yes\'');
INSERT INTO `Category` (`Category_ID`,`Criteria`,`Description`) VALUES (4,'Mingle','drinks != \'No\', checkinCounts >= 10 or events != []');
INSERT INTO `Category` (`Category_ID`,`Criteria`,`Description`) VALUES (5,'Economical','priceTier <= 2');
INSERT INTO `Category` (`Category_ID`,`Criteria`,`Description`) VALUES (6,'Study','wifi == \'Yes\' || Type = cofee,cafe');
INSERT INTO `Category` (`Category_ID`,`Criteria`,`Description`) VALUES (7,'Large Group','reservations == \'Yes\' || outdoorSeating == \'Yes\'');
INSERT INTO `Category` (`Category_ID`,`Criteria`,`Description`) VALUES (8,'Surprise Me','random near longitude/latitude (or zipCode)');


INSERT INTO `Venue` (`Venue_ID`,`Name`,`Address`,`ZipCode`,`Latitude`,`Longitude`,`PhoneNumber`,`Venue_Type`,`CheckIns`,`Likes`,`Rating`,`HereNowCount`,`Price`,`Website`) VALUES (9001,'Vyne Bistro','110 Paseo de San Antonio',95125,'37.301273808095225','-121.88433051109313',NULL,'Wine Bar',415,16,7.3,0,'$$',NULL);
INSERT INTO `Venue` (`Venue_ID`,`Name`,`Address`,`ZipCode`,`Latitude`,`Longitude`,`PhoneNumber`,`Venue_Type`,`CheckIns`,`Likes`,`Rating`,`HereNowCount`,`Price`,`Website`) VALUES (9002,'San Pedro Square Market Bar',NULL,NULL,'37.33649','-121.894275',NULL,'Bar',734,14,7.4,0,'$$',NULL);
INSERT INTO `Venue` (`Venue_ID`,`Name`,`Address`,`ZipCode`,`Latitude`,`Longitude`,`PhoneNumber`,`Venue_Type`,`CheckIns`,`Likes`,`Rating`,`HereNowCount`,`Price`,`Website`) VALUES (9003,'The Blackbird Tavern','200 S 1st St',95113,'37.33299422537002','-121.88797645983344','(408) 286-1313','Pub',985,41,7.1,1,'$$','http://www.theblackbirdtavern.com');
INSERT INTO `Venue` (`Venue_ID`,`Name`,`Address`,`ZipCode`,`Latitude`,`Longitude`,`PhoneNumber`,`Venue_Type`,`CheckIns`,`Likes`,`Rating`,`HereNowCount`,`Price`,`Website`) VALUES (9004,'Cafe Pomegranate','221 E San Fernando St',95112,'37.3366418112803','-121.88469166416216','(408) 271-8822','Cafe',400,7,7.9,0,'$','http://cafepomegranate.com');


INSERT INTO `Amenities` (`Venue_ID`,`Reservations`,`Credit_Cards`,`Takeout`,`Drivethru`,`Outdoor_Seating`,`Alcohol`,`Wifi`,`Events_Count`) VALUES (9001,'N','Y','N','N','Y','Y','Y',0);
INSERT INTO `Amenities` (`Venue_ID`,`Reservations`,`Credit_Cards`,`Takeout`,`Drivethru`,`Outdoor_Seating`,`Alcohol`,`Wifi`,`Events_Count`) VALUES (9002,'N','Y','N','N','Y','Y','N',0);
INSERT INTO `Amenities` (`Venue_ID`,`Reservations`,`Credit_Cards`,`Takeout`,`Drivethru`,`Outdoor_Seating`,`Alcohol`,`Wifi`,`Events_Count`) VALUES (9003,'Y','Y','N','N','Y','Y','Y',1);
INSERT INTO `Amenities` (`Venue_ID`,`Reservations`,`Credit_Cards`,`Takeout`,`Drivethru`,`Outdoor_Seating`,`Alcohol`,`Wifi`,`Events_Count`) VALUES (9004,'N','N','N','N','N','N','N',0);


INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9001,2);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9002,2);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9003,2);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9003,3);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9004,1);
INSERT INTO `Venue_Category` (`Venue_ID`,`Category_ID`) VALUES (9004,6);


INSERT INTO `User_Favs` (`User_ID`,`Venue_ID`,`Date_Visiting`) VALUES (1001,9004,'2014-10-20');
INSERT INTO `User_Favs` (`User_ID`,`Venue_ID`,`Date_Visiting`) VALUES (1002,9001,'2014-11-01');
