DROP DATABASE IF EXISTS wa4e_09_autograder IF EXISTS;

CREATE DATABASE wa4e_09_autograder DEFAULT CHARACTER SET utf8;

USE wa4e_09_autograder;

CREATE TABLE
  Ages (name VARCHAR(128), age INTEGER);

DELETE FROM Ages;

INSERT INTO
  Ages (name, age)
VALUES
  ('Eloise', 18),
  ('Caysey', 36),
  ('Laird', 37),
  ('Shalanna', 36),
  ('Ieuan', 16),
  ('Grzegorz', 18);

SELECT
  sha1(CONCAT(name, age)) AS X
FROM
  Ages
ORDER BY
  X;