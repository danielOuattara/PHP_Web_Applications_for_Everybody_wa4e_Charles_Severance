
-- https://en.wikipedia.org/wiki/Database_normalization

CREATE DATABASE IF NOT EXISTS wa4e_music  DEFAULT CHARACTER SET  utf8;

USE wa4e_music;

CREATE TABLE IF NOT EXISTS
  Artist (
    artist_id INTEGER NOT NULL AUTO_INCREMENT,
    name VARCHAR(255),
    PRIMARY KEY (artist_id)
  ) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS
  Album (
    album_id INTEGER NOT NULL AUTO_INCREMENT,
    title VARCHAR(255),
    artist_id INTEGER,
    PRIMARY KEY (album_id),
    INDEX USING BTREE (title),
    CONSTRAINT FOREIGN KEY (artist_id) REFERENCES Artist (artist_id) ON DELETE CASCADE ON UPDATE CASCADE
  ) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS
  Genre (
    genre_id INTEGER NOT NULL AUTO_INCREMENT,
    name VARCHAR(255),
    PRIMARY KEY (genre_id),
    INDEX USING BTREE (name)
  ) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS
  Track (
    track_id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    len INTEGER,
    rating INTEGER,
    count INTEGER,
    album_id INTEGER,
    genre_id INTEGER,
    INDEX USING BTREE (title),
    CONSTRAINT FOREIGN KEY (album_id) REFERENCES Album (album_id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (genre_id) REFERENCES Genre (genre_id) ON DELETE CASCADE ON UPDATE CASCADE
  ) ENGINE = InnoDB;

INSERT INTO
  Artist (name)
VALUES
  ('Led Zepplin'),
  ('AC/DC');

INSERT INTO
  Genre (name)
VALUES
  ('Rock'),
  ('Metal');

INSERT INTO
  Album (title, artist_id)
VALUES
  ('Who Made Who', 2),
  ('IV', 1);

INSERT INTO
  Track (title, rating, len, count, album_id, genre_id)
VALUES
  ('Black Dog', 5, 297, 0, 2, 1),
  ('Stairway', 5, 482, 0, 2, 1),
  ('About to Rock', 5, 313, 0, 1, 2),
  ('Who Made Who', 5, 207, 0, 1, 2);



-- JOINS Video 4

SELECT
  Album.title,
  Artist.name
FROM
  Album
  JOIN Artist ON Album.artist_id = Artist.artist_id;

-- ---

SELECT
  Album.title,
  Album.artist_id,
  Artist.artist_id,
  Artist.name
FROM
  Album
  JOIN Artist ON Album.artist_id = Artist.artist_id;

-- ---

SELECT
  Track.title,
  Track.genre_id,
  Genre.genre_id,
  Genre.name
FROM
  Track
  JOIN Genre;

-- ---

SELECT
  Track.title,
  Genre.name
FROM
  Track
  JOIN Genre ON Track.genre_id = Genre.genre_id;

-- ---

SELECT
  Track.title,
  Artist.name,
  Album.title,
  Genre.name
FROM
  Track
  JOIN Genre
  JOIN Album
  JOIN Artist ON Track.genre_id = Genre.genre_id
  AND Track.album_id = Album.album_id
  AND Album.artist_id = Artist.artist_id;


  -- Cascade Actions

  DELETE FROM Genre WHERE name = 'Metal'