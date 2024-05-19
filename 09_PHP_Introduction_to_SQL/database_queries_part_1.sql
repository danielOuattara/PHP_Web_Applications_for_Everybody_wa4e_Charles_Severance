-- 2 cases where to run the following commands: 
-- 1) pur MySQL , using console or any available GUI
-- 2) MySQL(Maria) with XAMPP, through phpMyAdmin

-- connect as root; enter the password when prompted
mysql -u root -p 

-- create a user
CREATE USER IF NOT EXISTS 'daniel'@'localhost' IDENTIFIED BY '**Azerty77**';

-- grant in advance all privileges on databases that user 'daniel' could created
GRANT ALL PRIVILEGES ON wa4e_music.* TO 'daniel'@'localhost';
GRANT ALL PRIVILEGES ON wa4e_people.* TO 'daniel'@'localhost';


-- disconnect
quit

-- connect as user 'daniel';  enter the password when prompted
mysql -u daniel -p

-- created the databases:
CREATE DATABASE wa4e_music DEFAULT CHARACTER SET utf8;
CREATE DATABASE wa4e_people DEFAULT CHARACTER SET utf8;


-- connect to `people`database
USE wa4e_people;

-- create talbe Users:
CREATE TABLE Users (
  name VARCHAR(128), 
  email VARCHAR(128)
);


-- confirm Users table created
DESCRIBE Users;

-- add users: 
INSERT INTO Users (name, email) VALUES ('Chuck', 'csev@umich.edu') ;
INSERT INTO Users (name, email) VALUES ('Sally', 'sally@umich.edu') ;
INSERT INTO Users (name, email) VALUES ('Somesh', 'somesh@umich.edu') ;
INSERT INTO Users (name, email) VALUES ('Caitlin', 'cait@umich.edu') ;
INSERT INTO Users (name, email) VALUES ('Ted', 'ted@umich.edu') ;


-- delete one user:
DELETE FROM Users WHERE email='ted@umich.edu';

-- update one user:
UPDATE Users SET name='Charles' WHERE email='csev@umich.edu';

-- simple queries: retrieve records
SELECT * FROM Users;

SELECT * FROM Users WHERE email='csev@umich.edu';

SELECT * FROM Users ORDER BY email;

SELECT * FROM Users WHERE name LIKE '%e%';

SELECT * FROM Users ORDER BY email DESC LIMIT 2;

SELECT * FROM Users ORDER BY email LIMIT 1,2;

SELECT COUNT(*) FROM Users;

SELECT COUNT(*) FROM Users WHERE email='csev@umich.edu';