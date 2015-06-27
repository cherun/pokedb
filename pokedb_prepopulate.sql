-- ----------------------------------------------------------------------------
--	Pokemon Database
--	Prepopulating tables with data from the very beginning of games
-- ----------------------------------------------------------------------------

-- ----------------------------------------------------------------------------
--	Prepopulating `types`
--	(Bulbasaur, Squirtle, Charmander, Rattata, etc.)
-- ----------------------------------------------------------------------------
INSERT INTO types (type_name) VALUES ("grass");
INSERT INTO types (type_name) VALUES ("water");
INSERT INTO types (type_name) VALUES ("fire");
INSERT INTO types (type_name) VALUES ("normal");
INSERT INTO types (type_name) VALUES ("flying");
INSERT INTO types (type_name) VALUES ("poison");
INSERT INTO types (type_name) VALUES ("bug");

-- ----------------------------------------------------------------------------
--	Prepopulating `pokemon`
-- ----------------------------------------------------------------------------
INSERT INTO pokemon (pokemon_id, name, description) VALUES (1, "Bulbasaur", "A strange seed was planted on its back at birth. This plant sprouts and grows with this Pokemon.");
INSERT INTO pokemon (pokemon_id, name, description) VALUES (4, "Charmander", "Obviously prefers hot places. When it rains, steam is said to spout from the top of its tail.");
INSERT INTO pokemon (pokemon_id, name, description) VALUES (7, "Squirtle", "After birth, its back swells and hardens into a shell. Powerfully sprays foam from its mouth.");
INSERT INTO pokemon (pokemon_id, name, description) VALUES (10, "Caterpie", "Its short feet are tipped with suction pads that enable it to tirelessly climb slopes and walls.");
INSERT INTO pokemon (pokemon_id, name, description) VALUES (11, "Metapod", "This Pokemon is vulnerable to attack while its shell is soft, exposing its weak and tender body.");
INSERT INTO pokemon (pokemon_id, name, description) VALUES (13, "Weedle", "Often found in forests, eating leaves. It has a sharp venomous stinger on its head.");
INSERT INTO pokemon (pokemon_id, name, description) VALUES (14, "Kakuna", "Almost incapable of moving, this Pokemon can only harden its shell to protect itself from predators.");
INSERT INTO pokemon (pokemon_id, name, description) VALUES (16, "Pidgey", "A common sight in forests and woods. It flaps its wings at ground level to kick up blinding sand.");
INSERT INTO pokemon (pokemon_id, name, description) VALUES (19, "Rattata", "Bits anything when it attacks. Small and very quick, it is a common sight in many places.");
INSERT INTO pokemon (pokemon_id, name, description) VALUES (21, "Spearow", "Eats bugs in grassy areas. It has to flap its short wings at high speed to stay airborne.");

-- ----------------------------------------------------------------------------
--	Prepopulating `locations`
-- ----------------------------------------------------------------------------
INSERT INTO locations (location_name, description) VALUES ("Pallet Town", "A fairly new and quiet town. It's a small and pretty place.");
INSERT INTO locations (location_name, description) VALUES ("Route 1", "A country road full of greenery and rough paths.");
INSERT INTO locations (location_name, description) VALUES ("Viridian City", "A beautiful city that is enveloped in green year-round.");
INSERT INTO locations (location_name, description) VALUES ("Route 2", "A path that winds and bends from the forest's entrance.");
INSERT INTO locations (location_name) VALUES ("Viridian Forest");
INSERT INTO locations (location_name, description) VALUES ("Route 3", "A road where many rocks have fallen from the sky to create craters.");

