CREATE TABLE guestbook (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    email VARCHAR(32) NOT NULL,
    comment TEXT NULL,
    created DATETIME NOT NULL
);
 
CREATE INDEX "id" ON "guestbook" ("id");

INSERT INTO guestbook (email, comment, created) VALUES
    ('ralph.schindler@zend.com','Hello! Hope you enjoy this sample zf application!', DATETIME('NOW'));
INSERT INTO guestbook (email, comment, created) VALUES
    ('foo@bar.com', 'Baz baz baz, baz baz Baz baz baz - baz baz baz.', DATETIME('NOW'));


