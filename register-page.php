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

<div class="container content"> 
    <div class="row justify-content-center"> 
        <div class="col-md-6"> 

    <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $errors = [];

            //Validate user input
            $fn = !empty(trim($_POST["fname"])) ? trim ($_POST["fname"]) : $errors[] = "Please enter your first name.";
            $ln = !empty(trim($_POST["lname"])) ? trim ($_POST["lname"]) : $errors[] = "Please enter your last name.";
            $e = !empty(trim($_POST["email"])) ? trim ($_POST["email"]) : $errors[] = "Please enter your email.";
            $p1 = !empty(trim($_POST["psword1"])) ? trim ($_POST["psword1"]) : $errors[] = "Please enter your password.";
            $p2 = !empty(trim($_POST["psword2"])) ? trim ($_POST["psword2"]) : $errors[] = "Please confirm your password.";
            
            if ($p1 !== $p2) {
                $errors[] = "Your passwords do not match.";
            }

            //code from lms

                if (empty($errors)) { // walang errors. yey
                // Register the user in the database...
                    require ('mysqli_connect.php'); // Connect to the db.
                    $hashed_password = password_hash($p, PASSWORD_DEFAULT);
                    // Make the query:
                    $q = "INSERT INTO users (fname, lname, email, psword, registration_date) VALUES ('$fn', '$ln', '$e', '$hashed_password', NOW())";		//this password ($p) is NOT encrypted. find a way to secure this password
                    $result = @mysqli_query ($dbcon, $q); // Run the query.
                    if ($result) { // If it ran OK.
                    header ("location: register-thanks.php"); 
                    exit();	
                    } else { // If it did not run OK.
                        //Public message:
                        echo '<h2>System Error</h2>
                        <p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
                        // Debugging message:
                        echo '<p>' . mysqli_error($dbcon) . '</p>';
                    }
                    mysqli_close($dbcon); 

                    // Include the footer and quit the script:
                    include ('inc/footer.php');
                    exit();
                    
                    
                } else { // may error. sad.
                    //Error message:
                    echo '<h4 class="text-danger">System Error!</h4>
                    <p class="error">The following error(s) occurred:<br/>';
                    foreach ($errors as $error) {
                        echo "<li>$error</li>";
                    }
                    echo "</p><h4>Please try again.</h4><br/><br/>";
                } 
        }
    ?>
<h2>Make a Pledge</h2>
<br/>
<form action="register-page.php" method="post">
    <div class="form-group">
        <p>
            <label class="label" for="fname">First Name:</label>
            <input type="text" id="fname" name="fname" size="30" maxlength="40" value="<?php if(isset($_POST['fname'])) echo $_POST['fname']?>">
        </p>
    
        <p>
            <label class="label" for="lname">Last Name:</label>
            <input type="text" id="lname" name="lname" size="30" maxlength="40" value="<?php if(isset($_POST['lname'])) echo $_POST['lname']?>">
        </p>
    
        <p>
            <label class="label" for="email">Email Address:</label>
            <input type="email" id="email" name="email" size="30" maxlength="50" value="<?php if(isset($_POST['email'])) echo $_POST['email']?>">
        </p>
    
        <p>
            <label class="label" for="psword1">Password:</label>
            <input type="password" id="psword1" name="psword1" size="20" maxlength="40" value="<?php if(isset($_POST['psword1'])) echo $_POST['psword1']?>">
        </p>
   
        <p>
            <label class="label" for="psword2">Confirm Password:</label>
            <input type="password" id="psword2" name="psword2" size="20" maxlength="40" value="<?php if(isset($_POST['psword2'])) echo $_POST['psword2']?>">
        </p>
    
        <p>
            <br>
            <input type="submit" id="submit" name="submit" value="Register">
        </p>
    </div>
</form>

</form>
</div> 
</div> 
</div> 

    <?php include 'inc/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
