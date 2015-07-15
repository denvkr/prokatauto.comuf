<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FileToDBUpload.</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php

/*
$handle = fopen("C://Program Files//Apache Software Foundation//Apache2.2//htdocs//rentacar//p60002.jpg", "r");

if (($handle)) { 
	$chunksize=1000;
	echo("Image was open.");
	while ( !feof( $handle ) ) { 
				$buffer = fread( $handle, $chunksize ); 
				echo $buffer; 
				ob_flush(); 
				flush(); 
				if ( $retbytes ) { 
					$cnt += strlen( $buffer ); 
				} 
			} 
			$status = fclose( $handle );
}
*/

//Загружаем файл.
$file_name="photo/156001-743bc-31458604-.jpg";

$image = file_get_contents($file_name);
if (($image)) {
	$content=addslashes($image);
}
//Кладем данные в базу.
$dbhost= 'localhost';
$dbuser ='prokatau_root';
$dbpass ='Hftg8bp';
$conn = mysqli_connect($dbhost,$dbuser,$dbpass) or die ("Error connecting to mysql.");
$dbname = 'prokatau_rentcar';
mysqli_select_db($conn,$dbname);
//mysql_query("set names utf8");
echo $content;
$result = mysqli_query($conn,"UPDATE carsinfo SET PHOTO='".$content."' where CAR_ID=1");
if ((mysqli_errno)){
      print "Data was inserted cusessfully.";
}
mysqli_free_result($result); 

$file_name="photo/702403.jpg";

$image = file_get_contents($file_name);
if (($image)) {
	$content=addslashes($image);
}
$dbname = 'prokatau_rentcar';
//mysqli_select_db($dbname,$conn);
//mysql_query("set names utf8");
echo $content;
$result = mysqli_query($conn,"UPDATE carsinfo SET PHOTO='".$content."' where CAR_ID=3");
if ((mysqli_errno)){
      print "Data was inserted cusessfully.";
}
mysqli_free_result($result); 

$file_name="photo/VAZ_2111.jpg";

$image = file_get_contents($file_name);
if (($image)) {
	$content=addslashes($image);
}
$dbname = 'prokatau_rentcar';
//mysqli_select_db($dbname,$conn);
//mysql_query("set names utf8");
echo $content;
$result = mysqli_query($conn,"UPDATE carsinfo SET PHOTO='".$content."' where CAR_ID=4");
if ((mysqli_errno)){
      print "Data was inserted cusessfully.";
}
mysqli_free_result($result); 

mysqli_close($conn);

?>
</body>
</html>