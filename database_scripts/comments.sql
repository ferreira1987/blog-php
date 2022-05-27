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