<?php
session_start(); // Start the session if not started already

// Description Page PHP
$referring_url = $_SERVER['HTTP_REFERER'];

// Parse the URL to extract parameters
$url_components = parse_url($referring_url);
parse_str($url_components['query'], $params);

if(isset($params['isbn'])) {
    // Get the ISBN from the referring URL
    $isbn = $params['isbn'];

    // Database connection
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

    // Escape ISBN to prevent SQL injection
    $isbn = $conn->real_escape_string($isbn);

    // SQL query to fetch book information
    $sql = "SELECT Title, Author, Genres, Language, ISBN, ImageLink FROM book WHERE ISBN = '$isbn'";
    $result = $conn->query($sql);

    // Check if the book with the provided ISBN exists
    if ($result->num_rows > 0) {
        // Fetch book information
        $book = $result->fetch_assoc();
        // Extract information from the $book array
        $title = $book['Title'];
        $author = $book['Author'];
        $genres = $book['Genres'];
        $language = $book['Language'];
        $isbn = $book['ISBN'];
        $imageLink = $book['ImageLink']; // Extract image link

        // Check if the "Add to Shelf" button is clicked
        if (isset($_POST['add_to_shelf'])) {
            // Check if user_id is set in the session
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];

                // Check if the user exists in myshelf table, if not add them
                $sql_check_user = "SELECT * FROM myshelf WHERE UserID = '$user_id'";
                $result_check_user = $conn->query($sql_check_user);
                if ($result_check_user->num_rows == 0) {
                    $sql_add_user = "INSERT INTO myshelf (UserID) VALUES ('$user_id')";
                    $conn->query($sql_add_user);
                }

                // Check if the user's shelf is full
                $sql_get_number_shelved = "SELECT NumberShelved FROM myshelf WHERE UserID = '$user_id'";
                $result_get_number_shelved = $conn->query($sql_get_number_shelved);
                
                if ($result_get_number_shelved->num_rows > 0) {
                    $row = $result_get_number_shelved->fetch_assoc();
                    $number_shelved = $row['NumberShelved'];

                    if ($number_shelved >= 15) {
                        echo "Your shelf is full.";
                    } else {
                        // Increment the NumberShelved value
                        $number_shelved++;
                        $sql_update_number_shelved = "UPDATE myshelf SET NumberShelved = $number_shelved WHERE UserID = '$user_id'";
                        $conn->query($sql_update_number_shelved);

                        // Check if the book is already on the shelf
                        $sql_get_shelf = "SELECT Shelved FROM myshelf WHERE UserID = '$user_id'";
                        $result_get_shelf = $conn->query($sql_get_shelf);

                        if ($result_get_shelf->num_rows > 0) {
                            $row = $result_get_shelf->fetch_assoc();
                            $shelved = $row['Shelved'];

                            // Check if the book is already on the shelf
                            if (strpos($shelved, $isbn) !== false) {
                                echo "This book is already on your shelf.";
                            } else {
                                // Append "-" to the ISBN and update the shelf
                                $isbn_shelved = $shelved . $isbn . "-";
                                $sql_update_shelf = "UPDATE myshelf SET Shelved = '$isbn_shelved' WHERE UserID = '$user_id'";
                                if ($conn->query($sql_update_shelf) === TRUE) {
                                    echo "Book added to shelf successfully!";
                                } else {
                                    echo "Error adding book to shelf: " . $conn->error;
                                }
                            }
                        } else {
                            // If the shelf is empty, add the ISBN directly
                            $isbn_shelved = $isbn . "-";
                            $sql_add_to_shelf = "INSERT INTO myshelf (UserID, Shelved) VALUES ('$user_id', '$isbn_shelved')";
                            if ($conn->query($sql_add_to_shelf) === TRUE) {
                                echo "Book added to shelf successfully!";
                            } else {
                                echo "Error adding book to shelf: " . $conn->error;
                            }
                        }
                    }
                } else {
                    echo "Error retrieving NumberShelved value for user.";
                }
            } else {
                echo "User ID not found in session";
            }
        } else {
            // Display the book information within the desired div
            echo "<div class='description-display-block' id='display-block'>";
            echo "<h1>Title: $title</h1>";
            echo "<p>Author: $author</p>";
            echo "<p>Genres: $genres</p>";
            echo "<p>Language: $language</p>";
            echo "<p>ISBN: $isbn</p>";
            echo "<img src='$imageLink' alt='Book Cover'>";
            echo "</div>";
        }
    } else {
        // If no book found, show a message
        echo "No book found with ISBN: " . $isbn;
    }

    // Close connection
    $conn->close();
} else {
    // If no ISBN provided, show a message
    echo "No ISBN provided";
}