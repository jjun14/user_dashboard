SELECT * FROM users;
SELECT * FROM messages;
SELECT * FROM comments;
SELECT * FROM users;


SELECT messages.id AS message_id, messages.user_id as user1_id, messages.text AS message_text, concat_ws(' ', user1.first_name, user1.last_name) AS user1_name, TIMESTAMPDIFF(SECOND,messages.created_at, NOW()) AS time_1, comments.id, comments.user_id as user2_id, comments.text AS comment_text, concat_ws(' ', user2.first_name, user2.last_name) as user2_name, TIMESTAMPDIFF(SECOND,comments.created_at, NOW()) AS time_2
              FROM messages
              LEFT JOIN users AS user1 ON user1.id = messages.user_id
              LEFT JOIN comments ON messages.id = comments.message_id
              LEFT JOIN users AS user2 ON comments.user_id = user2.id
              WHERE recipient_id = 16
              ORDER BY messages.id DESC;
