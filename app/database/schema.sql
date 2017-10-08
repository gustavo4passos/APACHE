SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Table `db_mvc`.`address`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_mvc`.`super_users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45)  NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_mvc`.`address`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_mvc`.`address` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `street` VARCHAR(45) NULL DEFAULT NULL,
  `number` INT NULL DEFAULT NULL,
  `complement` VARCHAR(45) NULL DEFAULT NULL,
  `city` VARCHAR(45) NULL DEFAULT NULL,
  `state` VARCHAR(45) NULL DEFAULT NULL,
  `country` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_mvc`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_mvc`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `cpf` VARCHAR(11) NOT NULL,
  `rg` VARCHAR(20) NOT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `address_id` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `cpf_UNIQUE` (`cpf` ASC),
  UNIQUE INDEX `rg_UNIQUE` (`rg` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  INDEX `fk_user_address1_idx` (`address_id` ASC),
  CONSTRAINT `fk_user_address1`
    FOREIGN KEY (`address_id`)
    REFERENCES `db_mvc`.`address` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_mvc`.`department`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_mvc`.`department` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `code` VARCHAR(20) NOT NULL,
  `headmaster_id` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC),
  UNIQUE INDEX `code_UNIQUE` (`code` ASC),
  INDEX `fk_department_professor1_idx` (`headmaster_id` ASC),
  CONSTRAINT `fk_department_professor1`
    FOREIGN KEY (`headmaster_id`)
    REFERENCES `db_mvc`.`professor` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_mvc`.`professor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_mvc`.`professor` (
  `user_id` INT NOT NULL,
  `matriculation` VARCHAR(20) NOT NULL,
  `schooling` VARCHAR(45) NOT NULL,
  `hiring_date` DATE NOT NULL,
  `department_id` INT NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE INDEX `matriculation_UNIQUE` (`matriculation` ASC),
  INDEX `fk_professor_department1_idx` (`department_id` ASC),
  CONSTRAINT `fk_professor_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `db_mvc`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_professor_department1`
    FOREIGN KEY (`department_id`)
    REFERENCES `db_mvc`.`department` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_mvc`.`course`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_mvc`.`course` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `duration` INT NULL DEFAULT NULL,
  `code` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC),
  UNIQUE INDEX `code_UNIQUE` (`code` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_mvc`.`student`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_mvc`.`student` (
  `user_id` INT NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `matriculation` VARCHAR(20) NOT NULL,
  `born_date` DATE NOT NULL,
  `entry_date` DATE NOT NULL,
  `course_id` INT NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE INDEX `matriculation_UNIQUE` (`matriculation` ASC),
  INDEX `fk_student_course1_idx` (`course_id` ASC),
  CONSTRAINT `fk_student_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `db_mvc`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_student_course1`
    FOREIGN KEY (`course_id`)
    REFERENCES `db_mvc`.`course` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_mvc`.`subject`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_mvc`.`subject` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `code` VARCHAR(20) NOT NULL,
  `syllabus` TEXT NULL DEFAULT NULL,
  `department_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `code_UNIQUE` (`code` ASC),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC),
  INDEX `fk_subject_department1_idx` (`department_id` ASC),
  CONSTRAINT `fk_subject_department1`
    FOREIGN KEY (`department_id`)
    REFERENCES `db_mvc`.`department` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_mvc`.`phone_number`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_mvc`.`phone_number` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `number` VARCHAR(20) NOT NULL,
  `type` VARCHAR(45) NULL DEFAULT NULL,
  `user_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_phone_number_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_phone_number_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `db_mvc`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_mvc`.`professor_lectures_subject`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_mvc`.`professor_lectures_subject` (
  `professor_user_id` INT NOT NULL,
  `subject_id` INT NOT NULL,
  PRIMARY KEY (`professor_user_id`, `subject_id`),
  INDEX `fk_professor_has_subject_subject1_idx` (`subject_id` ASC),
  INDEX `fk_professor_has_subject_professor1_idx` (`professor_user_id` ASC),
  CONSTRAINT `fk_professor_has_subject_professor1`
    FOREIGN KEY (`professor_user_id`)
    REFERENCES `db_mvc`.`professor` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_professor_has_subject_subject1`
    FOREIGN KEY (`subject_id`)
    REFERENCES `db_mvc`.`subject` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_mvc`.`course_has_subject`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_mvc`.`course_has_subject` (
  `course_id` INT NOT NULL,
  `subject_id` INT NOT NULL,
  PRIMARY KEY (`course_id`, `subject_id`),
  INDEX `fk_course_has_subject_subject1_idx` (`subject_id` ASC),
  INDEX `fk_course_has_subject_course1_idx` (`course_id` ASC),
  CONSTRAINT `fk_course_has_subject_course1`
    FOREIGN KEY (`course_id`)
    REFERENCES `db_mvc`.`course` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_course_has_subject_subject1`
    FOREIGN KEY (`subject_id`)
    REFERENCES `db_mvc`.`subject` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_mvc`.`class`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_mvc`.`class` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `init_date` DATE NOT NULL,
  `code` VARCHAR(20) NOT NULL,
  `capacity` INT NOT NULL,
  `subject_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `code_UNIQUE` (`code` ASC),
  INDEX `fk_class_subject1_idx` (`subject_id` ASC),
  CONSTRAINT `fk_class_subject1`
    FOREIGN KEY (`subject_id`)
    REFERENCES `db_mvc`.`subject` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_mvc`.`class_has_student`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_mvc`.`class_has_student` (
  `class_id` INT NOT NULL,
  `student_user_id` INT NOT NULL,
  PRIMARY KEY (`class_id`, `student_user_id`),
  INDEX `fk_class_has_student_student1_idx` (`student_user_id` ASC),
  INDEX `fk_class_has_student_class1_idx` (`class_id` ASC),
  CONSTRAINT `fk_class_has_student_class1`
    FOREIGN KEY (`class_id`)
    REFERENCES `db_mvc`.`class` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_class_has_student_student1`
    FOREIGN KEY (`student_user_id`)
    REFERENCES `db_mvc`.`student` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_mvc`.`professor_has_class`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_mvc`.`professor_has_class` (
  `professor_user_id` INT NOT NULL,
  `class_id` INT NOT NULL,
  PRIMARY KEY (`professor_user_id`, `class_id`),
  INDEX `fk_professor_has_class_class1_idx` (`class_id` ASC),
  INDEX `fk_professor_has_class_professor1_idx` (`professor_user_id` ASC),
  CONSTRAINT `fk_professor_has_class_professor1`
    FOREIGN KEY (`professor_user_id`)
    REFERENCES `db_mvc`.`professor` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_professor_has_class_class1`
    FOREIGN KEY (`class_id`)
    REFERENCES `db_mvc`.`class` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;