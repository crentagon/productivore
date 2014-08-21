CREATE DATABASE productivore_db;

CREATE SEQUENCE achievements_seq;
CREATE TABLE achievements (
  achievement_id INTEGER DEFAULT NEXTVAL('achievements_seq'::regclass) PRIMARY KEY,
  achievement_name VARCHAR(64) DEFAULT NULL,
  achievement_condition VARCHAR(256) DEFAULT NULL,
  achievement_rewards INTEGER DEFAULT 100,
  user_id INTEGER DEFAULT NULL,
  is_completed INTEGER DEFAULT 0,
  completed_on TIMESTAMP DEFAULT NULL,
  inserted_on TIMESTAMP DEFAULT NULL
);

CREATE SEQUENCE applings_seq;
CREATE TABLE  applings (
  appling_id INTEGER DEFAULT NEXTVAL('applings_seq'::regclass) PRIMARY KEY,
  appling_name VARCHAR(32) NOT NULL,
  appling_url VARCHAR(16) NOT NULL,
  appling_message VARCHAR(128) DEFAULT NULL,
  appling_image VARCHAR(16) DEFAULT NULL,
  description VARCHAR(128) DEFAULT NULL,
  createdon TIMESTAMP NOT NULL
);

INSERT INTO applings (appling_id, appling_name, appling_url, appling_message, appling_image, description, createdon) VALUES
(0, 'Productivore', 'site', NULL, NULL, 'The sidebar', '2014-04-25 10:05:52'),
(1, 'Task List', 'tasks', '[FIELD] tasks completed today.', 'tasks', 'Manage your to-do.', '2014-04-17 20:33:44'),
(2, 'Event Planner', 'events', 'You have [FIELD] events this week.', 'calendar', 'Organize your life.', '2014-04-17 20:33:44'),
(3, 'Budget Tracker', 'budget', 'You''ve spent [FIELD] so far today.', 'money', 'Know how your money flows.', '2014-04-17 20:33:44'),
(4, 'You', 'you', NULL, 'trophy', 'It''s all about you.', '2014-04-17 20:33:44');

CREATE OR REPLACE FUNCTION tf_add_userapplings() RETURNS TRIGGER AS
$$
BEGIN
	INSERT INTO user_appling_maps (user_id, appling_id)
	SELECT user_id, NEW.appling_id FROM users;
END;
$$
LANGUAGE PLPGSQL;

CREATE TRIGGER trg_add_userapplings AFTER INSERT ON applings FOR EACH ROW EXECUTE PROCEDURE tf_add_userapplings();

CREATE SEQUENCE menus_seq;
CREATE TABLE menus (
  menu_id INTEGER DEFAULT NEXTVAL('menus_seq'::regclass) PRIMARY KEY,
  menu_name VARCHAR(64) NOT NULL,
  menu_url VARCHAR(32) NOT NULL,
  appling_id INTEGER DEFAULT NULL,
  parent_menu_id INTEGER DEFAULT NULL
);

INSERT INTO menus (menu_id, menu_name, menu_url, appling_id, parent_menu_id) VALUES
(1, 'Home', 'index', 0, NULL),
(2, 'Appling Manager', 'applings', 0, NULL),
(3, 'Achievements', 'achievements', 4, NULL),
(4, 'Anticipate', 'anticipate', 4, NULL),
(5, 'Lessons', 'lessons', 4, NULL),
(6, 'My Profile', 'selfdiscovery', 4, NULL);

CREATE SEQUENCE settings_seq;
CREATE TABLE settings (
  setting_id INTEGER DEFAULT NEXTVAL('settings_seq'::regclass) PRIMARY KEY,
  user_appling_map_id INTEGER DEFAULT NULL,
  setting_field_setting_value_map_id INTEGER DEFAULT NULL,
  setting_field_id INTEGER DEFAULT NULL
);

INSERT INTO settings (setting_id, user_appling_map_id, setting_field_setting_value_map_id, setting_field_id) VALUES
(1, 1, 6, 1),
(2, 1, 5, 2),
(4, 8, 1, 1),
(5, 8, 5, 2),
(7, 15, 1, 1),
(8, 15, 4, 2),
(9, 5, 7, 3),
(10, 12, 7, 3),
(11, 19, 7, 3);

