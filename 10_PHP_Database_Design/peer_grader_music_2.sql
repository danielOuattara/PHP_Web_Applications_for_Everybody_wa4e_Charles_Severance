CREATE DATABASE IF NOT EXISTS wa4e_10_peer_grader_music DEFAULT CHARACTER
SET
  utf8;

USE wa4e_10_peer_grader_music;

DROP TABLE
  IF EXISTS Artist;

CREATE TABLE
  Artist (
    artist_id INTEGER NOT NULL AUTO_INCREMENT,
    name VARCHAR(255),
    PRIMARY KEY (artist_id)
  ) ENGINE = InnoDB;

DROP TABLE
  IF EXISTS Album;

CREATE TABLE
  Album (
    album_id INTEGER NOT NULL AUTO_INCREMENT,
    title VARCHAR(255),
    artist_id INTEGER,
    PRIMARY KEY (album_id),
    INDEX USING BTREE (title),
    CONSTRAINT FOREIGN KEY (artist_id) REFERENCES Artist (artist_id) ON DELETE CASCADE ON UPDATE CASCADE
  ) ENGINE = InnoDB;

DROP TABLE
  IF EXISTS Genre;

CREATE TABLE
  Genre (
    genre_id INTEGER NOT NULL AUTO_INCREMENT,
    name VARCHAR(255),
    PRIMARY KEY (genre_id),
    INDEX USING BTREE (name)
  ) ENGINE = InnoDB;

DROP TABLE
  IF EXISTS Track;

CREATE TABLE
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
  ('BB KING'), -- artist_id = 1
  ('Rod Stewart'), -- artist_id = 2
  ('Jean Jack Godlman') -- artist_id= 3 ;
;

INSERT INTO
  Genre (name)
VALUES
  ('Blues'), -- genre_id = 1
  ('Rock'), -- genre_id = 2
  ('Variete'), -- genre_id = 3
  ('Metal'), -- genre_id = 4
  ('Folk') -- genre_id = 5
;

INSERT INTO
  Album (title, artist_id)
VALUES
  ('Blues on Top of Blues', 1), -- artist_id = 1
  ('A Night on the Town', 2), -- artist_id = 2
  ('En passant', 3), -- artist_id = 3
  ('Midnight Believer', 1), -- artist_id = 1
  ('Blondes Have More Fun', 2) -- artist_id = 2
;

INSERT INTO
  Track (title, rating, len, count, album_id, genre_id)
VALUES
  -- BB KING 1
  ('That''s Wrong, Little Mama', 5, 139, 1324, 1, 1),
  ('Dance with Me', 4, 202, 1030, 1, 1),
  ('Until I Found You', 3, 203, 730, 1, 1),
  ('Worried Dream', 5, 174, 1133, 1, 1),
  -- BB KING 2
  ('Midnight Believer', 4, 251, 3424, 4, 1),
  ('When It All Comes Down', 3, 254, 724, 4, 1),
  ('Hold On', 5, 250, 1724, 4, 1),
  ('A World Full of Strangers', 4, 263, 1624, 4, 1),
  -- ROD STEWART 1
  ('The First Cut Is the Deepest', 5, 268, 934, 2, 2),
  ('Fall For you', 4, 229, 734, 2, 3),
  ('The Balltrap', 3, 277, 934, 2, 5),
  ('Pretty Flamingo', 5, 207, 934, 2, 3),
  -- ROD STEWART 2nd Album
  ('Da Ya Think I''m Sexy?', 4, 331, 4334, 5, 5),
  ('Dirty Weekend', 3, 156, 734, 5, 2),
  ('Attractive Female Wanted', 5, 257, 934, 5, 3),
  ('Last Summer', 4, 245, 934, 5, 5),
  -- JJ.GOLDMAN 1
  ('Quand Tu Danses', 5, 265, 1213, 3, 2),
  ('Le Coureur', 4, 254, 513, 3, 3),
  ('Nos Mains', 3, 198, 1213, 3, 5),
  ('On ira', 5, 265, 5213, 3, 2);

-- -
-- - JOINS
-- -

SELECT
  Album.title,
  Artist.name
FROM
  Album
  JOIN Artist ON Album.artist_id = Artist.artist_id;

-- -
-- -

SELECT
  Album.title,
  Album.artist_id,
  Artist.artist_id,
  Artist.name
FROM
  Album
  JOIN Artist ON Album.artist_id = Artist.artist_id;

-- -
-- -

SELECT
  Track.title,
  Track.genre_id,
  Genre.genre_id,
  Genre.name
FROM
  Track
  JOIN Genre;

-- -
-- -

SELECT
  Track.title,
  Genre.name
FROM
  Track
  JOIN Genre ON Track.genre_id = Genre.genre_id;

-- -
-- -

SELECT
  Track.title,
  Track.rating,
  Track.len as 'length (seconds)',
  Track.count,
  Genre.name ,
  Artist.name,
  Album.title
FROM
  Track
  JOIN Genre ON Track.genre_id = Genre.genre_id
  JOIN Album ON Track.album_id = Album.album_id
  JOIN Artist ON Album.artist_id = Artist.artist_id
ORDER BY
  Album.title ASC;

-- -
-- -

SELECT
  Artist.name,
  Genre.name
FROM
  Artist
  JOIN Album ON Artist.artist_id = Album.artist_id
  JOIN Track ON Album.album_id = Track.album_id
  JOIN Genre ON Track.genre_id = Genre.genre_id
ORDER BY
  Genre.name ASC;

-- -
-- all of the genres for a particular artist. Hint - use JOIN, DISTINCT and WHERE
-- -

SELECT DISTINCT
  Artist.name as 'artist name',
  Genre.name as 'genre name'
FROM
  Artist
  JOIN Album ON Artist.artist_id = Album.artist_id
  JOIN Track ON Album.album_id = Track.album_id
  JOIN Genre ON Track.genre_id = Genre.genre_id
-- WHERE
--   Artist.name = 'BB King'
ORDER BY
  Genre.name ASC;

-- -
-- -

SELECT
  Track.title AS Track,
  Track.rating AS Rating,
  Track.len AS 'Length (seconds)',
  Track.count AS 'Reviews Count',
  Genre.name AS Genre,
  Album.title AS Album,
  Artist.name AS Artist
FROM
  Track
  JOIN Genre ON Track.genre_id = Genre.genre_id
  JOIN Album ON Track.album_id = Album.album_id
  JOIN Artist ON Album.artist_id = Artist.artist_id
ORDER BY
  Album.title ASC;


-- -
-- - Optional question
-- -

SELECT 
  Artist.name,
  Genre.name,
  COUNT(Track.track_id) as 'count'
FROM
  Artist
  JOIN Album ON Artist.artist_id = Album.artist_id
  JOIN Track ON Album.album_id = Track.album_id
  JOIN Genre ON Track.genre_id = Genre.genre_id
  GROUP BY
    Artist.name, 
    Genre.name
;
