<?php
reguire "database_connection_base_class.php";

class dictionary_worker_class {
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
    $result = mysql_query("SELECT id,EnWord,convert(ruword using utf8) AS RuWord,Description,Transcription FROM dictionary",$conn);
    $cnt = count($result);
    while($row = mysql_fetch_array($result)) {
      array_push($this->rows_array,$row);
    }
reset($this->rows_array);
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
    $result = mysql_query("insert into dictionary (id,EnWord,RuWord,Description,Transcription) values (".$Id.",'".$EnWord."','".$RuWord."','".$Description."','".$Transcription."')",$conn);
    //print "insert into dictionary (id,EnWord,RuWord,Description,Transcription) values (".$Id.",'".$EnWord."','".$RuWord."','".$Description."','".$Transcription."')";
return 1;
}

/*
function add_record ($dbhost,$dbuser,$dbpass,$Id,$EnWord,$RuWord,$Description,$Transcription){
    $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql'); 
    $dbname = 'localhost';
    mysql_select_db($dbname,$conn);
    $result = mysql_query("insert into dictionary (id,EnWord,RuWord,Description,Transcription) values (".$Id.",'".$EnWord."','".$RuWord."','".$Description."','".$Transcription."')",$conn);
return 1;
}
*/
public function get_record($dbhost,$dbuser,$dbpass) {
    $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
    $dbname = 'localhost';
    mysql_select_db($dbname,$conn);
    mysql_query("set names utf8");
    $result = mysql_query("SELECT id,EnWord,convert(ruword using utf8) AS RuWord,Description,Transcription FROM dictionary",$conn);
    $cnt = count($result);
    $str = '<table border="1" cols="3">'."<tr><th>Id</th><th>EnWord</th><th>RuWord</th><th>Description</th><th>Transcription</th></tr>";
    while($row = mysql_fetch_array($result)) {
      $str .= "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td></tr>";
    }
    mysql_free_result($result); 
    mysql_close($conn);
    print $str."</table>";
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