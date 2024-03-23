<?php

/**
 * shelf.php
 * This file handles the books showing up on the profile page
 *
 * @author Jacob Abraham & Dominic Murphy
 * @version 1.0
 * @date March 22, 2024
 */

// Start PHP session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Function to establish a database connection
function connectToDatabase() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

// Function to fetch current user's shelved books
function fetchUserShelvedBooks(mysqli $conn, string $userID): array
{
    // Fetch shelved books
    $sql = "SELECT Shelved FROM myshelf WHERE UserID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    $shelvedBooks = [];
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $shelvedBooks = explode('-', $row['Shelved']);
        $shelvedBooks = array_unique($shelvedBooks); // Remove duplicates
    }

    return $shelvedBooks;
}

// Function to fetch book information from the "book" table based on ISBN
function fetchBookInfo(mysqli $conn, string $isbn): array
{
    // Fetch book information
    $sql = "SELECT * FROM book WHERE ISBN = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $isbn);
    $stmt->execute();
    $result = $stmt->get_result();

    $bookInfo = [];
    if ($result->num_rows > 0) {
        $bookInfo = $result->fetch_assoc();
    }

    return $bookInfo;
}

echo "<div class='shelfbooks' id='shelf-id'>";
// Check if "user_id" is set and not null
if (isset($_SESSION['user_id']) && $_SESSION['user_id'] !== null) {
    // Establish database connection
    $conn = connectToDatabase();

    // Fetch current user's shelved books
    $shelvedBooks = fetchUserShelvedBooks($conn, $_SESSION['user_id']);

    // Check if there are shelved books for the user
    if (!empty($shelvedBooks)) {
        // Fetch and display each unique shelved book
        foreach ($shelvedBooks as $isbn) {
            // Fetch book information from the "book" table based on ISBN
            $bookInfo = fetchBookInfo($conn, $isbn);

            if (!empty($bookInfo)) {
                // Display book details
                echo '<div class="book">';
                echo '<img src="' . $bookInfo['ImageLink'] . '" alt="' . $bookInfo['Title'] . '">';

                echo '</div>';
            }
        }
    } else {
        // No books shelved for the user
        echo '<p>No books shelved yet.</p>';
    }
    echo "</div>";

    // Close connection
    $conn->close();
} else {
    // Handle case where "user_id" is not set or null
    echo "User ID is not set in the session.";
}
