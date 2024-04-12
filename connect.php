<?php

// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Database connection credentials
$SERVERNAME = "localhost";
$USERNAME = "root";
$PASSWORD = "";
$DBNAME = "contact_form";

// Create connection
$conn = new mysqli($SERVERNAME, $USERNAME, $PASSWORD, $DBNAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO data (name, email, message) VALUES (?, ?, ?)");
    
    if ($stmt === false) {
        die("Error: " . $conn->error);
    }
    
    // Bind parameters
    $stmt->bind_param("sss", $name, $email, $message);
    
    // Execute statement
    $success = $stmt->execute();
    
    if ($success === false) {
        die("Error: " . $stmt->error);
    }
    
    echo "Successfully inserted";
    
    // Close statement
    $stmt->close();
    
    header("Location: success.php");
    exit();
}

// Close connection
$conn->close();

?>
