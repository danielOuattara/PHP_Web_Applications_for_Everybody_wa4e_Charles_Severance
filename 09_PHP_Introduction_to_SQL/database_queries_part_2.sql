-- 2 cases where to run the following commands: 
-- 1) pur MySQL , using console or any available GUI
-- 2) MySQL(Maria) with XAMPP, through phpMyAdmin

-- connect as root; enter the password when prompted
mysql -u root -p 

-- connect as user 'daniel';  enter the password when prompted
mysql -u daniel -p


DROP TABLE Users;

-- MySQL
CREATE TABLE Users (
  user_id INT UNSIGNED NOT NULL
    AUTO_INCREMENT, 
  name VARCHAR(128), 
  email VARCHAR(128),
  PRIMARY KEY(user_id)
);

DESCRIBE Users;

-- add users: 
INSERT INTO Users (name, email) VALUES ('Chuck', 'csev@umich.edu') ;
INSERT INTO Users (name, email) VALUES ('Sally', 'sally@umich.edu') ;
INSERT INTO Users (name, email) VALUES ('Somesh', 'somesh@umich.edu') ;
INSERT INTO Users (name, email) VALUES ('Caitlin', 'cait@umich.edu') ;
INSERT INTO Users (name, email) VALUES ('Ted', 'ted@umich.edu') ;



-- index and look up
ALTER TABLE Users ADD INDEX ( email ) USING BTREE