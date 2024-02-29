<?php

/**
 * littlereads-login.php
 * This file handles user sign-up and sign-in functionality.
 * @author Dominic Murphy
 * @version 1.0
 * @date February 27, 2024
 */

// Database connection
$servername = "localhost"; // Server name
$username = "pma"; // Database username
$password = ""; // Database password
$dbname = "test"; // Database name

try {
    // Create connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Sign Up
    if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['signup'])) {
        $username = isset($_POST['username']) ? (is_string($_POST['username']) ? $_POST['username'] : '') : '';
        $password = isset($_POST['password']) ? (is_string($_POST['password']) ? $_POST['password'] : '') : '';

        // Check if username already exists
        $check_query = "SELECT * FROM login WHERE username=:username";
        $stmt = $conn->prepare($check_query);
        $stmt->execute(['username' => $username]);
        $result = $stmt->fetch();

        if ($result) {
            echo "Username already exists. Please choose a different one.";
        } else {
            // Insert new user into the database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
            $insert_query = "INSERT INTO login (username, password) VALUES (:username, :password)";
            $stmt = $conn->prepare($insert_query);
            $stmt->execute(['username' => $username, 'password' => $hashed_password]);

            echo "Sign up successful! Welcome, $username!";
        }
    }

    // Sign In
    if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['signin'])) {
        $username = isset($_POST['username']) ? (is_string($_POST['username']) ? $_POST['username'] : '') : '';
        $password = isset($_POST['password']) ? (is_string($_POST['password']) ? $_POST['password'] : '') : '';

        // Check if username exists
        $check_query = "SELECT * FROM login WHERE username=:username";
        $stmt = $conn->prepare($check_query);
        $stmt->execute(['username' => $username]);
        $result = $stmt->fetch();

        if ($result) {
            if (password_verify($password, $result['password'])) {
                echo "Welcome back, $username!!!";
            } else {
                echo "Incorrect password. Please try again.";
            }
        } else {
            echo "Username not found. Please sign up first.";
        }
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
