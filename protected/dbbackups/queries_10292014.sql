-- Journal: Lists
CREATE SEQUENCE journal_lists_seq;
CREATE TABLE journal_lists (
	journal_list_id INTEGER DEFAULT NEXTVAL('journal_lists_seq'::regclass) PRIMARY KEY,
	name VARCHAR(64),
	user_id INTEGER,
	is_last_accessed BOOLEAN DEFAULT TRUE
);
ALTER TABLE journal_lists
	ADD CONSTRAINT journal_lists_user_id FOREIGN KEY (user_id) REFERENCES users (user_id) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- Journal: Posts
CREATE SEQUENCE journal_posts_seq;
CREATE TABLE journal_posts (
	journal_post_id INTEGER DEFAULT NEXTVAL('journal_posts_seq'::regclass) PRIMARY KEY,
	title VARCHAR(128),
	body TEXT,
	inserted_on TIMESTAMP,
	is_latest_version BOOLEAN DEFAULT TRUE,
	parent_post_id INTEGER,
	parent_list_id INTEGER,
	user_id INTEGER
);
ALTER TABLE journal_posts
	ADD CONSTRAINT journal_lists_user_id FOREIGN KEY (user_id) REFERENCES users (user_id) ON DELETE NO ACTION ON UPDATE NO ACTION,
	ADD CONSTRAINT journal_lists_parent_list_id FOREIGN KEY (parent_list_id) REFERENCES journal_lists (journal_list_id) ON DELETE NO ACTION ON UPDATE NO ACTION,
	ADD CONSTRAINT journal_lists_parent_post_id FOREIGN KEY (parent_post_id) REFERENCES journal_posts (journal_post_id) ON DELETE NO ACTION ON UPDATE NO ACTION;
	
UPDATE menus SET menu_name = 'Private Journal', menu_url = 'journal' WHERE menu_id = 4;