<?php
$dbcon = @mysqli_connect('localhost', 'zipperuda', 'zipperuda', 'm_peruda')
OR die('Could not connect to the MYSQL server: ' . mysqli_connect_error());
mysqli_set_charset($dbcon, 'utf8');

?>