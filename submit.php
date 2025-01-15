<?php
// Database connection details
$host = "localhost";
$dbname = "hungry_bird";
$username = "root";
$password = "";

// Connect to the database
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $type = htmlspecialchars($_POST['type']);
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $location = htmlspecialchars($_POST['location']);
  
    $additional_details = htmlspecialchars($_POST['additional_details']);

    // Insert data into the database
    try {
        $sql = "INSERT INTO users ( type, name, email, location, additional_details) VALUES (:type, :name, :email, :location, :additional_details)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':type' => $type,
            ':name' => $name,
            ':email' => $email,
            ':location' => $location,
            ':additional_details' => $additional_details
        ]);

        echo "<h1>Thank you, $name, for joining us!</h1>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
