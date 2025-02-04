<?php
include 'config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $organizer_name = $_POST['organizer_name'];

    $query = "INSERT INTO Events (Event_Name, Event_Date, Location, Description, Organizer_Name) 
              VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $event_name, $event_date, $location, $description, $organizer_name);
    
    if ($stmt->execute()) {
        header("Location: events.php");
    } else {
        echo "Error adding event.";
    }
}
?>
