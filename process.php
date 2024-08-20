<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact_form";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $inquiry = $_POST['inquiry'];
    $contact = $_POST['contact'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, inquiry, contact) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $inquiry, $contact);

    // Execute and provide feedback
    if ($stmt->execute()) {
        echo "<script>
        alert('New record created successfully. We will contact you immediately.');
        window.location.href = 'contactform.html';
      </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>
