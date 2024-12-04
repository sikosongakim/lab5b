<?php
include 'auth.php'; // Ensures only logged-in users can access
include 'config.php'; // Database connection

// Step 1: Get the user data to be updated
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the user record from the database
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        die("User not found!");
    }
}

// Step 2: Update the user details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $accessLevel = $_POST['accessLevel'];

    // Update query
    $sql = "UPDATE users SET matric = '$matric', name = '$name', accessLevel = '$accessLevel' WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php"); // Redirect back to index.php after updating
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Update User</title>
</head>
<body>
    <form method="POST" action="update.php">
        <h1>Update User</h1>
        <!-- Hidden field to pass user ID -->
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

        <label>Matric No:</label>
        <input type="text" name="matric" value="<?php echo $user['matric']; ?>" required>

        <label>Name:</label>
        <input type="text" name="name" value="<?php echo $user['name']; ?>" required>

        <label>Access Level:</label>
        <select name="accessLevel" required>
            <option value="Admin" <?php if ($user['accessLevel'] == 'Admin') echo 'selected'; ?>>Admin</option>
            <option value="User" <?php if ($user['accessLevel'] == 'User') echo 'selected'; ?>>User</option>
        </select>

        <button type="submit">Update</button>
    </form>
</body>
</html>
