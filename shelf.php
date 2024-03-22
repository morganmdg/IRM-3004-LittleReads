<?php

/**
 * shelf.php
 * This file handles user sign-up and sign-in functionality.
 *
 * @author Jacob Abraham
 * @version 1.0
 * @date March 22, 2024
 */

// Start the session
session_start();

// Check if user_id is set in the session
if (isset($_SESSION['user_id'])) {
    // Output opening div tag for shelf-id
    echo "<div class='shelfbooks' id='shelf-id'>";

    // Fetch current user's shelved books
    $shelvedBooks = fetchUserShelvedBooks($_SESSION['user_id']);

    // Check if there are shelved books for the user
    if (!empty($shelvedBooks)) {
        // Display each unique shelved book
        foreach ($shelvedBooks as $bookID) {
            // Fetch book information from the "book" table based on the book ID
            $bookInfo = fetchBookInfo($bookID);

            // Display book details
            echo '<div class="book">';
            echo '<img src="' . $bookInfo['ImageLink'] . '" alt="' . $bookInfo['Title'] . '">';

            // Add a remove button for each book
            echo '<form action="remove_book.php" method="post">';
            echo '<input type="hidden" name="bookID" value="' . $bookID . '">';
            echo '<button type="submit" class="remove-btn">Remove</button>';
            echo '</form>';

            echo '</div>';
        }
    } else {
        // No books shelved for the user
        echo '<p>No books shelved yet.</p>';
    }

    // Output closing div tag for shelf-id
    echo "</div>";
} else {
    // Session user_id is not set, handle accordingly
    echo "User ID not set in session.";
}

// Function to fetch current user's shelved books
function fetchUserShelvedBooks($userID)
{
    // Database connection
    $servername = "localhost";
    $username = "pma";
    $password = "";
    $dbname = "test";

    // Create connection
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
function fetchBookInfo($bookID)
{
    // Database connection
    $servername = "localhost";
    $username = "pma";
    $password = "";
    $dbname = "test";

    // Create connection
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
