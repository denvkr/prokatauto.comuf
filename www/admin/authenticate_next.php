<?php
//Класс для работы с базой данных
class db_worker {
var $dbhost= 'localhost';
var $dbname= 'localhost';
var $dbuser= 'root';
var $dbpass= 'postman';
var $conn;
var $rows_array=array();

function __construct() {
    $conn = mysql_connect($this->dbhost, $this->dbuser, $this->dbpass) or die ('Error connecting to mysql');
    mysql_select_db($this->dbname,$conn);
    mysql_query("set names utf8");
    $result = mysql_query("SELECT id,username,userpassword,useremail FROM authenticate",$conn);
    $cnt = count($result);
    while($row = mysql_fetch_array($result)) {
      array_push($this->rows_array,$row);
    }
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

public function add_record ($Id,$EnWord,$RuWord,$Description,$Transcription) {
    $conn = mysql_connect($this->dbhost, $this->dbuser, $this->dbpass) or die ('Error connecting to mysql');
    $dbname = 'localhost';
    mysql_select_db($dbname,$conn);
    mysql_query("set names utf8");
    $result = mysql_query("insert into authenticate (username,userpassword,useremail) values ('".$UserName."','".$UserPassword."','".$UserEmail."')",$conn);
return 1;
}

/*Закомментировано
function add_record ($dbhost,$dbuser,$dbpass,$Id,$EnWord,$RuWord,$Description,$Transcription){
    $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql'); 
    $dbname = 'localhost';
    mysql_select_db($dbname,$conn);
    $result = mysql_query("insert into authenticate (username,userpassword,useremail) values ('".$UserName."','".$UserPassword."','".$UserEmail."')",$conn);
return 1;
}
*/

public function get_record($dbhost,$dbuser,$dbpass) {
    $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
    $dbname = 'localhost';
    mysql_select_db($dbname,$conn);
    mysql_query("set names utf8");
    $result = mysql_query("SELECT id,username,userpassword,useremail FROM authenticate",$conn);
    $cnt = count($result);
    $str = '<table border="1" cols="3">'."<tr><th>Id</th><th>UserName</th><th>UserPassword</th><th>UserEMail</th></tr>";
    while($row = mysql_fetch_array($result)) {
      $str .= "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td></tr>";
    }
    mysql_free_result($result); 
    mysql_close($conn);
    print $str."</table>";
return 1;
} 
function get_first_record() {
return reset($this->rows_array);
}
function get_last_record() {
return end($this->rows_array);
}
function get_next_record() {
return next($this->rows_array);
}
function get_prev_record() {
return prev($this->rows_array);
}
}

if (isset($_REQUEST['UserName']) && isset($_REQUEST['UserPassword']) && isset($_REQUEST['UserEMail'])) { 

setcookie("UserName",$_REQUEST['UserName'],time()+3600,"/admin/");
setcookie("UserPassword",$_REQUEST['UserPassword'],time()+3600,"/admin/");
setcookie("UserEMail",$_REQUEST['UserEMail'],time()+3600,"/admin/");

echo $_REQUEST['UserName']."<br>";
echo $_REQUEST['UserPassword']."<br>";
echo $_REQUEST['UserEMail']."<br>";

echo $_COOKIE["UserName"]."<br>";
echo $HTTP_COOKIE_VARS["UserName"]."<br>";
echo $_COOKIE["UserPassword"]."<br>";
echo $HTTP_COOKIE_VARS["UserPassword"]."<br>";
echo $_COOKIE["UserEMail"]."<br>";
echo $HTTP_COOKIE_VARS["UserEMail"]."<br>";

// Another way to debug/test is to view all cookies
echo "<pre>";
print_r($_COOKIE);
echo "</pre>";
header("Location: http://localhost:82/userinfo.php?user=".$_REQUEST['UserName']."&password=".$_REQUEST['UserPassword']);
exit();
}
?>