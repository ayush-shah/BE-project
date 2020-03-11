<?php
if (!isset($_SESSION)) {
    session_start();
}
$conn = mysqli_connect('localhost', 't3ci1yv7ace7', 'c00lpanda!P', 'be_proj');
if (!$conn)
{
		die("Connection failed: " . $mysqli_connect_error);
}
if (isset($_POST['Login'])) {
    $uname              = md5($_POST['username']);
    $password           = md5($_POST["password"]);
    $sql                = "SELECT ID FROM usertable WHERE username = '$uname' and password = '$password'";
    $result             = mysqli_query($conn, $sql);
    $row                = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count              = mysqli_num_rows($result);
    $_SESSION['userId'] = $row['ID'];
    if ($count) {
        $sql1    = "SELECT * FROM `croptable` WHERE `userID`= " . $_SESSION['userId'] . "";
        $result1 = mysqli_query($conn, $sql1);
        $count1  = mysqli_num_rows($result1);
        if ($count1) {
            $_SESSION['dataFilled']=1;
        }
        header("refresh:0;url=./afterLogin.php");
    } else {
        echo "<h6 class='user-pass-not-correct text-danger'>USER/PASSWORD NOT CORRECT</h6>";
        header("refresh:1;url=./index.php");
    }
}
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location:./index.php");
}
if (isset($_POST['submit'])) {
    $cropName  = $_POST['cropName'];
    $soilType  = $_POST['soilType'];
    $threshold = $_POST['threshold'];
    $userID    = $_SESSION['userId'];
    $sql       = "INSERT INTO `croptable`(`userID`, `CropName`, `SoilType`, `ThresholdValue`) VALUES ($userID,'$cropName','$soilType','$threshold');";
    if (mysqli_query($conn, $sql)) {
        echo "Data Inserted";
        header("refresh:1;url=./afterLogin.php");
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
}
?>