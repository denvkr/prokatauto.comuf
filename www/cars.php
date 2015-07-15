
<?php
ini_set('display_errors', true);
ini_set ('session.save_handler', 'files');
ini_set('session.gc_maxlifetime', 86400);
date_default_timezone_set('Europe/Moscow');
$site_config='site_config.xml';

$retval=get_site_config($site_config,'siteconfig');

if (count($retval)>0) {
	$dbhost=$retval[0]['db_server_name'];
} else {
	$dbhost= 'localhost';
}
if (count($retval)>0) {
	$dbuser=$retval[0]['db_user_name'];
} else {
	$dbuser ='prokatau_root';
}
if (count($retval)>0) {
	$dbpass=$retval[0]['db_user_password'];
} else {
	$dbpass ='Hftg8bp';
}
if (count($retval)>0) {
	$dbname=$retval[0]['db_name'];
} else {
	$dbname = 'prokatau_rentcar';
}

//$dbhost ='localhost';
//$dbuser ='prokatau_root';
//$dbpass ='Hftg8bp';

$outstr='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
$outstr.='<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">';
$outstr.='<head>';
$outstr.='<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>';
$outstr.='<title>Автомобили предлагаемые в аренду-autovarendu.ru</title>';
$outstr.='<link href="style.css" rel="stylesheet" type="text/css" />';
$outstr.='<meta name="Keywords" content="Аренда авто, аренда автомобиля, аренда автомобилей, аренда автомобилей без залога, аренда автомобиля без водителя, аренда автомобиля с водителем, аренда авто без залога, аренда авто без водителя, аренда авто с водителем, аренда skoda,аренда bmw,аренда ваз, почасовая аренда автомобиля с водителем, Автомобили предлагаемые в аренду" />';
$outstr.='<meta name="robots" content="index,follow" />';
$outstr.='<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.min.js"></script>';
$outstr.='<script type="text/javascript" src="w_load.js" async></script>';
$outstr.='    <!-- Bootstrap core CSS -->';
$outstr.='    <link href="bootstrap/docs/dist/css/bootstrap.min.css" rel="stylesheet">';
$outstr.='    <!-- Bootstrap theme -->';
$outstr.='    <link href="bootstrap/docs/dist/css/bootstrap-theme.min.css" rel="stylesheet">';
$outstr.='    <!-- Custom styles for this template -->';
$outstr.='    <link href="bootstrap/theme.css" rel="stylesheet">';
$outstr.='    <!-- Just for debugging purposes. Don\'t actually copy these 2 lines! -->';
$outstr.='    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->';
$outstr.='    <script src="bootstrap/docs/assets/js/ie-emulation-modes-warning.js"></script>';
$outstr.='    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->';
$outstr.='    <script src="bootstrap/docs/assets/js/ie10-viewport-bug-workaround.js"></script>';
$outstr.='    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->';
$outstr.='    <!--[if lt IE 9]>';
$outstr.='      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>';
$outstr.='      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>';
$outstr.='    <![endif]-->';
$outstr.='</head>';
$outstr.='<body id="body_container" style="position: absolute; width: 1160px; height: 800px;visibility:hidden;">'; //onload="javascript:Dimension();"
$outstr.='<script type="text/javascript">';
$outstr.='function Dimension ()';
$outstr.='{';
$outstr.='	var Width = (window.screen.width);';
$outstr.='	var Height = (window.screen.height);';
$outstr.='	if (Width < 1160) {';
$outstr.='		document.getElementById("container_cars").style.left="0px";';
$outstr.='	} else if (Width >= 1160) {';
$outstr.='		var left_size=Math.round((Width-1160)/2);';
$outstr.='		document.getElementById("container_cars").style.left=String(left_size)+"px";';
$outstr.='	}';
$outstr.='}';
$outstr.='</script>';
$outstr.='<div class="container1" id="container_cars" style="position:relative; left:0px; top:0px; width:1160px; height:800px; z-index:0;">';
$outstr.='<div class="h1_level1" id="h1_level" style="position:relative;display:block; left:0px; top:0px; width:1160px; height:40px; z-index:0;border-radius: 3px;border: 1px solid #000;overflow: hidden;">';
$outstr.='<h1 style="position:relative;left:0px; top:0px; width:1160px; height:40px; z-index:0; color:white;margin:0 0 0 0;"> Автомобили предлагаемые в аренду. </h1>';
$outstr.='</div>';
$outstr.='<a href="http://autovarendu.biz/"><button class="btn btn-lg btn-primary btn-block" name="_BakToMain" value="На главную" style="margin: 9px 0px;">На главную</button></a>';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
    if ($conn->connect_errno) {
    	printf("ошибка соединения с БД: %s\n", $conni->connect_error);
    	exit();
    }    
    //$dbname = 'prokatau_rentcar';
    mysqli_select_db($conn,$dbname);
    $result = mysqli_query($conn,"SET NAMES UTF8;");
    if ($conn->connect_errno) {
    	printf("ошибка соединения с БД: %s\n", $conni->connect_error);
    	exit();
    }
    //mysqli_free_result($result);
    $result = mysqli_query($conn,'SELECT car_name,odometer_value,photo,(CASE carsinfo.car_id WHEN 1 THEN (SELECT modification from modification where id=1) WHEN 3 THEN (SELECT modification from modification where id=2) WHEN 4 THEN (SELECT modification from modification where id=3) END) as modification,(select shift from power_shift where id=carsinfo.power_shift_id) as transmission,(SELECT rent_status from rent_status where id=carsinfo.rent_status_id) as rent_status FROM '.$dbname.'.carsinfo');
    //$row = mysqli_fetch_array($result);
    //print_r($row);
    $cnt = count($result);
    $outstr.='<div class="content_level1" id="content_level" style="position:relative;display:block; left:0px; top:20px; width:100%; height:656px;z-index:0;border-radius: 3px;border: 1px solid #000;overflow: hidden;">';
    $outstr .= '<div class="ul" style="position:relative;display:block;top:5%;margin-left:auto;margin-right:auto;">';
    $outstr .= '<table border="1" cols="6" style="margin-left:auto;margin-right:auto;">'."<tr><th>Автомобиль</th><th>Пробег</th><th>Изображение</th><th>Двигатель</th><th>Трансмиссия</th><th>Текущий статус</th></tr>";
    $cnt=0;

	if ($conn->connect_errno) {
	    printf("ошибка соединения с БД: %s\n", $conni->connect_error);
	    exit();
	}

    if ($_SERVER['SERVER_PORT']==80) {
		$server_protocol='HTTP://';
    }
    
    while($row = mysqli_fetch_array($result)) {
	if ($cnt==0){
		$outstr .= '<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td style="width: 200px;height: 120px;"><img style="width:100%;height: 100%;" src="'.$server_protocol.$_SERVER['SERVER_NAME'].'/carimg1.php" alt="Car picture" /></td><td>'.$row[3].'</td><td>'.$row[4].'</td><td>'.$row[5].'</td></tr>';
	}
	if ($cnt==1){
		$outstr .= '<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td style="width: 200px;height: 120px;"><img style="width:100%;height: 100%;" src="'.$server_protocol.$_SERVER['SERVER_NAME'].'/carimg2.php" alt="Car picture" /></td><td>'.$row[3].'</td><td>'.$row[4].'</td><td>'.$row[5].'</td></tr>';
	}
	if ($cnt==2){
		$outstr .= '<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td style="width: 200px;height: 120px;"><img style="width:100%;height: 100%;" src="'.$server_protocol.$_SERVER['SERVER_NAME'].'/carimg3.php" alt="Car picture" /></td><td>'.$row[3].'</td><td>'.$row[4].'</td><td>'.$row[5].'</td></tr>';
	}
	$cnt++;
    }
    //mysqli_free_result($result);
    mysqli_close($conn);
    $outstr.="</table></div>";

