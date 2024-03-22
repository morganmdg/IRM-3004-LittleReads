<?php

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

        // Display the book information within the desired div
        echo "<div class='description-display-block' id='display-block'>";
        echo "<h1>Title: $title</h1>";
        echo "<p>Author: $author</p>";
        echo "<p>Genres: $genres</p>";
        echo "<p>Language: $language</p>";
        echo "<p>ISBN: $isbn</p>";
        echo "<img src='$imageLink' alt='Book Cover'>";
        echo "</div>";
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