-- ----------------------------------------------------------------------------
--	Prepopulating `moves`
-- ----------------------------------------------------------------------------
INSERT INTO moves (move_name, type, power_pts, description) VALUES ("Growl", (SELECT type_id FROM `types` WHERE type_name = "normal"), 40, "Lowers the target's Attack by one stage.");
INSERT INTO moves (move_name, type, base_dmg, power_pts) VALUES ("Tackle", (SELECT type_id FROM `types` WHERE type_name = "normal"), 35, 35);
INSERT INTO moves (move_name, type, power_pts, description) VALUES ("Leech Seed", (SELECT type_id FROM `types` WHERE type_name = "grass"), 10, "Leeches 1/16 of the target's HP each turn.");
INSERT INTO moves (move_name, type, base_dmg, power_pts) VALUES ("Scratch", (SELECT type_id FROM `types` WHERE type_name = "normal"), 40, 35);
INSERT INTO moves (move_name, type, base_dmg, power_pts, description) VALUES ("Ember", (SELECT type_id FROM `types` WHERE type_name = "fire"), 40, 25, "10% chance to burn the target.");
INSERT INTO moves (move_name, type, power_pts, description) VALUES ("Tail Whip", (SELECT type_id FROM `types` WHERE type_name = "normal"), 30, "Lowers the Defense of all opposing adjacent Pokémon by one stage.");
INSERT INTO moves (move_name, type, base_dmg, power_pts, description) VALUES ("Bubble", (SELECT type_id FROM `types` WHERE type_name = "water"), 20, 30, "10% chance to lower the target's Speed by one stage.");
INSERT INTO moves (move_name, type, power_pts, description) VALUES ("String Shot", (SELECT type_id FROM `types` WHERE type_name = "bug"), 40, "Lowers the target's Speed by one stage.");
INSERT INTO moves (move_name, type, base_dmg, power_pts, description) VALUES ("Poison Sting", (SELECT type_id FROM `types` WHERE type_name = "poison"), 15, 35, "20% chance to poison the target.");
INSERT INTO moves (move_name, type, base_dmg, power_pts) VALUES ("Gust", (SELECT type_id FROM `types` WHERE type_name = "normal"), 40, 35);
INSERT INTO moves (move_name, type, power_pts, description) VALUES ("Sand Attack", (SELECT type_id FROM `types` WHERE type_name = "normal"), 15, "Lowers the target's Accuracy by one stage.");
INSERT INTO moves (move_name, type, base_dmg, power_pts) VALUES ("Peck", (SELECT type_id FROM `types` WHERE type_name = "flying"), 35, 35);
INSERT INTO moves (move_name, type, power_pts, description) VALUES ("Harden", (SELECT type_id FROM `types` WHERE type_name = "normal"), 30, "Boosts the user's Defense by one stage.");

-- ----------------------------------------------------------------------------
--	Prepopulating `trainer_class`
-- ----------------------------------------------------------------------------
INSERT INTO trainer_class (class_name, description) VALUES ("Bug Catcher", "Young children in hats carrying nets.");
INSERT INTO trainer_class (class_name, description) VALUES ("Lass", "Young girls in school uniforms.");
INSERT INTO trainer_class (class_name, description) VALUES ("Youngster", "Young boys wearing caps and shorts.");

-- ----------------------------------------------------------------------------
--	Prepopulating `trainer_pkmntypes`
-- ----------------------------------------------------------------------------
INSERT INTO trainer_pkmntypes (trainer_id, type_id) VALUES ((SELECT class_id FROM trainer_class WHERE class_name = "Bug Catcher"), (SELECT type_id FROM types WHERE type_name = "bug"));
INSERT INTO trainer_pkmntypes (trainer_id, type_id) VALUES ((SELECT class_id FROM trainer_class WHERE class_name = "Bug Catcher"), (SELECT type_id FROM types WHERE type_name = "poison"));
INSERT INTO trainer_pkmntypes (trainer_id, type_id) VALUES ((SELECT class_id FROM trainer_class WHERE class_name = "Lass"), (SELECT type_id FROM types WHERE type_name = "normal"));
INSERT INTO trainer_pkmntypes (trainer_id, type_id) VALUES ((SELECT class_id FROM trainer_class WHERE class_name = "Lass"), (SELECT type_id FROM types WHERE type_name = "flying"));
INSERT INTO trainer_pkmntypes (trainer_id, type_id) VALUES ((SELECT class_id FROM trainer_class WHERE class_name = "Youngster"), (SELECT type_id FROM types WHERE type_name = "normal"));
INSERT INTO trainer_pkmntypes (trainer_id, type_id) VALUES ((SELECT class_id FROM trainer_class WHERE class_name = "Youngster"), (SELECT type_id FROM types WHERE type_name = "flying"));

