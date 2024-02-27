-- dialect: postgres

-- Creates a table named Book in the database

-- All code linted from https://online.sqlfluff.com/

CREATE TABLE Book (
    BookID SERIAL PRIMARY KEY,
    Title VARCHAR(255),
    Author VARCHAR(255),
    Genres VARCHAR(255),
    Language VARCHAR(50),
    ISBN VARCHAR(50),
    ImageLink VARCHAR(255)
);
