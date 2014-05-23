CREATE TABLE `productivore_db`.`achievements` (
  `achievement_id` INT NOT NULL AUTO_INCREMENT,
  `achievement_name` VARCHAR(128) NULL DEFAULT NULL,
  `achievement_condition` VARCHAR(512) NULL,
  `achievement_rewards` INT NULL DEFAULT 550,
  `user_id` INT(11) NULL,
  `is_completed` INT(1) NULL DEFAULT false,
  `completed_on` DATETIME NULL DEFAULT NULL,
  `inserted_on` DATETIME NULL,
  PRIMARY KEY (`achievement_id`),
  INDEX `achievements_user_id_idx` (`user_id` ASC),
  CONSTRAINT `achievements_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `productivore_db`.`users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
	
