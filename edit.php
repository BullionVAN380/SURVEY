<?php
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update'])) {
        // Get the new details from the form
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];

        // Update the record in the database
        $updateQuery = "UPDATE `atributes` SET firstname = ?, lastname = ? WHERE email = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("sss", $firstname, $lastname, $email);

        if ($stmt->execute()) {
            
            echo "Record updated successfully.";
            echo "<script> window.location.assign('userdata.php'); </script>";
        } else {
            echo "Error updating record: " . $stmt->error;
        }

        $stmt->close();
    } elseif (isset($_POST['edit'])) {
        $emailToEdit = $_POST['email'];
        // Fetch the current details for the given email
        $selectQuery = "SELECT * FROM `atributes` WHERE email = ?";
        $stmt = $conn->prepare($selectQuery);
        $stmt->bind_param("s", $emailToEdit);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $firstname = $row['firstname'];
                $lastname = $row['lastname'];
                $email = $row['email'];
            } else {
                echo "No record found.";
                exit;
            }
        } else {
            echo "Error: " . $stmt->error;
            exit;
        }
        $stmt->close();
    }
} else {
    echo "Invalid request.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Detail</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <h2>Edit Your Details</h2>
        <form method="post" action="edit.php">
            <input type="hidden" name="email" value="<?php echo $email; ?>">
            <label for="firstname">First Name:</label>
            <input type="text" name="firstname" value="<?php echo $firstname; ?>" required><br>
            <label for="lastname">Last Name:</label>
            <input type="text" name="lastname" value="<?php echo $lastname; ?>" required><br>
            <label for="lastname">Email:</label>
            <input type="text" name="lastname" value="<?php echo $email; ?>" required><br>
            <input type="submit" name="update" value="Update">
        </form>
    </div>
</body>
</html>
