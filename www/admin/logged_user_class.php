<?php

include "database_connection_base_class.php";

class logged_user_class extends database_connection_base_class {
var $dbhost= 'localhost';
var $dbname= 'prokatau_rentcar';
var $dbuser= 'prokatau_root';
var $dbpass= 'Hftg8bp';
var $conn;
var $rows_array=array();

function __construct() {
    //$conn = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass) or die ('Error connecting to mysql');
    //mysqli_select_db($conn,$this->dbname);
    //mysqli_query($conn,"set names utf8");
    //$result = mysql_query("SELECT id,EnWord,convert(ruword using utf8) AS RuWord,Description,Transcription FROM dictionary",$conn);
    //$cnt = count($result);
    //while($row = mysql_fetch_array($result)) {
    //  array_push($this->rows_array,$row);
    //}
//reset($this->rows_array);
return 1;
}

function set_dbhost($dbhost) {
    $this->dbhost=$dbhost;
return 1;
}

function set_user($dbuser) {
    $this->dbuser=$dbuser;
return 1;
}

function set_dbpass($dbpass) {
    $this->dbpass=$dbpass;
return 1;
}

function set_dbname($dbname) {
    $this->dbname=$dbname;
return 1;
}

function update_row_logged_user($Username,$Password,$Info){
    $conn = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass) or die ('Error connecting to mysql');
    mysqli_select_db($conn,$this->dbname);
    mysqli_query($conn,"set names utf8");
    mysqli_query($conn,"CALL ".$this->dbname.".update_row_logged_user('".$Username."','".$Password."','".$Info."')");
    mysqli_close($conn);
	return 1;
}

function add_row_logged_user($Username,$Password,$Info){
    $conn = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass) or die ('Error connecting to mysql');
    mysqli_select_db($conn,$this->dbname);
    mysqli_query($conn,"set names utf8");
    mysqli_query($conn,"SET @RETVAL=(SELECT COUNT(login) FROM user_session_info WHERE login='".$Username."' AND password='".$Password."');");
	$result=mysqli_query($conn,"SELECT @RETVAL");
	$row = mysqli_fetch_array($result);
	//echo $Username.$Password.$Info.$row[0];
	mysqli_free_result($result);
	if ($row[0]==0) {
		mysqli_query($conn,"SET @SESSIONTIME ='2013-05-06 09:41:04';");
		$result=mysqli_query($conn,"INSERT INTO user_session_info (login,password,info,login_time) VALUES ('".$Username."','".$Password."','".$Info."',STR_TO_DATE(@SESSIONTIME,'%Y-%m-%d %H:%i:%s'));");
	}
    mysqli_close($conn);
return 1;
}

function get_first_record() {
reset($this->rows_array);
return current($this->rows_array);
}
function get_last_record() {
end($this->rows_array);
return current($this->rows_array); 
}
function get_next_record() {
next($this->rows_array);
return current($this->rows_array);
}
function get_prev_record() {
prev($this->rows_array);
return current($this->rows_array);
}
}
?>