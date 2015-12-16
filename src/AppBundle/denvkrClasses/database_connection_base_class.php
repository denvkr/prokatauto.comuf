<?php
namespace AppBundle\denvkrClasses;
class database_connection_base_class {
private $dbhost= 'localhost';
private $dbname= 'prokatau_rentcar';
private $dbuser= 'prokatau_root';
private $dbpass= 'Hftg8bp';
public $conn;
private $rows_array=array();
public $conn_to_server='mysql';

function __construct($dbhost='localhost',$dbname='prokatau_rentcar',$dbuser='prokatau_root',$dbpass='Hftg8bp',$conn_to_server='mysql') {
    $this->$conn_to_server=$conn_to_server;
    if ($this->$conn_to_server=='mysql') {
        $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
        mysql_select_db($dbname,$conn);
        mysql_query("set names utf8");
        reset($this->rows_array);
    }
}

function set_dbhost($dbhost) {
    $this->dbhost=$dbhost;
return 1;
}

function set_dbuser($dbuser) {
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

function get_dbhost() {
    return $this->dbhost;
}

function get_dbuser() { 
    return $this->dbuser;
}

function get_dbpass() {
    return $this->dbpass;
}

function get_dbname() {
    return $this->dbname;
}

//abstract function add_record ($Id,$EnWord,$RuWord,$Description,$Transcription);

//abstract public function get_record($dbhost,$dbuser,$dbpass);

public function get_records_mssql($query_text){
   $sqlconnect=mssql_connect($this->dbhost, $this->dbuser,$this->dbpass);
   mssql_select_db($this->dbname,$sqlconnect);
   $sqlquery=$query_text;
   $results= mssql_query($sqlquery);
   //$row=mssql_fetch_array($results);
   mssql_close($sqlconnect);
   return $results;
}

public function del_records_mssql($query_text){
   $sqlconnect=mssql_connect($this->dbhost, $this->dbuser,$this->dbpass);
   mssql_select_db($this->dbname,$sqlconnect);
   $sqlquery=$query_text;
   $results= mssql_query($sqlquery);
   //$row=mssql_fetch_array($results);
   mssql_close($sqlconnect);
   return $results;
}

public function add_records_mssql($query_text){
   $sqlconnect=mssql_connect($this->dbhost, $this->dbuser,$this->dbpass);
   mssql_select_db($this->dbname,$sqlconnect);
   $sqlquery=$query_text;
   $results= mssql_query($sqlquery);
   //$row=mssql_fetch_array($results);
   mssql_close($sqlconnect);
   return $results;
}

}
?>