-- ----------------------------------------------------------------------------
--	Prepopulating `pokemon_location`
-- ----------------------------------------------------------------------------
INSERT INTO pokemon_location (pid, lid) VALUES ((SELECT pokemon_id FROM pokemon WHERE name = "Rattata"), (SELECT location_id FROM locations WHERE location_name = "Route 1"));
INSERT INTO pokemon_location (pid, lid) VALUES ((SELECT pokemon_id FROM pokemon WHERE name = "Rattata"), (SELECT location_id FROM locations WHERE location_name = "Route 2"));
INSERT INTO pokemon_location (pid, lid) VALUES ((SELECT pokemon_id FROM pokemon WHERE name = "Caterpie"), (SELECT location_id FROM locations WHERE location_name = "Viridian Forest"));
INSERT INTO pokemon_location (pid, lid) VALUES ((SELECT pokemon_id FROM pokemon WHERE name = "Weedle"), (SELECT location_id FROM locations WHERE location_name = "Route 2"));
INSERT INTO pokemon_location (pid, lid) VALUES ((SELECT pokemon_id FROM pokemon WHERE name = "Weedle"), (SELECT location_id FROM locations WHERE location_name = "Viridian Forest"));
INSERT INTO pokemon_location (pid, lid) VALUES ((SELECT pokemon_id FROM pokemon WHERE name = "Pidgey"), (SELECT location_id FROM locations WHERE location_name = "Route 1"));
INSERT INTO pokemon_location (pid, lid) VALUES ((SELECT pokemon_id FROM pokemon WHERE name = "Pidgey"), (SELECT location_id FROM locations WHERE location_name = "Route 2"));
INSERT INTO pokemon_location (pid, lid) VALUES ((SELECT pokemon_id FROM pokemon WHERE name = "Pidgey"), (SELECT location_id FROM locations WHERE location_name = "Route 3"));
INSERT INTO pokemon_location (pid, lid) VALUES ((SELECT pokemon_id FROM pokemon WHERE name = "Spearow"), (SELECT location_id FROM locations WHERE location_name = "Route 3"));
INSERT INTO pokemon_location (pid, lid) VALUES ((SELECT pokemon_id FROM pokemon WHERE name = "Metapod"), (SELECT location_id FROM locations WHERE location_name = "Viridian Forest"));
INSERT INTO pokemon_location (pid, lid) VALUES ((SELECT pokemon_id FROM pokemon WHERE name = "Kakuna"), (SELECT location_id FROM locations WHERE location_name = "Viridian Forest"));

-- ----------------------------------------------------------------------------
--	Prepopulating `pokemon_moves`
-- ----------------------------------------------------------------------------
INSERT INTO pokemon_moves (mid, pid) VALUES ((SELECT move_id FROM moves WHERE move_name = "Growl"), (SELECT pokemon_id FROM pokemon WHERE name = "Bulbasaur"));
INSERT INTO pokemon_moves (mid, pid) VALUES ((SELECT move_id FROM moves WHERE move_name = "Tackle"), (SELECT pokemon_id FROM pokemon WHERE name = "Bulbasaur"));
INSERT INTO pokemon_moves (mid, pid) VALUES ((SELECT move_id FROM moves WHERE move_name = "Leech Seed"), (SELECT pokemon_id FROM pokemon WHERE name = "Bulbasaur"));
INSERT INTO pokemon_moves (mid, pid) VALUES ((SELECT move_id FROM moves WHERE move_name = "Growl"), (SELECT pokemon_id FROM pokemon WHERE name = "Charmander"));
INSERT INTO pokemon_moves (mid, pid) VALUES ((SELECT move_id FROM moves WHERE move_name = "Scratch"), (SELECT pokemon_id FROM pokemon WHERE name = "Charmander"));
INSERT INTO pokemon_moves (mid, pid) VALUES ((SELECT move_id FROM moves WHERE move_name = "Ember"), (SELECT pokemon_id FROM pokemon WHERE name = "Charmander"));
INSERT INTO pokemon_moves (mid, pid) VALUES ((SELECT move_id FROM moves WHERE move_name = "Tackle"), (SELECT pokemon_id FROM pokemon WHERE name = "Squirtle"));
INSERT INTO pokemon_moves (mid, pid) VALUES ((SELECT move_id FROM moves WHERE move_name = "Tail Whip"), (SELECT pokemon_id FROM pokemon WHERE name = "Squirtle"));
INSERT INTO pokemon_moves (mid, pid) VALUES ((SELECT move_id FROM moves WHERE move_name = "Bubble"), (SELECT pokemon_id FROM pokemon WHERE name = "Squirtle"));
INSERT INTO pokemon_moves (mid, pid) VALUES ((SELECT move_id FROM moves WHERE move_name = "Tackle"), (SELECT pokemon_id FROM pokemon WHERE name = "Caterpie"));
INSERT INTO pokemon_moves (mid, pid) VALUES ((SELECT move_id FROM moves WHERE move_name = "String Shot"), (SELECT pokemon_id FROM pokemon WHERE name = "Caterpie"));
INSERT INTO pokemon_moves (mid, pid) VALUES ((SELECT move_id FROM moves WHERE move_name = "Harden"), (SELECT pokemon_id FROM pokemon WHERE name = "Metapod"));
INSERT INTO pokemon_moves (mid, pid) VALUES ((SELECT move_id FROM moves WHERE move_name = "Harden"), (SELECT pokemon_id FROM pokemon WHERE name = "Kakuna"));
INSERT INTO pokemon_moves (mid, pid) VALUES ((SELECT move_id FROM moves WHERE move_name = "Gust"), (SELECT pokemon_id FROM pokemon WHERE name = "Pidgey"));
INSERT INTO pokemon_moves (mid, pid) VALUES ((SELECT move_id FROM moves WHERE move_name = "Sand Attack"), (SELECT pokemon_id FROM pokemon WHERE name = "Pidgey"));
INSERT INTO pokemon_moves (mid, pid) VALUES ((SELECT move_id FROM moves WHERE move_name = "Tackle"), (SELECT pokemon_id FROM pokemon WHERE name = "Rattata"));
INSERT INTO pokemon_moves (mid, pid) VALUES ((SELECT move_id FROM moves WHERE move_name = "Tail Whip"), (SELECT pokemon_id FROM pokemon WHERE name = "Rattata"));
INSERT INTO pokemon_moves (mid, pid) VALUES ((SELECT move_id FROM moves WHERE move_name = "Peck"), (SELECT pokemon_id FROM pokemon WHERE name = "Spearow"));
INSERT INTO pokemon_moves (mid, pid) VALUES ((SELECT move_id FROM moves WHERE move_name = "Growl"), (SELECT pokemon_id FROM pokemon WHERE name = "Spearow"));

