create database messageboard;
CREATE TABLE messageboard.messages (
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    message_title VARCHAR(100),
    message VARCHAR(100),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    link VARCHAR(100)
);