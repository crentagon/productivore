INSERT INTO setting_fields (setting_field_name) VALUES ('ORDER BY'); --Grab the id
INSERT INTO setting_values (setting_value_name) VALUES ('Title'), ('Points'); --Grab the id
INSERT INTO setting_field_setting_value_maps
	(appling_id, setting_field_id, setting_value_id, is_default)
VALUES
	(4, 1, 7, 0),
	(4, 1, 8, 0); --Map the field id to its corresponging value ids.
SELECT * FROM user_applings WHERE appling_id = 4;
INSERT INTO settings --each user = new settings
	(user_appling_map_id, setting_field_setting_value_map_id, setting_field_id)
VALUES
	(5, 8, 1),
	(12, 8, 1),
	(19, 8, 1);
