<?php
$dbhost ='localhost';
$dbuser ='root';
$dbpass ='postman';
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql.');
$dbname = 'rentacar';
mysql_select_db($dbname,$conn);
$result = mysql_query("SELECT photo FROM carsinfo where car_id=1",$conn);
$row = mysql_fetch_array($result);
$jpg = stripslashes($row[0]);
header('Content-type:image/jpg');
echo $jpg;
mysql_close($conn);
?>
