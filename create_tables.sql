-- dialect: postgres

-- Creates a table named Book in the database
CREATE TABLE Book (
    BookID SERIAL PRIMARY KEY,
    Title VARCHAR(255),
    Author VARCHAR(255),
    Genres VARCHAR(255),
    Language VARCHAR(50),
    ISBN VARCHAR(50),
    ImageLink VARCHAR(255)
);

-- Create User table
CREATE TABLE "User" (
    UserID SERIAL PRIMARY KEY,
    UserPicture VARCHAR(255),
    Username VARCHAR(255),
    Password VARCHAR(255),
    Email VARCHAR(255),
    Level VARCHAR(50)
);

-- Create Review table
CREATE TABLE Review (
    ReviewID SERIAL PRIMARY KEY,
    UserID INT,
    ReviewText VARCHAR(255),
    FOREIGN KEY (UserID) REFERENCES "User"(UserID)
);

-- Create Book level table
CREATE TABLE BookLevel (
    BookLevelID SERIAL PRIMARY KEY,
    BookName VARCHAR(255),
    BookDescription VARCHAR(255),
    Genre VARCHAR (50),
    QuantityAvailable VARCHAR(255)
);

-- Create Challenges table
CREATE TABLE Challenge (
    ChallengeID SERIAL PRIMARY KEY,
    ChallengeName VARCHAR(255),
    ChallengeDescription VARCHAR(255),
    ChallengeDifficulty VARCHAR (255)
);

-- Create Friends table
CREATE TABLE Friends (
    FriendID SERIAl PRIMARY KEY,
    FriendPicture VARCHAR(255),
    FriendName VARCHAR(255),
    FOREIGN KEY (BookLevelID) REFERENCES BookLevel(BookLevelID),
    FOREIGN KEY (ChallengeID) REFERENCES Challenge(ChallengeID)
);