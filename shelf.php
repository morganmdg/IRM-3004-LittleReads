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
    // Output shelf content
    displayShelf();
} else {
    // Session user_id is not set, handle accordingly
    echo "User ID not set in session.";
}

// Function to fetch current user's shelved books
function fetchUserShelvedBooks($userID)
{
    // Database connection and query
    // ...

    return $shelvedBooks;
}

// Function to fetch book information from the "book" table based on book ID
function fetchBookInfo($bookID)
{
    // Database connection and query
    // ...
    
    return $bookInfo;
}

// Function to display the user's shelf
function displayShelf() {
    // Fetch current user's shelved books
    $shelvedBooks = fetchUserShelvedBooks($_SESSION['user_id']);

    // Output opening div tag for shelf
    echo "<div class='shelfbooks' id='shelf-id'>";

    // Check if there are shelved books for the user
    if (!empty($shelvedBooks)) {
        // Display each unique shelved book
        foreach ($shelvedBooks as $bookID) {
            displayBook($bookID);
        }
    } else {
        // No books shelved for the user
        echo '<p>No books shelved yet.</p>';
    }

    // Output closing div tag for shelf
    echo "</div>";
}

// Function to display a book on the shelf
function displayBook($bookID) {
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

