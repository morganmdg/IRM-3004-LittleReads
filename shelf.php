<?php

/**
 * littlereads-shelf.php
 * This file handles user sign-up and sign-in functionality.
 *
 * @author Jacob Abraham
 * @version 1.0
 * @date March 22, 2024
 */

// Start the session
session_start();

// Database connection setup
$servername = "localhost";
$username = "pma";
$password = "";
$dbname = "test";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if user_id is set in the session
if (isset($_SESSION['user_id'])) {
    // Output opening div tag for shelf-id
    echo "<div class='shelfbooks' id='shelf-id'>";

    // Fetch current user's shelved books
    $userID = $_SESSION['user_id'];
    $sql = "SELECT Shelved FROM myshelf WHERE UserID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $userID);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if there are shelved books for the user
    if ($result) {
        // Fetch and display each unique shelved book
        $shelvedBooks = array_unique(explode('-', $result['Shelved'])); // Remove duplicates
        foreach ($shelvedBooks as $bookID) {
            // Fetch book information from the "book" table based on the book ID
            $bookInfo = fetchBookInfo($bookID, $conn);

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

// Function to fetch book information from the "book" table based on book ID
function fetchBookInfo($bookID, $conn)
{
    $sql = "SELECT * FROM book WHERE BookID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $bookID);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Close connection
$conn = null;

?>
