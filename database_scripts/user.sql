DROP TABLE IF EXISTS user;

CREATE TABLE user(
    id int not null primary key auto_increment,
    name varchar(60) not null,
    email varchar(100) not null unique,
    password varchar(80) not null,
    data_inclusao timestamp not null DEFAULT current_timestamp()
);