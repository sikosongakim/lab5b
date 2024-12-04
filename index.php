<?php include 'auth.php'; include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>User Management</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['user']; ?></h1>
    <a href="logout.php">Logout</a>
    <table>
        <tr>
            <th>Matric</th>
            <th>Name</th>
            <th>Access Level</th>
            <th>Actions</th>
        </tr>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM users");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                <td>{$row['matric']}</td>
                <td>{$row['name']}</td>
                <td>{$row['accessLevel']}</td>
                <td>
                    <a href='update.php?id={$row['id']}'>Update</a>
                    <a href='delete.php?id={$row['id']}' onclick='return confirm(\"Are you sure?\");'>Delete</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>
