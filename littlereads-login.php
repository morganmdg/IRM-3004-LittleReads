<?php
/** @psalm-suppress all */

/**
 * littlereads-login.php
 * This file handles user sign-up and sign-in functionality.
 * @author Dominic Murphy
 * @version 1.0
 * @date February 27, 2024
 */

// Start session
session_start();

// Database connection
$servername = "localhost"; // Server name
$username = "root"; // Database username
$password = ""; // Database password
$dbname = "test"; // Database name

// Create connection to database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sign Up
if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['signup'])) {
    $username = isset($_POST['username']) ? (string)$_POST['username'] : '';
    $password = isset($_POST['password']) ? (string)$_POST['password'] : '';

    // Check if username already exists
    $check_query = "SELECT * FROM login WHERE username='$username'";
    $result = $conn->query($check_query);

    if ($result && $result->num_rows > 0) {
        echo "Username already exists. Please choose a different one.";
    } else {
        // Insert new user into the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
        $insert_query = "INSERT INTO login (username, password) VALUES ('$username', '$hashed_password')";

        if ($conn->query($insert_query) === true) {
            $_SESSION['user_id'] = $conn->insert_id; // Store the user ID in the session
            echo "Sign up successful! Welcome, $username!";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

// Sign In
if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['signin'])) {
    $username = isset($_POST['username']) ? (string)$_POST['username'] : '';
    $password = isset($_POST['password']) ? (string)$_POST['password'] : '';

    // Check if username exists
    $check_query = "SELECT * FROM login WHERE username='$username'";
    $result = $conn->query($check_query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['user_id']; // Store the user ID in the session
            echo "Welcome back, $username!";
        } else {
            echo "Incorrect password. Please try again.";
        }
    } else {
        echo "Username not found. Please sign up first.";
    }
}

// Close the database connection
$conn->close();