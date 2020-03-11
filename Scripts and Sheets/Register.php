<?php
$conn = mysqli_connect('localhost','root','aayushshah1998','be');
if (!$conn)
	{
		die("Connection failed: " . $mysqli_connect_error);
	}        
$uname    = md5($_POST['username']);
$password = md5($_POST["password"]);
$mail     = $_POST["email"];
$sql      = "INSERT INTO `usertable`(`Username`, `Password`, `Email`) VALUES ('$uname','$password','$mail')";
if (mysqli_query($conn, $sql)) {
    header("refresh:2;url=../index.php");
    echo "Registered successfully.";
    
} else {
    header("refresh:2;url=../index.php");
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
?>