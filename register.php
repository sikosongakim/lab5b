<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $accessLevel = $_POST['accessLevel'];

    $sql = "INSERT INTO users (matric, name, password, accessLevel) VALUES ('$matric', '$name', '$password', '$accessLevel')";
    if (mysqli_query($conn, $sql)) {
        echo "Registration successful!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>
<body>
    <form method="POST" action="">
        <h1>Register</h1>
        <label>Matric:</label>
        <input type="text" name="matric" required>
        <label>Name:</label>
        <input type="text" name="name" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <label>Access Level:</label>
        <select name="accessLevel" required>
            <option value="Admin">Admin</option>
            <option value="User">User</option>
            <option value="Lecturer">Lecturer</option>
            <option value="Student">Student</option>
        </select>
        <button type="submit">Register</button>
    </form>
</body>
</html>
