UPDATE menus SET menu_name = 'Thought Bubble' WHERE menu_id = 4;
UPDATE menus SET menu_url = 'thoughts' WHERE menu_id = 4;
UPDATE menus SET menu_name = 'UNUSED', appling_id = 0 WHERE menu_id = 6;

UPDATE journal_lists SET name = 'My Thought Bubbles';
INSERT INTO journal_lists (name, user_id, is_last_accessed) VALUES ('Brain Farts', 3, FALSE);
INSERT INTO journal_lists (name, user_id, is_last_accessed) VALUES ('Braingasms', 3, FALSE);

-- Make a trigger such that if a new user signs up, a default list (My Thought Bubbles) is automatically added to the table