-- ----------------------------------------------------------------------------
--	Prepopulating `pokemon_predecessor`
-- ----------------------------------------------------------------------------
INSERT INTO pokemon_predecessor (evolution_pid, predecessor_pid) VALUES ((SELECT pokemon_id FROM pokemon WHERE name = "Metapod"), (SELECT pokemon_id FROM pokemon WHERE name = "Caterpie"));
INSERT INTO pokemon_predecessor (evolution_pid, predecessor_pid) VALUES ((SELECT pokemon_id FROM pokemon WHERE name = "Kakuna"), (SELECT pokemon_id FROM pokemon WHERE name = "Weedle"));

-- ----------------------------------------------------------------------------
--	Prepopulating `pokemon_types`
-- ----------------------------------------------------------------------------
INSERT INTO pokemon_types (pid, tid) VALUES ((SELECT pokemon_id FROM pokemon WHERE name = "Bulbasaur"), (SELECT type_id FROM types WHERE type_name = "grass"));
INSERT INTO pokemon_types (pid, tid) VALUES ((SELECT pokemon_id FROM pokemon WHERE name = "Bulbasaur"), (SELECT type_id FROM types WHERE type_name = "poison"));
INSERT INTO pokemon_types (pid, tid) VALUES ((SELECT pokemon_id FROM pokemon WHERE name = "Charmander"), (SELECT type_id FROM types WHERE type_name = "fire"));
INSERT INTO pokemon_types (pid, tid) VALUES ((SELECT pokemon_id FROM pokemon WHERE name = "Squirtle"), (SELECT type_id FROM types WHERE type_name = "water"));
INSERT INTO pokemon_types (pid, tid) VALUES ((SELECT pokemon_id FROM pokemon WHERE name = "Caterpie"), (SELECT type_id FROM types WHERE type_name = "bug"));
INSERT INTO pokemon_types (pid, tid) VALUES ((SELECT pokemon_id FROM pokemon WHERE name = "Metapod"), (SELECT type_id FROM types WHERE type_name = "bug"));
INSERT INTO pokemon_types (pid, tid) VALUES ((SELECT pokemon_id FROM pokemon WHERE name = "Weedle"), (SELECT type_id FROM types WHERE type_name = "bug"));
INSERT INTO pokemon_types (pid, tid) VALUES ((SELECT pokemon_id FROM pokemon WHERE name = "Weedle"), (SELECT type_id FROM types WHERE type_name = "poison"));
INSERT INTO pokemon_types (pid, tid) VALUES ((SELECT pokemon_id FROM pokemon WHERE name = "Kakuna"), (SELECT type_id FROM types WHERE type_name = "bug"));
INSERT INTO pokemon_types (pid, tid) VALUES ((SELECT pokemon_id FROM pokemon WHERE name = "Kakuna"), (SELECT type_id FROM types WHERE type_name = "poison"));
INSERT INTO pokemon_types (pid, tid) VALUES ((SELECT pokemon_id FROM pokemon WHERE name = "Pidgey"), (SELECT type_id FROM types WHERE type_name = "normal"));
INSERT INTO pokemon_types (pid, tid) VALUES ((SELECT pokemon_id FROM pokemon WHERE name = "Pidgey"), (SELECT type_id FROM types WHERE type_name = "flying"));
INSERT INTO pokemon_types (pid, tid) VALUES ((SELECT pokemon_id FROM pokemon WHERE name = "Rattata"), (SELECT type_id FROM types WHERE type_name = "normal"));
INSERT INTO pokemon_types (pid, tid) VALUES ((SELECT pokemon_id FROM pokemon WHERE name = "Spearow"), (SELECT type_id FROM types WHERE type_name = "normal"));
INSERT INTO pokemon_types (pid, tid) VALUES ((SELECT pokemon_id FROM pokemon WHERE name = "Spearow"), (SELECT type_id FROM types WHERE type_name = "flying"));