function get_site_config($xmlfile,$attribute)
{
	$xmlread = new XMLReader;
	if (!$xmlread->open($xmlfile,'utf-8')) {
	    die("Failed to open xml  file");
	}
	// Вы должны использовать это
	$xmlread->setParserProperty(XMLReader::VALIDATE, false);
	//var_dump($xmlread->isValid());
	//$xmlread->moveToAttribute($attribute);
	//$node_data=$xmlread->readString();
	$idx=0;
	//$xmlread->next();
	$xmlread->read();
	  if (($xmlread->nodeType == XMLReader::ELEMENT) && ($xmlread->name == $attribute)) {
	    // считываем атрибуты
		$xmlread->read();
		$xmlread->read();
		$xmlarr[$idx][$xmlread->name]= $xmlread->readstring();
		$xmlread->read();	
		$xmlread->read();	
		$xmlread->read();
		$xmlread->read();	
		$xmlarr[$idx][$xmlread->name] = $xmlread->readstring();
		$xmlread->read();
		$xmlread->read();
		$xmlread->read();
		$xmlread->read();	
		$xmlarr[$idx][$xmlread->name] = $xmlread->readstring();
		$xmlread->read();
		$xmlread->read();
		$xmlread->read();	
		$xmlread->read();
		$xmlarr[$idx][$xmlread->name] = $xmlread->readstring();
		$xmlread->read();
		$xmlread->read();
		$xmlread->read();	
		$xmlread->read();
		$xmlarr[$idx][$xmlread->name] = $xmlread->readstring();
	    $idx ++;
	  }
	  elseif (($reader->nodeType == XMLReader::END_ELEMENT) && ($reader->name == $attribute)) {
	     break;
	  }
	$xmlread->close();
	if (libxml_get_last_error()) {
	    echo "There was an error reading the xml file";
	}
	//echo $xmlarr[0]['db_server_name'];
	  return $xmlarr;
}    
/*
print <<<HTMLOUTPUT
<img alt="Embedded Image" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIA"/>
HTMLOUTPUT;
*/
$outstr.='</div>';
$outstr.='<div id="copyright_level1" class="ul.nav" style="position:relative; left: 40%; top:0px; width:200px; height:20px;font-size:13px;">';
$outstr.='<p class="a"> ИП Красавин Д.В. 2011-2015</p>';
$outstr.='</div>';
$outstr.='</div>';
$outstr.='</body>';
$outstr.='</html>';
echo $outstr;
?>