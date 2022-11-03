-- To get started run the following SQL commands:

CREATE DATABASE wa4e_misc_2;
CREATE USER 'fred'@'localhost' IDENTIFIED BY 'zap';
GRANT ALL ON wa4e_misc_2.* TO 'fred'@'localhost';
CREATE USER 'fred'@'127.0.0.1' IDENTIFIED BY 'zap';
GRANT ALL ON wa4e_misc_2.* TO 'fred'@'127.0.0.1';

USE wa4e_misc_2; -- (Or select wa4e_misc_2 in phpMyAdmin)

CREATE TABLE 
  users (
   user_id INTEGER NOT NULL AUTO_INCREMENT,
   name VARCHAR(128),
   email VARCHAR(128),
   password VARCHAR(128),
   INDEX(email)
) ENGINE=InnoDB CHARSET=utf8;



INSERT INTO users (name,email,password) VALUES ('Chuck','csev@umich.edu','123');
INSERT INTO users (name,email,password) VALUES ('Glenn','gg@umich.edu','456');
