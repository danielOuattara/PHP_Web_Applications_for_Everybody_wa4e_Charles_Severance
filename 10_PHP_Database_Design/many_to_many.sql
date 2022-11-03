CREATE TABLE
  User (
    user_id INTEGER NOT NULL AUTO_INCREMENT,
    email VARCHAR(128) UNIQUE,
    name VARCHAR(128),
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
    CONSTRAINT FOREIGN KEY (user_id) REFERENCES User (user_id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (course_id) REFERENCES Course (course_id) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY (user_id, course_id)
  ) ENGINE = InnoDB CHARACTER
SET
  = utf8;

--
-- insert Users
INSERT INTO
  User (name, email)
VALUES
  ('Jane', 'jane@tsugi.org'),
  ('Ed', 'ed@tsugi.org'),
  ('Sue', 'sue@tsugi.org');

--
-- insert courses
INSERT INTO
  Course (title)
VALUES
  ('Python'),
  ('SQL'),
  ('PHP');

--
-- insert into Members
INSERT INTO
  Member (user_id, course_id, role)
VALUES
  (1, 1, 1),
  (2, 1, 0),
  (3, 1, 0),
  (1, 2, 0),
  (2, 2, 1),
  (2, 3, 1),
  (3, 3, 0);

--
-- JOINNING THROUGH MEMBER (junction table)
--
SELECT
  User.name,
  Member.role,
  Course.title
FROM
  User
  JOIN Member
  JOIN Course ON Member.user_id = User.user_id
  AND Member.course_id = Course.course_id
ORDER BY
  Course.title,
  Member.role DESC,
  User.name