<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Delete User - Website ni Peruda</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="inc/styles.css">
</head>
<body>
    <?php include 'inc/header.php'; ?>
    <?php include 'inc/nav.php'; ?>

    <div class="content">
        <h2>Deleting Record...</h2>
        <?php
        // Check if the 'id' is set in GET or POST request and is numeric
        if ((isset($_GET['user_id'])) && (is_numeric($_GET['user_id']))) {
            $user_id = $_GET['user_id'];
        } elseif ((isset($_POST['user_id'])) && (is_numeric($_POST['user_id']))) {
            $user_id = $_POST['user_id'];
        } else {
            echo '<p>Error! Invalid ID.</p>';
            exit();
        }

        // Connect to the database
        require('mysqli_connect.php');

        // If the request method is POST, process the delete action
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
            if ($_POST['sure'] == 'Yes') { 
                // User confirmed deletion
                $q = "DELETE FROM users WHERE user_id = $user_id"; // SQL delete query
                $result = @mysqli_query($dbcon, $q);
                
                // Check if a row was deleted
                if (mysqli_affected_rows($dbcon) == 1) {
                    echo '<p>User deleted successfully.</p>';
                    echo '<a href="view_users.php" class="btn btn-success">Back to User List</a>';
                } else {
                    echo '<p>Error! User could not be deleted.</p>';
                }
            } else { 
                // User chose not to delete
                echo '<p>Deletion cancelled.</p>';
                echo '<a href="view_users.php" class="btn btn-primary">Back to User List</a>';
            }
        } else { 
            // Display user details before deletion
            $q = "SELECT CONCAT(fname, ' ', lname) 
            FROM users WHERE user_id = $user_id";
            $result = @mysqli_query($dbcon, $q);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result, MYSQLI_NUM);
                echo "<h3>Are you sure you want to delete $row[0]?</h3>";
                echo '
                    <form action="delete_user.php" method="post">
                        <input id="submit-yes" type="submit" name="sure" value="Yes">
                        <input id="submit-no" type="submit" name="sure" value="No">
                        <input type="hidden" name="user_id" value="' . $user_id . '">
                    </form>
                ';
            } else {
                echo '<h3>Error! User not found.</h3>';
            }
        }

        // Close the database connection
        mysqli_close($dbcon);
        ?>
    </div>

    <?php include 'inc/footer.php'; ?>

</body>

</html>
