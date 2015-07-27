CREATE TABLE tbl_lookup
(
        id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(128) NOT NULL,
        code INTEGER NOT NULL,
        type VARCHAR(128) NOT NULL,
        position INTEGER NOT NULL
);

CREATE TABLE tbl_user
(
        id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(128) NOT NULL,
        password VARCHAR(128) NOT NULL,
        salt VARCHAR(128) NOT NULL,
        email VARCHAR(128) NOT NULL,
        profile TEXT
);

CREATE TABLE tbl_post
(
        id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
        title VARCHAR(128) NOT NULL,
        content TEXT NOT NULL,
        tags TEXT,
        status INTEGER NOT NULL,
        create_time INTEGER,
        update_time INTEGER,
        author_id INTEGER NOT NULL,
        CONSTRAINT FK_post_author FOREIGN KEY (author_id)
                REFERENCES tbl_user (id) ON DELETE CASCADE ON UPDATE RESTRICT
);

CREATE TABLE tbl_comment
(
        id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
        content TEXT NOT NULL,
        status INTEGER NOT NULL,
        create_time INTEGER,
        author VARCHAR(128) NOT NULL,
        email VARCHAR(128) NOT NULL,
        url VARCHAR(128),
        post_id INTEGER NOT NULL,
        CONSTRAINT FK_comment_post FOREIGN KEY (post_id)
                REFERENCES tbl_post (id) ON DELETE CASCADE ON UPDATE RESTRICT
);

CREATE TABLE tbl_tag
(
        id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(128) NOT NULL,
        frequency INTEGER DEFAULT 1
);

INSERT INTO tbl_lookup (name, type, code, position) VALUES ('Draft', 'PostStatus', 1, 1);
INSERT INTO tbl_lookup (name, type, code, position) VALUES ('Published', 'PostStatus', 2, 2);
INSERT INTO tbl_lookup (name, type, code, position) VALUES ('Archived', 'PostStatus', 3, 3);
INSERT INTO tbl_lookup (name, type, code, position) VALUES ('Pending Approval', 'CommentStatus', 1, 1);
INSERT INTO tbl_lookup (name, type, code, position) VALUES ('Approved', 'CommentStatus', 2, 2);

