CREATE DATABASE wa4e_misc;

-- GRANT ALL ON misc.* TO 'fred'@'localhost' IDENTIFIED BY 'zap';
-- OR :
-- GRANT ALL ON misc.* TO 'fred'@'127.0.0.1' IDENTIFIED BY 'zap';


USE wa4e_misc;

--   (if you are at the command line)
--
--
CREATE TABLE
  users (
    user_id INTEGER NOT NULL AUTO_INCREMENT,
    name VARCHAR(128),
    email VARCHAR(128),
    password VARCHAR(128),
    PRIMARY KEY (user_id),
    INDEX (email)
  ) ENGINE = InnoDB CHARSET = utf8;

--
--
INSERT INTO
  users (name, email, password)
VALUES
  ('Chuck', 'csev@umich.edu', '123');

INSERT INTO
  users (name, email, password)
VALUES
  ('Glenn', 'gg@umich.edu', '456');