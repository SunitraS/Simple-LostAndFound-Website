<?php
require('conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gather form data
    $name = $_POST["name"];
    $description = $_POST["description"];
    $status = $_POST["status"];
    $typeID = $_POST["type"];

    // File upload handling
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);

    move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);

    // Insert data into LostItems table
    $sql = "INSERT INTO LostItems (Image, Name, Description, Status, TypeID) VALUES ('$targetFile', '$name', '$description', '$status', $typeID)";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Record inserted successfully"); window.location.href = "index.php";</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
