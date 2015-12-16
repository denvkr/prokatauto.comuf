<html>
<body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-43061315-1', 'comuf.com');
  ga('send', 'pageview');

</script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter22020040 = new Ya.Metrika({id:22020040,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/22020040" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

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

//$status = authenticate($_REQUEST['user'],$_REQUEST['password']);
// if  user/pass combination is correct
$status = db_authenticate($_REQUEST['user'],$_REQUEST['password']);
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
	header("Location: http://".$_SERVER['SERVER_NAME']."/user_profile.php?user=$user&password=$password");
	exit();
}
else
// user/pass check failed
{
	// redirect to error page
	//header("Location: http://localhost:82/error.php?e=$status");
	print "Sassion start failed. <br>";
	header("Location: http://".$_SERVER['SERVER_NAME']."/index.php?user=".$_REQUEST['user']."&password=".$_REQUEST['password']."&status=".$status);
	exit();
}

function db_authenticate($user, $pass)
{
	$dbhost= 'localhost';
	$dbuser ='prokatau_root';
	$dbpass ='Hftg8bp';
    $retval =0;
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
    $dbname = 'prokatau_rentcar';
    mysqli_select_db($conn,$dbname);
    mysqli_query($conn,"set @retval=(SELECT DISTINCT count(CONCAT(name,last_name,address)) FROM  userinfo WHERE login = '".$user."' AND password = '".$pass."')");
	$result = mysqli_query($conn,"select @retval;");
    if (empty($result)==0){
			$row = mysqli_fetch_row($result);
			//print_r($row);
			mysqli_free_result($result);
			mysqli_close($conn);
			return $row[0];
	}
	else {
		return 0;	
	}
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
				$salt = substr($arr[1], 0, 5);
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
