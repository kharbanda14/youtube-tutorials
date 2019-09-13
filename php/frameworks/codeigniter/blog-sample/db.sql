CREATE TABLE `posts` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(250) NOT NULL,
	`slug` VARCHAR(250) NOT NULL,
	`content` TEXT NOT NULL,
	`date_created` TIMESTAMP NOT NULL DEFAULT current_timestamp(),
	`date_updated` TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	PRIMARY KEY (`id`)
)
ENGINE=InnoDB
;
