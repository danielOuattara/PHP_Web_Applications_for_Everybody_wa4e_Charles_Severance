-- Autograder, Many-to-Many

CREATE DATABASE IF NOT EXISTS wa4e_10_autograder;
USE wa4e_10_autograder;

DROP TABLE
  IF EXISTS Member;

DROP TABLE
  IF EXISTS `User`;

DROP TABLE
  IF EXISTS Course;

CREATE TABLE
  `User` (
    user_id INTEGER NOT NULL AUTO_INCREMENT,
    name VARCHAR(128) UNIQUE,
    PRIMARY KEY (user_id)
  ) ENGINE = InnoDB CHARACTER
SET
  = utf8;

CREATE TABLE
  Course (
    course_id INTEGER NOT NULL AUTO_INCREMENT,
    title VARCHAR(128) UNIQUE,
    PRIMARY KEY (course_id)
  ) ENGINE = InnoDB CHARACTER
SET
  = utf8;

CREATE TABLE
  Member (
    user_id INTEGER,
    course_id INTEGER,
    role INTEGER,
    CONSTRAINT FOREIGN KEY (user_id) REFERENCES `User` (user_id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (course_id) REFERENCES Course (course_id) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY (user_id, course_id)
  ) ENGINE = InnoDB CHARACTER
SET
  = utf8;

/*

DATA TO NORMALIZE


Ronnie, si106, Instructor
Jem, si106, Learner
Kitty, si106, Learner
Luna, si106, Learner
Tayo, si106, Learner
Kaelin, si110, Instructor
Dmitri, si110, Learner
Keera, si110, Learner
Neo, si110, Learner
Oluwafikunayomi, si110, Learner
Uzayr, si206, Instructor
Brett, si206, Learner
Catrin, si206, Learner
Meryem, si206, Learner
Nicole, si206, Learner


--
Ronnie, si106, 1
Jem, si106, 0
Kitty, si106, 0
Luna, si106, 0
Tayo, si106, 0
Kaelin, si110, 1
Dmitri, si110, 0
Keera, si110, 0
Neo, si110, 0
Oluwafikunayomi, si110, 0
Uzayr, si206, 1
Brett, si206, 0
Catrin, si206, 0
Meryem, si206, 0
Nicole, si206, 0



USERS DATA
---------------------------
name                user_id
---------------------------
Ronnie,                   1
Jem,                      2
Kitty,                    3 
Luna,                     4
Tayo,                     5
Kaelin,                   6 
Dmitri,                   7
Keera,                    8
Neo,                      9
Oluwafikunayomi,         10
Uzayr,                   11
Brett,                   12
Catrin,                  13
Meryem,                  14
Nicole,                  15


COURSE DATA
-----------------
title   course_id
-----------------
si106,          1
si110,          2
si206,          3



MEMEBER DATA
---------------
user_id     course_id   role
1             1       1
2             1       0
3             1       0
4             1       0
5             1       0
6             2       1
7             2       0
8             2       0
9             2       0
10             2       0
11             3       1
12             3       0
13             3       0
14             3       0
15             3       0


 */
INSERT INTO
  User (name)
VALUES
  ('Ronnie'),
  ('Jem'),
  ('Kitty'),
  ('Luna'),
  ('Tayo'),
  ('Kaelin'),
  ('Dmitri'),
  ('Keera'),
  ('Neo'),
  ('Oluwafikunayomi'),
  ('Uzayr'),
  ('Brett'),
  ('Catrin'),
  ('Meryem'),
  ('Nicole');

INSERT INTO
  Course (title)
VALUES
  ('si106'),
  ('si110'),
  ('si206');

INSERT INTO
  Member (user_id, course_id, role)
VALUES
  (1, 1, 1),
  (2, 1, 0),
  (3, 1, 0),
  (4, 1, 0),
  (5, 1, 0),
  (6, 2, 1),
  (7, 2, 0),
  (8, 2, 0),
  (9, 2, 0),
  (10, 2, 0),
  (11, 3, 1),
  (12, 3, 0),
  (13, 3, 0),
  (14, 3, 0),
  (15, 3, 0);



SELECT 
  `User`.name, 
  Course.title, 
  Member.role
FROM 
  `User` 
  JOIN Member ON `User`.user_id = Member.user_id
  JOIN Course ON Member.course_id = Course.course_id
ORDER BY 
  Course.title, Member.role DESC, `User`.name