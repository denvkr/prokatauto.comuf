<?php
abstract class database_connection_base_class {
var $dbhost= 'localhost';
var $dbname= 'localhost';
var $dbuser= 'root';
var $dbpass= 'postman';
var $conn;
var $rows_array=array();
var $conn_to_server='mysql';

function __construct() {
if ($conn_to_server=='mysql') {
    $conn = mysql_connect($this->dbhost, $this->dbuser, $this->dbpass) or die ('Error connecting to mysql');
    mysql_select_db($this->dbname,$conn);
    mysql_query("set names utf8");
    reset($this->rows_array);
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

function set_dbname($dbname) {
    $this->dbname=$dbname;
return 1;
}

//abstract function add_record ($Id,$EnWord,$RuWord,$Description,$Transcription);

//abstract public function get_record($dbhost,$dbuser,$dbpass);

public function get_records_mssql($query_text){
   $sqlconnect=mssql_connect($this->dbhost, $this->dbuser,$this->dbpass);
   $sqldb=mssql_select_db($this->dbname,$sqlconnect);
   $sqlquery=$query_text;
   $results= mssql_query($sqlquery);
   //$row=mssql_fetch_array($results);
   mssql_close($sqlconnect);
   return $results;
}

public function del_records_mssql($query_text){
   $sqlconnect=mssql_connect($this->dbhost, $this->dbuser,$this->dbpass);
   $sqldb=mssql_select_db($this->dbname,$sqlconnect);
   $sqlquery=$query_text;
   $results= mssql_query($sqlquery);
   //$row=mssql_fetch_array($results);
   mssql_close($sqlconnect);
   return $results;
}

public function add_records_mssql($query_text){
   $sqlconnect=mssql_connect($this->dbhost, $this->dbuser,$this->dbpass);
   $sqldb=mssql_select_db($this->dbname,$sqlconnect);
   $sqlquery=$query_text;
   $results= mssql_query($sqlquery);
   //$row=mssql_fetch_array($results);
   mssql_close($sqlconnect);
   return $results;
}

}
?>