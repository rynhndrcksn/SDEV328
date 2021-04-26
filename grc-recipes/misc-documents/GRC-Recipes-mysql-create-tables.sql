SET foreign_key_checks = 0;
DROP TABLE IF EXISTS grc_users, grc_recipes, grc_ingredients, grc_food_ingredients, grc_recipe_steps, grc_steps;
SET foreign_key_checks = 1;

CREATE TABLE grc_users (
	id int UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE,
	first varchar(20) NOT NULL,
	last varchar(20) NOT NULL,
	email varchar(50) NOT NULL UNIQUE,
	username varchar(20) NOT NULL UNIQUE,
	password varchar(255) NOT NULL,
	admin bit(1) NOT NULL DEFAULT 0,
	PRIMARY KEY (id)
);

CREATE TABLE grc_recipes (
	id int UNSIGNED NOT NULL AUTO_INCREMENT,
	name varchar(64) NOT NULL,
	author varchar(20) NOT NULL,
	approved bit(1) NOT NULL DEFAULT 0,
	PRIMARY KEY (id)
);

CREATE TABLE grc_ingredients (
	id int UNSIGNED NOT NULL AUTO_INCREMENT,
	ingredient varchar(40) NOT NULL UNIQUE,
	PRIMARY KEY (id)
);

CREATE TABLE grc_food_ingredients (
	recipe int UNSIGNED NOT NULL,
	ingredient int UNSIGNED NOT NULL,
	measurement double NOT NULL,
	units varchar(10) NOT NULL
);

CREATE TABLE grc_recipe_steps (
	recipe int UNSIGNED NOT NULL,
	step int UNSIGNED NOT NULL,
	`order` tinyint UNSIGNED NOT NULL
);

CREATE TABLE grc_steps (
	id int UNSIGNED NOT NULL AUTO_INCREMENT,
	step varchar(128) NOT NULL,
	PRIMARY KEY (id)
);

ALTER TABLE grc_recipes ADD CONSTRAINT grc_recipes_fk0 FOREIGN KEY (author) REFERENCES grc_users(username);

ALTER TABLE grc_food_ingredients ADD CONSTRAINT grc_food_ingredients_fk0 FOREIGN KEY (recipe) REFERENCES grc_recipes(id);

ALTER TABLE grc_food_ingredients ADD CONSTRAINT grc_food_ingredients_fk1 FOREIGN KEY (ingredient) REFERENCES grc_ingredients(id);

ALTER TABLE grc_recipe_steps ADD CONSTRAINT grc_recipe_steps_fk0 FOREIGN KEY (recipe) REFERENCES grc_recipes(id);

ALTER TABLE grc_recipe_steps ADD CONSTRAINT grc_recipe_steps_fk1 FOREIGN KEY (step) REFERENCES grc_steps(id);
