<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Website ni Peruda</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="inc/styles.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <?php include 'inc/header.php'; ?>
    <?php include 'inc/nav.php'; ?>

<div id="content">
<h2>Registered Citizens</h2>
<p>
    <?php
        require("mysqli_connect.php");
        $q = "SELECT fname, lname, email, 
        DATE_FORMAT(registration_date, '%M %d, %Y') AS regdat 
        FROM users ORDER BY user_id ASC";
        $result = @mysqli_query($dbcon, $q); 

        if ($result) { // if query is successful
            echo '<table>
            <tr>
                <th><strong>Name</strong></th>
                <th><strong>Email</strong></th>
                <th><strong>Registered Date</strong></th>
                <th><strong>Actions</strong></th>
            </tr>';     
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo '<tr>
                        <td>'. $row['fname'] .'</td>
                        <td>'. $row['email'] . '</td>
                        <td>'. $row['regdat'] . '</td>
                        <td><a href="edit_user.php?user_id='.$row['user_id'].'">Edit</a></td>
                        <td><a href="delete_user.php?user_id=123'.$row['user_id'].'">Delete</a></td>
                      </tr>';
            }

            echo '</table>';
            mysqli_free_result($result);
        } else {
            echo '<p class="error">The current registered users could not be retrieved. Please contact the system administrator</p>';
        }
        mysqli_close($dbcon);
    ?>
</p>


    <?php include 'inc/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
