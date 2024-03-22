<?php

// Suppress the warning for this entire file
// phpcs:disable

/**
 * shelf.php
 * This file handles user sign-up and sign-in functionality.
 *
 * @author Jacob Abraham
 * @version 1.0
 * @date March 22, 2024
 */

// Function to establish a database connection
function establishDBConnection(): mysqli {
    // Database credentials
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

    return $conn;
}

// Function to fetch current user's shelved books
function fetchUserShelvedBooks(string $userID): array {
    // Establish database connection
    $conn = establishDBConnection();

    // Fetch shelved books
    // ...

    // Close connection
    $conn->close();

    return $shelvedBooks;
}

// Function to fetch book information from the "book" table based on book ID
function fetchBookInfo(string $bookID): array {
    // Establish database connection
    $conn = establishDBConnection();

    // Fetch book information
    // ...

    // Close connection
    $conn->close();

    return $bookInfo;
}

// Function to generate shelf HTML
function generateShelfHTML(string $userID): string 
{
    $html = '';
    if ($userID) {
        // Output opening div tag for shelf-id
        $html .= "<div class='shelfbooks' id='shelf-id'>";

        // Fetch current user's shelved books
        $shelvedBooks = fetchUserShelvedBooks($userID);

        // Check if there are shelved books for the user
        if (!empty($shelvedBooks)) {
            // Display each unique shelved book
            foreach ($shelvedBooks as $bookID) {
                // Fetch book information from the "book" table based on the book ID
                $bookInfo = fetchBookInfo($bookID);

                // Display book details
                $html .= '<div class="book">';
                $html .= '<img src="' . $bookInfo['ImageLink'] . '" alt="' . $bookInfo['Title'] . '">';

                // Add a remove button for each book
                $html .= '<form action="remove_book.php" method="post">';
                $html .= '<input type="hidden" name="bookID" value="' . $bookID . '">';
                $html .= '<button type="submit" class="remove-btn">Remove</button>';
                $html .= '</form>';

                $html .= '</div>';
            }
        } else {
            // No books shelved for the user
            $html .= '<p>No books shelved yet.</p>';
        }

        // Output closing div tag for shelf-id
        $html .= "</div>";
    } else {
        // Session user_id is not set, handle accordingly
        $html = "User ID not set in session.";
    }

    return $html;
}

// Output the generated shelf HTML
echo generateShelfHTML($_SESSION['user_id']);