CREATE SEQUENCE setting_fields_seq;
CREATE TABLE setting_fields (
  setting_field_id INTEGER DEFAULT NEXTVAL('settings_seq'::regclass) PRIMARY KEY,
  setting_field_name VARCHAR(128) NOT NULL,
  appling_id INTEGER DEFAULT NULL
);

INSERT INTO setting_fields (setting_field_id, setting_field_name, appling_id) VALUES
(1, 'Order by', 0),
(2, 'View by', 0),
(3, 'Order by', 4);

CREATE SEQUENCE setting_field_setting_value_maps_seq;
CREATE TABLE  setting_field_setting_value_maps (
  setting_field_setting_value_map_id INTEGER DEFAULT NEXTVAL('setting_field_setting_value_maps_seq'::regclass) PRIMARY KEY,
  appling_id INTEGER DEFAULT NULL,
  setting_field_id INTEGER DEFAULT NULL,
  setting_value_id INTEGER DEFAULT NULL,
  is_default INTEGER DEFAULT '0'
);

INSERT INTO setting_field_setting_value_maps (setting_field_setting_value_map_id, appling_id, setting_field_id, setting_value_id, is_default) VALUES
(1, 0, 1, 1, 1),
(2, 0, 1, 2, 0),
(3, 0, 1, 3, 0),
(4, 0, 2, 4, 1),
(5, 0, 2, 5, 0),
(6, 0, 1, 6, 0),
(7, 4, 3, 7, 1),
(8, 4, 3, 8, 0);


CREATE SEQUENCE setting_values_seq;
CREATE TABLE setting_values (
  setting_value_id INTEGER DEFAULT NEXTVAL('setting_values_seq'::regclass) PRIMARY KEY,
  setting_value_name VARCHAR(128) NOT NULL
);

INSERT INTO setting_values (setting_value_id, setting_value_name) VALUES
(1, 'Alphabetical'),
(2, 'Most Used'),
(3, 'Least Used'),
(4, 'List View'),
(5, 'Grid View'),
(6, 'Favorites'),
(7, 'Points'),
(8, 'Title');


CREATE SEQUENCE users_seq;
CREATE TABLE users (
  user_id INTEGER DEFAULT NEXTVAL('users_seq'::regclass) PRIMARY KEY,
  user_name VARCHAR(32) NOT NULL,
  user_email VARCHAR(64) NOT NULL,
  user_password VARCHAR(77) NOT NULL
);

INSERT INTO users (user_id, user_name, user_email, user_password) VALUES
(1, 'crentagon', 'crentagon@gmail.com', 'sha256:1000:yluOkCnJGP6xdMUtwT6/q5MK9Gc16d1f:LzHInQ9CP2RSS5Gw0lh8X9AGAcWXAzo4'),
(2, 'awesomenite', 'ask.awesomenite.dragonite@gmail.com', 'sha256:1000:xqfMjTeDCaB4tFa+TosuhnI2eZX+RUo2:s/DsYdlXLok5fkasZ/0WNRMzBtJVhBP2'),
(3, 'guest001', 'guest001@guest.com', 'sha256:1000:AGdiV3fHWDXw4XRM7vcb/vj9wgiMfLLe:sJzTc40kMhOzifw/7QcqddMAAuUtadej');

CREATE SEQUENCE user_appling_maps_seq;
CREATE TABLE user_appling_maps (
  user_appling_map_id INTEGER DEFAULT NEXTVAL('user_appling_maps_seq'::regclass) PRIMARY KEY,
  user_id INTEGER DEFAULT NULL,
  appling_id INTEGER DEFAULT NULL,
  notification_count INTEGER DEFAULT '0',
  access_count INTEGER DEFAULT '0',
  is_favorite INTEGER DEFAULT '0'
);


