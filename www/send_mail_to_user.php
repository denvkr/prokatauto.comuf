<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
<title>Аренда автомобилей без залога.</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="msvalidate.01" content="ECF60037541066A8F7B2E327E17B8153" />
<link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>
<h1> Личный кабинет. </h1>
<?php
//require_once 'Mail\IMAPv2.php';
/*
require_once "Mail.php";
 
 $from = "<krasavin_denis@mail.ru>";
 $to = "<krasavin_denis@mail.ru>";
 $subject = "Hi!";
 $body = "Hi,\n\nHow are you?";
 
 $host = "mail.ru";
 $username = "krasavin_denis";
 $password = "Dinterew";
 
 $headers = array ('From' => $from,
   'To' => $to,
   'Subject' => $subject);
 $smtp = Mail::factory('smtp',
   array ('host' => $host,
     'auth' => true,
     'username' => $username,
     'password' => $password));
 
 $mail = $smtp->send($to, $headers, $body);
 
 if (PEAR::isError($mail)) {
   echo("<p>" . $mail->getMessage() . "</p>");
  } else {
   echo("<p>Message successfully sent!</p>");
  }
*/
//$mbox = imap_open("{pop3.mail.ru:110/pop3}", "krasavin_denis@mail.ru", "Dinterew");

/*
echo "Mailboxes\n";
$folders = imap_listmailbox($mbox, "{pop3.mail.ru:110/smtp}", "*");

if ($folders == false) {
    echo "Call failed<br />\n";
} else {
    foreach ($folders as $val) {
        echo $val . "<br />\n";
    }
}

echo "Headers in INBOX\n";
*/
/*
$headers = imap_headers($mbox);

if ($headers == false) {
    echo "Call failed<br />\n";
} else {
    foreach ($headers as $val) {
        echo $val . "<br />\n";
    }
}
*/
// get imap_fetch header and put single lines into array
/*
$header = explode("\n", imap_fetchheader($mbox, 1));
    if (is_array($header) && count($header)) {
        $head = array();
        foreach($header as $line) {
            // is line with additional header?
            if (eregi("^X-", $line)) {
                // separate name and value
                eregi("^([^:]*): (.*)", $line, $arg);
                $head[$arg[1]] = $arg[2];
            }
        }
    }
*/
/*
$message = "Line 1\nLine 2\nLine 3";
$message = wordwrap($message, 70);
$headers = 'From: krasavin_denis@mail.ru' . "\r\n" .
    'Reply-To: krasavin_denis@mail.ru' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
$retval=imap_mail('krasavin_denis@mail.ru' , 'test' , $message,$headers );
echo $retval;
imap_close($mbox);  
*/
//phpinfo();
//var_dump(class_exists('Mail_IMAPv2',false));

include('smtpconfig.php');
include('smtp_mail.php');

//$page = $_SERVER['PHP_SELF'];
//$sec = "1";
//header("Refresh: $sec; url=$page");

$status_auth = db_authenticate($_REQUEST['login'],$_REQUEST['password']);
if ($status_auth == 0)
{
$shalink="{SHA}" . base64_encode(pack("H*", sha1($_REQUEST['login'].$_REQUEST['password'].$_REQUEST['name'].$_REQUEST['last_name'].$_REQUEST['address'])));	
$shalink_mod=str_replace ('+','p',$shalink);

$mail_link_activation="HTTP://".$_SERVER['SERVER_NAME'].'/user_profile.php?mail_link_activation='.$shalink_mod;
//echo $mail_link_activation;
$atom = '[-a-z0-9!#$%&\'*+/=?^_`{|}~]';    // allowed characters for part before "at" character
$domain = '([a-z]([-a-z0-9]*[a-z0-9]+)?)'; // allowed characters for part after "at" character

$regex = '^' . $atom . '+' .         // One or more atom characters.
'(\.' . $atom . '+)*'.               // Followed by zero or more dot separated sets of one or more atom characters.
'@'.                                 // Followed by an "at" character.
'(' . $domain . '{1,63}\.)+'.        // Followed by one or max 63 domain characters (dot separated).
$domain . '{2,63}'.                  // Must be followed by one set consisting a period of two
'$';                                 // or max 63 domain characters.
$email=$_REQUEST['mail_address'];
if (strlen($email) == 0):
	echo '&nbsp;<br>';
else:
	if (eregi($regex, $email)):
		//echo $email . ' matched<br>';
	else:
	   	echo '<strong>'. $email . ' not matched</strong><br>';
header("Location: http://".$_SERVER['SERVER_NAME']."/register_user.php?status=0");
endif;
endif;
$status_store = db_store_user_data($_REQUEST['login'],$_REQUEST['password'],$_REQUEST['mail_address'],$_REQUEST['name'],$_REQUEST['last_name'],$_REQUEST['address'],$_REQUEST['age'],$_REQUEST['drivers_length'],$_REQUEST['rent_request'],$mail_link_activation);

//Send registration activation data to user

$to =$_REQUEST['mail_address'];
$from = "krasavin_denis@mail.ru";
$subject = "Спасибо что зарегистрировались на сайте ".$_SERVER["SERVER_NAME"]."\r\n";
$body ="<html><body>Уважаемый(ая) ".$_REQUEST['login'].", для активации аккаунта на сайте ".$_SERVER["SERVER_NAME"]."<br>"."Пройдите по данной ссылке ".$mail_link_activation."<br> С уважением, администратор.</html></body>" ;
//echo "Prepare post message.<br>";
//echo $to."<br>";
//echo $from."<br>";
//echo $subject."<br>";
//echo $body."<br>";
//echo $SmtpServer."<br>";
//echo $SmtpPort."<br>";
//echo $SmtpUser."<br>";
//echo $SmtpPass."<br>";
//echo $from."<br>";
//echo $to."<br>";
//echo $subject."<br>";
//echo $body."<br>";

//$SMTPMail = new SMTPClient ($SmtpServer, $SmtpPort, $SmtpUser, $SmtpPass, $from, $to, $subject, $body);
//$SMTPChat = $SMTPMail->SendMail();
if (mail($to, $subject, $body,"MIME-VERSION: 1.0\r\nContent-Type: text/html; charset=\"utf-8\"\r\nContent-Transfer-Encoding: 8bit\r\n")){
	echo 'Письмо успешно отправлено!';
 }else{
	echo 'При отправке письма возникла ошибка.';
 }
//print <<<HTMLOUTPUT
//<pre>
//HTMLOUTPUT;
//print_r($SMTPChat);
//print <<<HTMLOUTPUT
//<pre>
//HTMLOUTPUT;

//echo "Спасибо что зарегистрировались на сайте ".$_SERVER["SERVER_NAME"]."<br>";
//echo "Для активации аккаунта вам на почту выслано письмо.";
$status_table='<div id="authenticate_user_level1" class="ul.nav" style="position:absolute; left:30%; top:10%; width:500px; height:30px">';
$status_table.='<table width="500" height="50" border="1">';
$status_table.='  <caption>';
$status_table.='    Данные Авторизации';
$status_table.='  </caption>';
$status_table.='  <tr>';
$status_table.='    <td> Спасибо что зарегистрировались на сайте '.$_SERVER["SERVER_NAME"].'<br> Для активации аккаунта вам на почту выслано письмо.</td>';
$status_table.='  </tr>';
$status_table.='</table>';
$status_table.='</div>';
print($status_table);

}
print <<<HTMLOUTPUT
<div id="copyright_level1" class="ul.nav" style="position:absolute; left: 50%; top:95%; width:200px; height:20px">
<p class="a"> ИП Красавин Д.В. 2011-2013</p>
</div>
HTMLOUTPUT;

