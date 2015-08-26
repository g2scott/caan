USE caan_database

CREATE TABLE videos
(
v_id INTEGER AUTO_INCREMENT,
u_id INTEGER,
name VARCHAR(50),
link VARCHAR(200),
thumbnail VARCHAR(200),
poster_frame VARCHAR(200),
sprout_id INTEGER,
description VARCHAR(50),
type VARCHAR(50),
PRIMARY KEY(v_id)
);
