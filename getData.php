<?php
if (!isset($_SESSION)) {
        session_start();
    }
include "./phpfiles.php";
$myObj = new \stdClass();
$sql= "SELECT `Date_Time`,`Soil_Moisture`,`RainDrop`,`Motor_Status` FROM iotdata WHERE `userID`=".$_SESSION['userId']." ORDER BY `Date_Time` DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
                $myObj->time = $row['Date_Time'];
                $myObj->soil = $row['Soil_Moisture'];
                $myObj->rain = $row['RainDrop'];
                $myObj->motorStatus = $row['Motor_Status'];
                $myJSON = json_encode($myObj);
                echo $myJSON;
}
}
?>