<?php
ini_set('display_errors', true);
header('Content-type:image/jpg');
$dbhost ='localhost';
$dbuser ='prokatau_root';
$dbpass ='Hftg8bp';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql.');
$dbname = 'prokatau_rentcar';
mysqli_select_db($conn,$dbname);
$result = mysqli_query($conn,"SELECT photo FROM carsinfo where car_id=1");
$row = mysqli_fetch_array($result);
$jpg = $row[0];
echo $jpg;
mysqli_close($conn);
?>
