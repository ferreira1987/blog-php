DROP DATABASE IF EXISTS blog;
CREATE DATABASE blog CHARACTER SET utf8 COLLATE utf8_general_ci;

use blog;

DROP TABLE IF EXISTS user;
CREATE TABLE user(
    id int not null primary key auto_increment,
    name varchar(60) not null,
    email varchar(100) not null unique,
    password varchar(80) not null,
    data_inclusao timestamp not null DEFAULT current_timestamp()
);


DROP TABLE IF EXISTS post;
CREATE TABLE post(
    id int not null primary key auto_increment,
    user_id int not null,
    titulo varchar(100) not null,
    descricao text not null,
    data_inclusao timestamp not null DEFAULT current_timestamp(),
    CONSTRAINT user_post FOREIGN KEY (user_id) REFERENCES user(id) ON UPDATE CASCADE ON DELETE RESTRICT
);

DROP TABLE IF EXISTS comments;
CREATE TABLE comments(
    id int not null primary key auto_increment,
    user_id int not null,
    post_id int not null,
    comment text not null,
    data_inclusao timestamp not null DEFAULT current_timestamp(),
    CONSTRAINT user_comment FOREIGN KEY (user_id) REFERENCES user(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT post_comment FOREIGN KEY (post_id) REFERENCES post(id) ON UPDATE CASCADE ON DELETE CASCADE
);