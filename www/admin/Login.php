<html>
<body>
<?php
// login.php - performs validation 
print "authenticate using form variables <br>";
print "user:".$_REQUEST['user']." password:".$_REQUEST['password']."<br>";

/*
//Reading Data from users
$retval=read_passwd("C:\\Program Files\\Apache Software Foundation\\Apache2.2\\bin\\users");
print "Reading result:".$retval."<br>";

if ($retval==1) {
   //Checking user in file
   $retval=checkUser($_REQUEST['user'],$_REQUEST['password']);
   print "CheckUser result:".$retval."<br>";
   if ($retval==0) {
      $retval=addUser($_REQUEST['user'],$_REQUEST['password'],$_REQUEST['user']);
      print "addUser result:".$retval."<br>";
      if ($retval==1) {
         $retval=save_passwd("C:\\Program Files\\Apache Software Foundation\\Apache2.2\\bin\\users");
         print "savePassword result:".$retval."<br>";
      }
   }
}
*/

$status = authenticate($_REQUEST['user'],$_REQUEST['password']);
// if  user/pass combination is correct
if ($status == 1)
{
// initiate a session
session_start();
// register some session variables
session_register("SESSION");
// including the username
session_register("SESSION_UNAME");
$SESSION_UNAME = $_REQUEST['user'];
// redirect to protected page
$user=$_REQUEST['user'];
$password=$_REQUEST['password'];
header("Location: http://localhost:82/userinfo.php?user=$user&password=$password");
exit();
}
else
// user/pass check failed
{
// redirect to error page
//header("Location: http://localhost:82/error.php?e=$status");
exit();
}

// authenticate username/password against /etc/passwd
// returns: -1 if user does not exist
//           0 if user exists but password is incorrect
//           1 if username and password are correct

function authenticate($user, $pass)
{
$result = -1;
// make sure that the script has permission to read this file!
$data = file("C:\\Program Files\\Apache Software Foundation\\Apache2.2\\bin\\users");
// iterate through file
foreach ($data as $line)
{
$arr = explode(":", $line);
// if username matches
// test password
if ($arr[0] == $user)
{
// get salt and crypt()
$salt = substr($arr[1], 0, 5); //substr($arr[1], 0, 12);

$shapasswd="{SHA}" . base64_encode(pack("H*", sha1($pass)));
// if match, user/pass combination is correct
// return 1
if (trim($arr[1]) == trim($shapasswd))
{
print "Password from htpasswd:".$arr[1]."<br>";
print "Password from passw field:".$shapasswd."<br>";
$result = 1;
break;
}
// otherwise return 0
else
{
$result = 0;
break;
}
}
}
// return value
return $result;
}

function read_passwd($file) {
global $users;
global $cvs;
$fp = fopen($file,'r') or die("Unable to open $file");
while(!feof($fp)) {
$line = fgets($fp, 128);
list($user,$pass,$cvsuser) = explode(':',$line);
if(strlen($user)) {
$users[$user] = $pass;
$cvs[$user] = trim($cvsuser);
}
}
fclose($fp);
return true;
}

function addUser($user,$pass,$cvsuser) {
global $users;
global $cvs;
if(!isset($users[$user])) {
// $users[$user] = crypt($pass,substr($pass,0,2));
$users[$user] = crypt($pass);
$cvs[$user] = $cvsuser;
return true;
} else {
return false;
}

}
function modUser($user,$pass,$cvsuser) {
if(isset($users[$user])) {
// $users[$user] = crypt($pass,substr($pass,0,2));
$users[$user] = crypt($pass);
$cvs[$user] = $cvsuser;
return true;
} else {
return false;
}
}

function delUser($user) {
if(isset($users[$user])) {
unset($users[$user]);
unset($cvs[$user]);
} else {
return false;
}
}

function checkUser($user,$pass) {
if(isset($users[$user])) {
if($users[$user] == crypt($pass,substr($users[$user],0,2))) return true;
}
return false;
}

function save_passwd($file) {
$fp = fopen($file,'w');
foreach($users as $user => $pass) {
if($cvs[$user]) {
fputs($fp, "$user:$pass:".$cvs[$user]."\n");
} else {
fputs($fp, "$user:$pass\n");
}
}
fclose($fp);
}
?>
</body>
</html>
