-- Function 01: f_settingvalues_byfieldid
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

-- Function 02: p_updatesettingvalues
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

SELECT * FROM p_updatesettingvalues(3, 0, 1, 1);

-- Function 03: f_applinginfo_byapplingid
DROP TYPE t_applinginfo CASCADE;
CREATE TYPE t_applinginfo AS (
	appling_url varchar,
	appling_name varchar
);

CREATE OR REPLACE FUNCTION f_applinginfo_byapplingid(p_applingid integer) 
RETURNS SETOF t_applinginfo AS 
$$
	SELECT appling_url, appling_name
	FROM applings
	WHERE appling_id = $1
$$
LANGUAGE SQL;

-- Function 04: f_menuitems_byapplingid
DROP TYPE t_menuitem CASCADE;
CREATE TYPE t_menuitem AS (
	menu_id integer,
	menu_name varchar,
	menu_url varchar,
	parent_menu_id integer
);

CREATE OR REPLACE FUNCTION f_menuitems_byapplingid(p_applingid integer) 
RETURNS SETOF t_menuitem AS 
$$
	SELECT menu_id, menu_name, menu_url, parent_menu_id
	FROM menus
	WHERE appling_id = $1
$$
LANGUAGE SQL;

-- Function 05, 06, and 07: f_applings_byuserid_*
DROP TYPE t_appling CASCADE;
CREATE TYPE t_appling AS (
	appling_id integer,
	name varchar,
	description varchar,
	url varchar,
	image varchar,
	notifcount integer,
	accesscount integer,
	isfavorite integer,
	message varchar
);

CREATE OR REPLACE FUNCTION f_applings_byuserid_alphabetical(p_userid integer) 
RETURNS SETOF t_appling AS 
$$
	SELECT
		appling_id,
		appling_name as name,
		description,
		appling_url as url,
		appling_image as image,
		notification_count as notifcount,
		access_count as accesscount,
		is_favorite as isfavorite,
		appling_message as message
	FROM
		applings
		JOIN user_appling_maps
		USING (appling_id)
	WHERE
		user_id = $1
	AND appling_id > 0 
	ORDER BY name ASC
$$
LANGUAGE SQL;


CREATE OR REPLACE FUNCTION f_applings_byuserid_accesscount(p_userid integer) 
RETURNS SETOF t_appling AS 
$$
	SELECT
		appling_id,
		appling_name as name,
		description,
		appling_url as url,
		appling_image as image,
		notification_count as notifcount,
		access_count as accesscount,
		is_favorite as isfavorite,
		appling_message as message
	FROM
		applings
		JOIN user_appling_maps
		USING (appling_id)
	WHERE
		user_id = $1
	AND appling_id > 0 
	ORDER BY accesscount ASC
$$
LANGUAGE SQL;


CREATE OR REPLACE FUNCTION f_applings_byuserid_notifcount(p_userid integer) 
RETURNS SETOF t_appling AS 
$$
	SELECT
		appling_id,
		appling_name as name,
		description,
		appling_url as url,
		appling_image as image,
		notification_count as notifcount,
		access_count as accesscount,
		is_favorite as isfavorite,
		appling_message as message
	FROM
		applings
		JOIN user_appling_maps
		USING (appling_id)
	WHERE
		user_id = $1
	AND appling_id > 0 
	ORDER BY notifcount DESC, name ASC
$$
LANGUAGE SQL;


-- Function 07
CREATE OR REPLACE FUNCTION p_setfavorite(p_isfavorite integer, p_userid integer, p_applingid integer) 
RETURNS VOID AS 
$$
	UPDATE user_appling_maps
	SET is_favorite = $1
	WHERE user_id = $2
	AND appling_id = $3
$$
LANGUAGE SQL;

-- Function 08: f_achievementinfo_byuserid

DROP TYPE t_achievementinfo CASCADE;
CREATE TYPE t_achievementinfo AS (
	achievement_id integer,
	achievement_name varchar,
	achievement_condition varchar,
	achievement_rewards integer,
	completion_notes varchar,
	inserted_on timestamp,
	completed_on timestamp
);