INSERT INTO user_appling_maps (user_appling_map_id, user_id, appling_id, notification_count, access_count, is_favorite) VALUES
(1, 1, 0, 0, 0, '0'),
(2, 1, 1, 555, 0, '1'),
(3, 1, 2, 55, 0, '0'),
(4, 1, 3, 5, 0, '0'),
(5, 1, 4, 0, 0, '1'),
(8, 2, 0, 0, 0, '0'),
(9, 2, 1, 0, 0, '0'),
(10, 2, 2, 0, 0, '0'),
(11, 2, 3, 0, 0, '0'),
(12, 2, 4, 0, 0, '0'),
(15, 3, 0, 0, 0, '0'),
(16, 3, 1, 0, 0, '0'),
(17, 3, 2, 0, 0, '0'),
(18, 3, 3, 0, 0, '0'),
(19, 3, 4, 0, 0, '0');
CREATE OR REPLACE FUNCTION tf_add_applingsettings() RETURNS TRIGGER AS
$$
BEGIN
	-- New user must have applings.
	INSERT INTO user_appling_maps (user_id, appling_id)
	SELECT NEW.user_id, appling_id FROM applings;

	-- New user must have default values for settings
	INSERT INTO settings (user_appling_map_id, setting_field_setting_value_map_id, setting_field_id)
	SELECT user_appling_map_id, setting_field_setting_value_map_id, setting_field_id
	FROM setting_field_setting_value_maps
	LEFT JOIN applings USING (appling_id)
	RIGHT JOIN user_appling_maps USING (appling_id)
	WHERE user_id = NEW.user_id AND is_default = 1;
END;
$$
LANGUAGE PLPGSQL;

CREATE TRIGGER trg_add_applingsettings AFTER INSERT ON users FOR EACH ROW EXECUTE PROCEDURE tf_add_applingsettings();

CREATE OR REPLACE FUNCTION trg_add_usersettings() RETURNS TRIGGER AS
$$
BEGIN
	IF NEW.is_default = 1 THEN
		INSERT INTO settings (user_appling_map_id, setting_field_setting_value_map_id, setting_field_id)
		SELECT user_appling_map_id, NEW.setting_field_setting_value_map_id, NEW.setting_field_id
		FROM user_appling_maps
		WHERE appling_id = NEW.appling_id;
	END IF;
END;
$$
LANGUAGE PLPGSQL;

CREATE TRIGGER trg_add_usersettings AFTER INSERT ON setting_field_setting_value_maps FOR EACH ROW EXECUTE PROCEDURE tf_add_applingsettings();

ALTER TABLE achievements
  ADD CONSTRAINT achievements_user_id FOREIGN KEY (user_id) REFERENCES users (user_id) ON DELETE NO ACTION ON UPDATE NO ACTION;
  
ALTER TABLE menus
  ADD CONSTRAINT menus_appling_id_fk FOREIGN KEY (appling_id) REFERENCES applings (appling_id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT menus_menu_id_fk FOREIGN KEY (parent_menu_id) REFERENCES menus (menu_id) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE settings
  ADD CONSTRAINT settings_setting_field_id_fk FOREIGN KEY (setting_field_id) REFERENCES setting_fields (setting_field_id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT settings_setting_field_setting_value_id_fk FOREIGN KEY (setting_field_setting_value_map_id) REFERENCES setting_field_setting_value_maps (setting_field_setting_value_map_id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT settings_user_appling_map_id_fk FOREIGN KEY (user_appling_map_id) REFERENCES user_appling_maps (user_appling_map_id) ON DELETE NO ACTION ON UPDATE NO ACTION;
 
ALTER TABLE setting_fields
  ADD CONSTRAINT setting_fields_appling_id_fk FOREIGN KEY (appling_id) REFERENCES applings (appling_id) ON DELETE NO ACTION ON UPDATE NO ACTION;
  
ALTER TABLE setting_field_setting_value_maps
  ADD CONSTRAINT setting_field_setting_value_map_appling_id_fk FOREIGN KEY (appling_id) REFERENCES applings (appling_id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT setting_field_setting_value_map_setting_field_id_fk FOREIGN KEY (setting_field_id) REFERENCES setting_fields (setting_field_id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT setting_field_setting_value_map_setting_value_id_fk FOREIGN KEY (setting_value_id) REFERENCES setting_values (setting_value_id) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE user_appling_maps
  ADD CONSTRAINT user_appling_maps_appling_id_fk FOREIGN KEY (appling_id) REFERENCES applings (appling_id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT user_appling_maps_user_id_fk FOREIGN KEY (user_id) REFERENCES users (user_id) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE achievements ADD completion_notes VARCHAR(64) NULL;