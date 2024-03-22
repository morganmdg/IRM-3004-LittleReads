<?php

/**
 * littlereads-search.php
 * This file handles user sign-up and sign-in functionality.
 *
 * @author Dominic Murphy
 * @version 1.0
 * @date March 22, 2024
 */

// Function to fetch current user's shelved books
/**
 * @param int|string $userID
 * @return array<int, string>
 */
function fetchUserShelvedBooks($userID)
{
    // Database connection
    $servername = "localhost";
    $username = "pma";
    $password = "";
    $dbname = "test";

    // Create connection
    /** @psalm-suppress UndefinedClass */
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch shelved books
    $sql = "SELECT Shelved FROM myshelf WHERE UserID = '$userID'";
    $result = $conn->query($sql);

    $shelvedBooks = [];
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $shelvedBooks = explode('-', $row['Shelved']);
        $shelvedBooks = array_unique($shelvedBooks); // Remove duplicates
    }

    // Close connection
    $conn->close();

    return $shelvedBooks;
}

// Function to fetch book information from the "book" table based on book ID
/**
 * @param int|string $bookID
 * @return array<string,mixed>
 */
function fetchBookInfo($bookID)
{
    // Database connection
    $servername = "localhost";
    $username = "pma";
    $password = "";
    $dbname = "test";

    // Create connection
    /** @psalm-suppress UndefinedClass */
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch book information
    $sql = "SELECT * FROM book WHERE BookID = '$bookID'";
    $result = $conn->query($sql);

    $bookInfo = [];
    if ($result->num_rows > 0) {
        $bookInfo = $result->fetch_assoc();
    }

    // Close connection
    $conn->close();

    return $bookInfo;
}

?>