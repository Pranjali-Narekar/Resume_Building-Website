CREATE DATABASE `login-register`;
USE `login-register`;

CREATE TABLE users(
id INT(11) AUTO_INCREMENT PRIMARY KEY,
full_name VARCHAR(255),
email VARCHAR(255),
password VARCHAR(255)
);

CREATE TABLE resumes(
id INT(11) AUTO_INCREMENT PRIMARY KEY,
user_email VARCHAR(100),
full_name VARCHAR(100),
phone VARCHAR(20),
summary TEXT,
skills TEXT,
education TEXT,
projects TEXT,
template INT(11)
);

ALTER TABLE resumes 
ADD created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE resumes ADD updated_at DATETIME NULL;

DELETE FROM resumes WHERE id NOT IN (
  SELECT * FROM (
    SELECT MAX(id) FROM resumes GROUP BY user_email
  ) as temp
);