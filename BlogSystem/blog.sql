-- MySQL Script generated by MySQL Workbench
-- 04/23/15 22:54:20
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema blog
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema blog
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `blog` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `blog` ;

-- -----------------------------------------------------
-- Table `blog`.`Users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `blog`.`Users` (
  `UserId` INT NOT NULL AUTO_INCREMENT,
  `UserName` VARCHAR(50) NOT NULL,
  `FirstName` VARCHAR(50) NOT NULL,
  `LastName` VARCHAR(50) NOT NULL,
  `Password` VARCHAR(45) NOT NULL,
  `Picture` TEXT  NULL,
  PRIMARY KEY (`UserId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `blog`.`Categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `blog`.`Categories` (
  `CategoryId` INT NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`CategoryId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `blog`.`Posts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `blog`.`Posts` (
  `PostId` INT NOT NULL AUTO_INCREMENT,
  `Content` TEXT(300) NULL,
  `Title` VARCHAR(50) NOT NULL,
  `PostDate` DATE NULL,
  `CategoryId` INT(30) NULL,
  `UserId` INT NOT NULL,
  `Category_CategoryId` INT NOT NULL,
  `User_UserId` INT NOT NULL,
  PRIMARY KEY (`PostId`),
  INDEX `fk_Post_Category_idx` (`Category_CategoryId` ASC),
  INDEX `fk_Post_User1_idx` (`User_UserId` ASC),
  CONSTRAINT `fk_Post_Category`
    FOREIGN KEY (`Category_CategoryId`)
    REFERENCES `blog`.`Categories` (`CategoryId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Post_User1`
    FOREIGN KEY (`User_UserId`)
    REFERENCES `blog`.`Users` (`UserId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `blog`.`Comments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `blog`.`Comments` (
  `CommentId` INT NOT NULL AUTO_INCREMENT,
  `Content` TEXT NULL,
  `AuthorId` INT NULL,
  `DateCreated` DATETIME NULL,
  `PostId` VARCHAR(45) NULL,
  `User_UserId` INT NOT NULL,
  `Post_PostId` INT NOT NULL,
  PRIMARY KEY (`CommentId`),
  INDEX `fk_Comment_User1_idx` (`User_UserId` ASC),
  INDEX `fk_Comment_Post1_idx` (`Post_PostId` ASC),
  CONSTRAINT `fk_Comment_User1`
    FOREIGN KEY (`User_UserId`)
    REFERENCES `blog`.`Users` (`UserId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Comment_Post1`
    FOREIGN KEY (`Post_PostId`)
    REFERENCES `blog`.`Posts` (`PostId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `blog`.`Tags`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `blog`.`Tags` (
  `TagId` INT NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`TagId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `blog`.`PostsTags`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `blog`.`PostsTags` (
  `PostId` INT NULL,
  `TagId` INT NULL,
  `Post_PostId` INT NOT NULL,
  `Tag_TagId` INT NOT NULL,
  INDEX `fk_PostTags_Post1_idx` (`Post_PostId` ASC),
  INDEX `fk_PostTags_Tag1_idx` (`Tag_TagId` ASC),
  CONSTRAINT `fk_PostTags_Post1`
    FOREIGN KEY (`Post_PostId`)
    REFERENCES `blog`.`Posts` (`PostId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PostTags_Tag1`
    FOREIGN KEY (`Tag_TagId`)
    REFERENCES `blog`.`Tags` (`TagId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `blog`.`Administrators`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `blog`.`Administrators` (
  `AdminId` INT NOT NULL AUTO_INCREMENT,
  `FirstName` VARCHAR(45) NOT NULL,
  `LastName` VARCHAR(45) NOT NULL,
  `Password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`AdminId`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;