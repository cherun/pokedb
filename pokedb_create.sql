-- ----------------------------------------------------------------------------
--	Pokémon Database
--	Generation I (Red/blue/yellow/green)
--	Kanto region
-- ----------------------------------------------------------------------------
DROP TABLE IF EXISTS `pokemon_types`;
DROP TABLE IF EXISTS `pokemon_predecessor`;
DROP TABLE IF EXISTS `pokemon_moves`;
DROP TABLE IF EXISTS `pokemon_location`;
DROP TABLE IF EXISTS `trainer_pkmntypes`;
DROP TABLE IF EXISTS `trainer_class`;
DROP TABLE IF EXISTS `moves`;
DROP TABLE IF EXISTS `locations`;
DROP TABLE IF EXISTS `pokemon`;
DROP TABLE IF EXISTS `types`;

-- ----------------------------------------------------------------------------
--	`pokemon_db`.`types`
--	Pokémon types in Generation I
-- ----------------------------------------------------------------------------
CREATE TABLE `types` (
	`type_id` int(11) NOT NULL AUTO_INCREMENT,
	`type_name` varchar(255) NOT NULL,
	PRIMARY KEY (`type_id`),
	UNIQUE KEY (`type_name`)
) ENGINE=InnoDB;

-- ----------------------------------------------------------------------------
--	`pokemon_db`.`pokemon`
--	Pokémon species in Generation I
-- ----------------------------------------------------------------------------
CREATE TABLE `pokemon` (
	`pokemon_id` int(11) NOT NULL,
	`name` varchar(255) NOT NULL,
	`description` varchar(255),
	PRIMARY KEY (`pokemon_id`),
	UNIQUE KEY (`name`)
) ENGINE=InnoDB;

-- ----------------------------------------------------------------------------
--	`pokemon_db`.`locations`
--	Locations in the Kanto region
-- ----------------------------------------------------------------------------
CREATE TABLE `locations` (
	`location_id` int(11) NOT NULL AUTO_INCREMENT,
	`location_name` varchar(255) NOT NULL,
	`description` varchar(255),
	PRIMARY KEY (`location_id`),
	UNIQUE KEY (`location_name`)
) ENGINE=InnoDB;

-- ----------------------------------------------------------------------------
--	`pokemon_db`.`moves`
--	Pokémon moves in Generation I
-- ----------------------------------------------------------------------------
CREATE TABLE `moves` (
	`move_id` int(11) NOT NULL AUTO_INCREMENT,
	`move_name` varchar(255) NOT NULL,
	`type` int(11) NOT NULL,
	`base_dmg` int(11) DEFAULT NULL,
	`power_pts` int(11),
	`description` varchar(255),
	PRIMARY KEY (`move_id`),
	UNIQUE KEY (`move_name`),
	FOREIGN KEY (`type`) REFERENCES `types` (`type_id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ----------------------------------------------------------------------------
--	`pokemon_db`.`trainer_class`
--	Trainer classes encountered in Generation I games
-- ----------------------------------------------------------------------------
CREATE TABLE `trainer_class` (
	`class_id` int(11) NOT NULL AUTO_INCREMENT,
	`class_name` varchar(255) NOT NULL,
	`description` varchar(255),
	PRIMARY KEY (`class_id`),
	UNIQUE KEY (`class_name`)
) ENGINE=InnoDB;

-- ----------------------------------------------------------------------------
--	`pokemon_db`.`trainer_pkmntypes`
--	Trainers and Pokémon types typically owned by trainer classes
--	Many-to-many (trainer and Pokemon types)
-- ----------------------------------------------------------------------------
CREATE TABLE `trainer_pkmntypes` (
	`trainer_id` int(11) NOT NULL,
	`type_id` int(11) NOT NULL,
	PRIMARY KEY (`trainer_id`, `type_id`),
	FOREIGN KEY (`trainer_id`) REFERENCES `trainer_class` (`class_id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY (`type_id`) REFERENCES `types` (`type_id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ----------------------------------------------------------------------------
--	`pokemon_db`.`pokemon_location`
--	Pokémon found in locations in the Kanto region
--	Many-to-many (location and Pokémon species)
-- ----------------------------------------------------------------------------
CREATE TABLE `pokemon_location` (
	`pid` int(11) NOT NULL,
	`lid` int(11) NOT NULL,
	PRIMARY KEY (`pid`, `lid`),
	FOREIGN KEY (`pid`) REFERENCES `pokemon` (`pokemon_id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY (`lid`) REFERENCES `locations` (`location_id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ----------------------------------------------------------------------------
--	`pokemon_db`.`pokemon_moves`
--	Moves learned by Pokemon species
--	Many-to-many (moves and Pokémon species)
-- ----------------------------------------------------------------------------
CREATE TABLE `pokemon_moves` (
	`mid` int(11) NOT NULL,
	`pid` int(11) NOT NULL,
	PRIMARY KEY (`mid`, `pid`),
	FOREIGN KEY (`mid`) REFERENCES `moves` (`move_id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY (`pid`) REFERENCES `pokemon` (`pokemon_id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ----------------------------------------------------------------------------
--	`pokemon_db`.`pokemon_predecessor`
--	Pokémon and their predecessors
--	One-to-many relationship (one Pokémon can have many predecessors)
-- ----------------------------------------------------------------------------
CREATE TABLE `pokemon_predecessor` (
	`evolution_pid` int(11) NOT NULL,
	`predecessor_pid` int(11) NOT NULL,
	PRIMARY KEY (`evolution_pid`, `predecessor_pid`),
	FOREIGN KEY (`evolution_pid`) REFERENCES `pokemon` (`pokemon_id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY (`predecessor_pid`) REFERENCES `pokemon` (`pokemon_id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ----------------------------------------------------------------------------
--	`pokemon_db`.`pokemon_types`
--	Pokémon and their types
--	Many-to-many relationship (Pokémon can have 1-2 types, and types can have
--		many Pokémon)
-- ----------------------------------------------------------------------------
CREATE TABLE `pokemon_types` (
	`pid` int(11) NOT NULL,
	`tid` int(11) NOT NULL,
	PRIMARY KEY (`pid`, `tid`),
	FOREIGN KEY (`pid`) REFERENCES `pokemon` (`pokemon_id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY (`tid`) REFERENCES `types` (`type_id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE
) ENGINE=InnoDB;