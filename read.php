<?php
session_start();

if (isset($_SESSION['user'])) {
    // Destroy the session
    session_destroy();
    // Redirect to the login page
    header("Location: login.php");
    exit();
}
include 'Database.php';
include 'User.php';

// Create an instance of the Database class and get the connection
$database = new Database();
$db = $database->getConnection();

// Create an instance of the User class
$user = new User($db);
$result = $user->getUsers();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <style>
        .centered {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-bottom: 20px; /* Adding some space between the greeting and the table */
        }
        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }

        th, td {
            text-align: left;
            padding: 8px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        a {
            color: blue;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .logout-button {
            display: inline-block;
            padding: 8px 16px;
            background-color: #f44336;
            color: white;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            border-radius: 4px;
        }

        .logout-button:hover {
            background-color: #c62828;
        }
    </style>
</head>

<body>
<div class="centered">
        <h1>Hello Nurul Fatihah Binti Mohd Zahari <a href="logout.php" class="logout-button">Logout</a></h1>
    </div>
    <table>
        <tr>
            <th>Matric</th>
            <th>Name</th>
            <th>Level</th>
            <th colspan="2">Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Fetch each row from the result set
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row["matric"]; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["role"]; ?></td>
                    <td><a href="update_form.php?matric=<?php echo $row["matric"]; ?>">Update</a></td>
                    <td><a href="delete.php?matric=<?php echo $row["matric"]; ?>">Delete</a></td>

                </tr>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='3'>No users found</td></tr>";
        }
        // Close connection
        $db->close();
        ?>
    </table>
</body>

</html>