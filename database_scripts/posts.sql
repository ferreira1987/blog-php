DROP TABLE IF EXISTS post;

CREATE TABLE post(
    id int not null primary key auto_increment,
    user_id int not null,
    titulo varchar(100) not null,
    descricao text not null,
    data_inclusao timestamp not null DEFAULT current_timestamp(),
    CONSTRAINT user_post FOREIGN KEY (user_id) REFERENCES user(id) ON UPDATE CASCADE ON DELETE RESTRICT
);