-- Function 01:
DROP TYPE t_settingvalues CASCADE;
CREATE TYPE t_settingvalues AS (
	setting_value_id integer,
	setting_value_name varchar
);

CREATE OR REPLACE FUNCTION f_settingvalues_byfieldid(p_fieldid integer) 
RETURNS SETOF t_settingvalues AS 
$$
	SELECT 
		setting_value_id,
		setting_value_name
	FROM setting_field_setting_value_maps
		JOIN setting_values USING (setting_value_id)
		WHERE setting_field_id = $1;
$$
LANGUAGE SQL;

-- Function 02:
CREATE OR REPLACE FUNCTION p_updatesettingvalues(p_userid integer, p_applingid integer, p_fieldid integer, p_valueid integer) 
RETURNS VOID AS 
$$
	UPDATE settings
	SET setting_field_setting_value_map_id = (
		SELECT setting_field_setting_value_map_id
		FROM setting_field_setting_value_maps
		WHERE setting_field_id = $3
		AND setting_value_id = $4
	)
	WHERE settings.setting_field_id = $3
	AND user_appling_map_id IN (
		SELECT user_appling_map_id
		FROM user_appling_maps
		WHERE user_id = $1
		AND appling_id = $2
	)
$$
LANGUAGE SQL;
