<?php
print <<<HTMLOUTPUT
<form method="post" action="/admin/authenticate_next.php">
<table border = "1">
<tr>
<td>Your Name:</td><td> <input type="text" name="UserName" align="left"></td>
</tr>
<tr>
<td>Your Password:</td> <td><input type="password" name="UserPassword" align="left"></td>
</tr>
<tr>
<td>E-Mail:</td> <td><input type="text" name="UserEMail" align="left"></td>
</tr>
</table>
<input type="submit" name="_Sign_In" value="Sign In">
</form>
HTMLOUTPUT;

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
//header("Location: http://localhost:82/userinfo.php?user=$user&password=$password");
?>
