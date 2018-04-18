-- Table generation script for sightings table

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema mooze
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mooze
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mooze` DEFAULT CHARACTER SET latin1 ;
USE `mooze` ;

-- -----------------------------------------------------
-- Table `mooze`.`sighting`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mooze`.`sighting` ;

CREATE TABLE IF NOT EXISTS `mooze`.`sighting` (
  `sightingID` INT(11) NOT NULL AUTO_INCREMENT,
  `datetime` DATETIME NOT NULL,
  `latitude` FLOAT NOT NULL,
  `longitude` FLOAT NOT NULL,
  `mooseqty` INT(11) NOT NULL DEFAULT '0',
  `bearqty` INT(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sightingID`))
ENGINE = InnoDB
AUTO_INCREMENT = 44
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
