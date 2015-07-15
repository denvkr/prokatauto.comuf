<html>
<body>
<?php
print <<<HTMLOUTPUT
<form method="post" action="$_SERVER[PHP_SELF]">
<table border = "1">
<tr>
<td>User Name:</td> <td>User Password:</td> <td>Description:</td> 
</tr>
<tr>
<td> <input type="text" name="user_name" align="left"></td> <td><input type="text" name="user_password" align="left"></td> <td><input type="text" name="description" align="left"></td>
</tr>
</table>
<input type="submit" name="add_user_info" value="add user info">
</form>
HTMLOUTPUT;
?>
<?php
class db_worker {
private $dbhost= 'localhost';
private $dbname;
private $dbuser ='root';
private $dbpass ='postman';
private $conn;

function __construct() {
//$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
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

function add_record ($userinfo,$passwordinfo,$descriptioninfo) {
    $conn = mysql_connect($this->dbhost, $this->dbuser, $this->dbpass) or die ('Error connecting to mysql');
    $dbname = 'usrinfo';
    mysql_select_db($dbname,$conn);
    $result = mysql_query("insert into userinfo (username,password,comments) values ('".$userinfo."','".$passwordinfo."','".$descriptioninfo."')",$conn);
return 1;
}

/*
function add_record ($dbhost,$dbuser,$dbpass,$userinfo,$passwordinfo,$descriptioninfo){
    $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql'); 
    $dbname = 'usrinfo';
    mysql_select_db($dbname,$conn);
    $result = mysql_query("insert into userinfo (username,password,comments) values ('".$userinfo."','".$passwordinfo."','".$descriptioninfo."')",$conn);
return 1;
}
*/
function get_record($dbhost,$dbuser,$dbpass) {
    $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
    $dbname = 'usrinfo';
    mysql_select_db($dbname,$conn);
    $result = mysql_query("SELECT username,password,comments FROM userinfo",$conn);
    $cnt = count($result);
    $str = '<table border="1" cols="3">'."<tr><th>Username</th><th>Password</th><th>Description</th></tr>";
    while($row = mysql_fetch_array($result)) {
      $str .= "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td></tr>";
    }
    mysql_close($conn);
    print $str."</table>";
return 1;
} 
}
$mydb_worker=new db_worker();
$mydb_worker->set_dbhost('localhost');
$mydb_worker->set_user('root');
$mydb_worker->set_dbpass('postman');
$mydb_worker->get_record('localhost','root','postman');
if (isset($_REQUEST['user_name']) && isset($_REQUEST['user_password'])) {
   $mydb_worker->add_record($_REQUEST['user_name'],$_REQUEST['user_password'],$_REQUEST['description']);
   $mydb_worker->get_record('localhost','root','postman');
}
?>
</body>
</html>
