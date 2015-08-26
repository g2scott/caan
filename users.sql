\USE caan_database

CREATE TABLE users
(
email VARCHAR(50) NOT NULL UNIQUE,
user_name VARCHAR(50) NOT NULL,
id INTEGER AUTO_INCREMENT,
first VARCHAR(50),
last VARCHAR(50),
password CHAR(40) NOT NULL,
salt INTEGER NOT NULL,
img_path VARCHAR(200),
about_me_text VARCHAR(50),
following VARCHAR(50),
PRIMARY KEY(id)
);
