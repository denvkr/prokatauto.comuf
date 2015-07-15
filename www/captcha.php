<?php
header("Content-Type: image/jpeg");
$site_config='site_config.xml';
//session_start();
$retval=db_get_session_id($_REQUEST['mail_link_activation'],$_REQUEST['fs']);
//session_id($retval[0]);
//get_checkcode_picture(substr(session_id(),-4,4));
//get_checkcode_picture(substr($retval,-4,4));
//get_checkcode_picture(substr('prvt',-4,4));
$rand_word=array(0 =>'a',1 =>'S',2 =>'5',3 =>'l',4 =>'p',5 =>'@',6 =>'-',7 =>'7',8 =>'0',9 =>'b',10 =>'v',11 =>'e',12 =>'Q');
$chn1=rand(0,12);
$ch1=$rand_word[$chn1];
$chn2=rand(0,12);
$ch2=$rand_word[$chn2];
$chn3=rand(0,12);
$ch3=$rand_word[$chn3];
$chn4=rand(0,12);
$ch4=$rand_word[$chn4];
$code=$ch1.$ch2.$ch3.$ch4;
get_checkcode_picture($code);
//echo $code; 
function get_checkcode_picture($code){
    $img=imagecreatetruecolor(45, 30) or die('Cannot Initialize new GD image stream');
    $x1=0;
    $x2=60;
    $y1=rand(0, 30);
    $y2=rand(00, 30);
	//create random background color
	$R1=rand(0,255);
	$G1=rand(0,255);
	$B1=rand(0,255);
	$R2=rand(0,255);
	$G2=rand(0,255);
	$B2=rand(0,255);
	if (($R1==$R2 && $G1==$G2 && $B1==$B2)) {
		do {
		$R1=rand(0,255);
		$G1=rand(0,255);
		$B1=rand(0,255);
		$R2=rand(0,255);
		$G2=rand(0,255);
		$B2=rand(0,255);			
		}  while (($R1==$R2 && $G1==$G2 && $B1==$B2));
		
	}
	$background=imagecolorallocate($img,$R1,$G1,$B1);
	imagefill($img, 0, 0, $background);
	$textcolor=imagecolorallocate($img,$R2,$G2,$B2);
    imageline($img, $x1, $y1, $x2, $y2, $textcolor);
    $x1=rand(0, 50);
    $x2=rand(0, 50);
    $y1=0;
    $y2=30;
    imageline($img, $x1, $y1, $x2, $y2, $textcolor);
    //imagestring($img, 4, 10, 7, $code, $textcolor);
    imagechar($img, rand(2,4), rand(1,2), 7, substr ($code,0,1), $textcolor);
    imagechar($img, rand(2,4), rand(12,14), 5, substr ($code,1,1), $textcolor);
    imagechar($img, rand(2,4), rand(20,22), 12, substr ($code,2,1), $textcolor);
    imagechar($img, rand(2,4), rand(28,31), 8, substr ($code,3,1), $textcolor);
    imagejpeg($img);
}

function db_get_session_id($mail_link_activation,$fs){
 global $site_config;
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
	
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
    //$dbname = 'prokatau_rentcar';
    mysqli_select_db($conn,$dbname);
	mysqli_query($conn,"SET NAMES utf8");
	if ($fs==1){
		$result = mysqli_query($conn,"SELECT DISTINCT session_id FROM register_user_session_info WHERE login='".$mail_link_activation."'");
	}
		else {
		$result = mysqli_query($conn,"SELECT DISTINCT session_id FROM user_session_info WHERE login='".$mail_link_activation."'");
	}
	if (mysqli_errno==0){
		$row = mysqli_fetch_row($result);
		mysqli_free_result($result);
		mysqli_close($conn);		
		return $row[0];
	} else {
		return 'error';
	}
}
function get_site_config($xmlfile,$attribute)
{
	$xmlread = new XMLReader;
	if (!$xmlread->open($xmlfile,'utf-8')) {
		die("Failed to open xml  file");
	}
	// ¬ы должны использовать это
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
?>