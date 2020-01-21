CREATE TABLE admin(
    username VARCHAR(25) NOT NULL PRIMARY KEY,
    PASSWORD VARCHAR(35) NOT NULL,
    NAME VARCHAR(25) NOT NULL,
    last_name VARCHAR(25) NOT NULL
);

CREATE TABLE article(
    id INT(6) NOT NULL PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    admin_username VARCHAR(25) REFERENCES admin(username),
    creation_date DATETIME,
    banner_link VARCHAR(300),
    content TEXT
);