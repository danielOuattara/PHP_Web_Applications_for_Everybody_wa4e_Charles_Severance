-- Starting Mysql with MAMP (Macintosh):

-- /Applications/MAMP/Library/bin/mysql -u root -p  (enter root when prompted)

-- Starting MySql with XAMPP (Windows):

-- c:\xampp\mysql\bin\mysql.exe -u root -p

-- Starting MySQL in linux:

-- mysql -u root -p

CREATE DATABASE People DEFAULT CHARACTER SET utf8;

USE People; -- (Command line only)

CREATE TABLE Users (
  name VARCHAR(128), 
  email VARCHAR(128)
);

DESCRIBE Users;

INSERT INTO Users (name, email) VALUES ('Chuck', 'csev@umich.edu') ;
INSERT INTO Users (name, email) VALUES ('Sally', 'sally@umich.edu') ;
INSERT INTO Users (name, email) VALUES ('Somesh', 'somesh@umich.edu') ;
INSERT INTO Users (name, email) VALUES ('Caitlin', 'cait@umich.edu') ;
INSERT INTO Users (name, email) VALUES ('Ted', 'ted@umich.edu') ;

DELETE FROM Users WHERE email='ted@umich.edu';

UPDATE Users SET name='Charles' WHERE email='csev@umich.edu';

SELECT * FROM Users;

SELECT * FROM Users WHERE email='csev@umich.edu';

SELECT * FROM Users ORDER BY email;

SELECT * FROM Users WHERE name LIKE '%e%';

SELECT * FROM Users ORDER BY email DESC LIMIT 2;

SELECT * FROM Users ORDER BY email LIMIT 1,2;

CREATE TABLE Users (
  user_id INT UNSIGNED NOT NULL AUTO_INCREMENT, 
  name VARCHAR(128), 
  email VARCHAR(128),
  PRIMARY KEY(user_id),
  INDEX ( name )
);

-- To add the index after the table was created:

ALTER TABLE Users ADD INDEX ( name );

INSERT INTO Users (name, email) VALUES ('Chuck', 'csev@umich.edu') ;
INSERT INTO Users (name, email) VALUES ('Sally', 'sally@umich.edu') ;
INSERT INTO Users (name, email) VALUES ('Somesh', 'somesh@umich.edu') ;
INSERT INTO Users (name, email) VALUES ('Caitlin', 'cait@umich.edu') ;
INSERT INTO Users (name, email) VALUES ('Ted', 'ted@umich.edu') ;