header("Location: http://".$_SERVER['SERVER_NAME']."/index.php");

//Проверяем существует ли такой пользователь
function db_authenticate($login, $password)
{
    //$dbhost = 'localhost';
    //$dbuser ='root';//$_REQUEST['user'];
    //$dbpass ='postman';//$_REQUEST['password'];
	$dbhost= 'localhost';
	$dbuser ='prokatau_root';
	$dbpass ='Hftg8bp';
    $retval =0;
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
    $dbname = 'prokatau_rentcar';
    mysqli_select_db($conn,$dbname);
	//mysqli_query("SET @retval = 0;",$conn);
	mysqli_query($conn,"SET NAMES utf8");
    $result = mysqli_query($conn,"set @retval=(SELECT DISTINCT count(CONCAT(name,last_name,address)) FROM ".$dbname.".userinfo WHERE login = ".$login." AND password = ".$password.")");
	$result = mysqli_query($conn,"select @retval;");
    $cnt = $result;
	$str='';
    if (($cnt)) {
		while($row = mysqli_fetch_array($result)) {
      		$str= $row[0];
		}
		print ($retval);
    	mysqli_close($conn);
		return $str;
	}
	else {
    	mysqli_close($conn);
		return 0;
	}
}

function db_store_user_data($login, $password, $mail_address,$user_name,$user_last_name,$address,$age,$drivers_length,$rent_request,$mail_link_activation)
{
    //$dbhost = 'localhost';
    //$dbuser ='root';//$_REQUEST['user'];
    //$dbpass ='postman';//$_REQUEST['password'];
    //$retval =0;
	$dbhost= 'localhost';
	$dbuser ='prokatau_root';
	$dbpass ='Hftg8bp';
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
    $dbname = 'prokatau_rentcar';
    mysqli_select_db($conn,$dbname);
	//print ("call STORE_USER_DATA('".$login."','".$password."','".$mail_address."','".$user_name."','".$user_last_name."','".$address."',".$age.",".$drivers_length.",'".$mail_link_activation."',".$retval.")");
	mysqli_query($conn,"SET NAMES utf8");
    mysqli_query($conn,"SET @retval = 0;");
	$result = mysqli_query($conn,"INSERT INTO userinfo(login,PASSWORD,mail_address,NAME,Last_Name,Address,age,drivers_length,rent_request,rent_event_id,Mail_link_Info) VALUES ('".$login."','".$password."','".$mail_address."','".$user_name."','".$user_last_name."','".$address."',".$age.",".$drivers_length.",'".$rent_request."',-1,'".$mail_link_activation."')");
	if ((mysqli_errno)){
		  //print "Data was inserted cusessfully.";
	}
	//mysqli_free_result($result); 
	mysqli_close($conn);
}
/*
<form method="post" action="">
To:<input type="text" name="to" />
From :<input type='text' name="from" />
Subject :<input type='text' name="sub" />
Message :<textarea name="message"></textarea>
<input type="submit" value=" Send " />
</form>
*/
?>
</body>
</html>