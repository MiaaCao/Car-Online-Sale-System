<?php
include 'connection.php';  // Database connection file

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the car from the database
    $sql = "DELETE FROM cars WHERE carID = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Car deleted successfully.');
                window.location.href = 'manage.php';
              </script>";
    } else {
        echo "<script>
                alert('Error deleting car: " . $conn->error . "');
                window.location.href = 'manage.php';
              </script>";
    }
    $conn->close();
} else {
    echo "<script>
            alert('Invalid request.');
            window.location.href = 'manage.php';
          </script>";
}
?>