CREATE OR REPLACE FUNCTION f_achievementinfo_byuserid(p_userid integer, p_iscompleted integer) 
RETURNS SETOF t_achievementinfo AS 
$$
	SELECT
		achievement_id,
		achievement_name,
		achievement_condition,
		achievement_rewards,
		completion_notes,
		inserted_on,
		completed_on
	FROM
		achievements
	WHERE
		user_id = $1
	AND
		is_completed = $2
	ORDER BY achievement_rewards
$$
LANGUAGE SQL;

-- Function 09: f_thoughtlists_byuserid

DROP TYPE t_thoughtlist CASCADE;
CREATE TYPE t_thoughtlist AS (
	thought_list_id integer,
	name varchar,
	is_last_accessed boolean
);

CREATE OR REPLACE FUNCTION f_thoughtlists_byuserid(p_userid integer) 
RETURNS SETOF t_thoughtlist AS 
$$
	SELECT
		thought_list_id,
		name,
		is_last_accessed
	FROM
		thought_lists
	WHERE
		user_id = $1
	ORDER BY is_last_accessed DESC
$$
LANGUAGE SQL;

-- Function 10: f_thoughtbubbles_byuseridlistid

DROP TYPE t_thoughtbubble CASCADE;
CREATE TYPE t_thoughtbubble AS (
	thought_bubble_id integer,
	title varchar,
	body varchar,
	inserted_on timestamp
);

CREATE OR REPLACE FUNCTION f_thoughtbubbles_byuseridlistid(p_userid integer, p_listid integer) 
RETURNS SETOF t_thoughtbubble AS 
$$
	SELECT
		thought_bubble_id,
		title,
		body,
		inserted_on				
	FROM
		thought_bubbles
	WHERE
		user_id = $1
		AND is_latest_version = TRUE
		AND parent_list_id = $2
		ORDER BY inserted_on DESC LIMIT 10
$$
LANGUAGE SQL;


CREATE OR REPLACE FUNCTION f_thoughtbubbles_byuseridlistidthoughtbubbleid(p_userid integer, p_listid integer, p_thoughtbubbleid integer) 
RETURNS SETOF t_thoughtbubble AS 
$$
	SELECT
		thought_bubble_id,
		title,
		body,
		inserted_on				
	FROM
		thought_bubbles
	WHERE
		user_id = $1
		AND is_latest_version = TRUE
		AND parent_list_id = $2
		AND thought_bubble_id < $3
		ORDER BY inserted_on DESC LIMIT 10
$$
LANGUAGE SQL;

-- Function 11: p_setactivethoughtlist
CREATE OR REPLACE FUNCTION p_setactivethoughtlist(p_userid integer, p_listid integer) 
RETURNS VOID AS 
$$
	UPDATE thought_lists
	SET is_last_accessed = FALSE
	WHERE user_id = $1;

	UPDATE thought_lists
	SET is_last_accessed = TRUE
	AND thought_list_id = $2;
$$
LANGUAGE SQL;

-- Funtion 12: f_settinginfo_byuserid

DROP TYPE t_settinginfo CASCADE;
CREATE TYPE t_settinginfo AS (
	setting_field_id integer,
	setting_field_name varchar,
	setting_value_id integer,
	setting_value_name varchar
);

CREATE OR REPLACE FUNCTION f_settinginfo_byuserid(p_userid integer) 
RETURNS SETOF t_settinginfo AS 
$$
	SELECT
		setting_fields.setting_field_id,
		setting_field_name,
		setting_value_id,
		setting_value_name
	FROM settings
		JOIN setting_field_setting_value_maps USING (setting_field_setting_value_map_id)
		JOIN setting_fields ON setting_field_setting_value_maps.setting_field_id = setting_fields.setting_field_id
		JOIN setting_values USING (setting_value_id)
		JOIN user_appling_maps USING (user_appling_map_id)
	WHERE user_id = $1
		AND user_appling_maps.appling_id = 0
$$
LANGUAGE SQL;