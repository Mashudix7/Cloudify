<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Read SQL file
$sqlFile = 'database.sql';
if (file_exists($sqlFile)) {
    $sql = file_get_contents($sqlFile);
    
    // Execute multi query
    if ($conn->multi_query($sql)) {
        do {
            // store first result set
            if ($result = $conn->store_result()) {
                $result->free();
            }
            // print divider
            if ($conn->more_results()) {
                // printf("-----------------\n");
            }
        } while ($conn->next_result());
        echo "Database imported successfully";
    } else {
        echo "Error executing SQL: " . $conn->error;
    }
} else {
    echo "SQL File not found";
}

$conn->close();
?>
