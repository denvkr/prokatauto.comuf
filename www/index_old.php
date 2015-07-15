<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
<title>Аренда автомобилей без залога.</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></meta>
<link href="style.css" type="text/css" rel="stylesheet"></link>
</head>

<script type="text/javascript" language="javascript">
function gotopage(Page){
	switch (Page)
	{
	case 2:
		window.location.href = 'http://prokatauto.comuf.com//rentrules.php';
		break;
	case 3:
		window.location.href = 'http://prokatauto.comuf.com//cars.php';
		break;
    case 4:
		window.location.href = 'http://prokatauto.comuf.com//contact.php';
		break;
    case 5:
		window.location.href = 'http://prokatauto.comuf.com//contact.php';
		break;
	};	
}

function Dimension (Width,Height)
{
var Width = (window.screen.width); 
var Height = (window.screen.height);       
 
if ((Width >= 800 && Width < 1024) && (Height >= 600 && Height < 768))
{
        document.location.href = 'main1.html';    
}
        else    
if ((Width >= 1024 && Width < 1280) && (Height >= 768 && Height < 800))
{
        document.location.href = 'main2.html';    
}
        else    
if ((Width >= 1280) && (Height >= 800 && Height < 1024))
{
document.location.href = 'main3.html';    
}
else    
{
        document.location.href = 'main.html';    
};
}
function BrowserInfo()
{
uaVers='' // uaVers     ,  ,   ,    
	if (window.navigator.userAgent.indexOf ("Opera") >= 0)
	  {
	   ua = 'Opera';
	   uaVers=window.navigator.userAgent.substr(window.navigator.userAgent.indexOf("Opera")+6,4);
	  }
	else
	if (window.navigator.userAgent.indexOf ("Gecko") >= 0) // (Mozilla, Netscape, FireFox)
	  {        //    ,                 
	   ua = 'Netscape';
	   uaVers=window.navigator.userAgent.substr(window.navigator.userAgent.indexOf("Gecko")+6,8)+ ' ('+ window.navigator.userAgent.substr(8,3) + ')';
	  }
	else
	if (window.navigator.userAgent.indexOf ("MSIE") >= 0)
	  {
	   ua = 'Explorer';
	   uaVers=window.navigator.userAgent.substr(window.navigator.userAgent.indexOf("MSIE")+5,3);
	  }
	else
	   ua = window.navigator.appName; //   
return ua;
}

</script>

<body>
<h1 color="white"> Аренда автомобилей без залога.  </h1>
<?php
include 'admin/logged_user_class.php';

if (!session_register("SESSIONID")){

   session_start();
   // register some session variables
   session_register("SESSIONID");
   $_SESSION['SESSIONID']=session_id();
   session_register('id_aut');
   $_SESSION['id_aut']=session_id();
   session_register("CNT");
   $_SESSION['CNT']=0;
   $_COOKIE['CNT']=0;
   //Read all files in directory
   $TrackDir=opendir('UserSessions');
   if (file_exists("UserSessions//".$_COOKIE['PHPSESSID'])) {
      $fp = fopen("UserSessions//".$_COOKIE['PHPSESSID'], "w+");
   } else {
      $fp = fopen("UserSessions//".$_COOKIE['PHPSESSID'], "x+");
   }
   fwrite($fp,$_COOKIE['PHPSESSID']."\r\n");
   fwrite($fp,$_COOKIE['CNT']);
   fclose($fp);

   $mydictionary_worker_class=new logged_user_class();
   $mydictionary_worker_class->set_dbhost('localhost');
   $mydictionary_worker_class->set_user('root');
   $mydictionary_worker_class->set_dbpass('postman');
   $mydictionary_worker_class->add_logged_user_info(1);
   //$mydictionary_worker_class->update_row_logged_user($_SESSION['SESSION_ID'],$_SESSION['SESSION_ID'],$_SESSION['SESSION_ID']." ".$_SESSION['CNT']);
   echo $mydictionary_worker_class->add_row_logged_user($_COOKIE['PHPSESSID'],$_COOKIE['PHPSESSID'],$_SESSION['CNT']);
}

print <<<HTMLOUTPUT

<div id="menu_level1" class="ul.menu1" style="position:absolute; left:0%; top:8%; width:150px; height:20px; z-index:0">

<table border = "0">
<tr onclick="gotopage(1);>
<td class="ul.menu1" onmouseover="this.style.background='red'"; onmouseout="this.style.background='#FF9900'">Новости, акции</td>
</tr>
<tr onclick="gotopage(2);">
<td class="ul.menu1" onmouseover="this.style.background='red'"; onmouseout="this.style.background='#FF9900'">Правила аренды</td>
</tr>
<tr onclick="gotopage(3);">
<td class="ul.menu1" onmouseover="this.style.background='red'"; onmouseout="this.style.background='#FF9900'">Парк автомобилей</td>
</tr>
<tr onclick="gotopage(4);">
<td class="ul.menu1" onmouseover="this.style.background='red'"; onmouseout="this.style.background='#FF9900'">Контакты</td>
</tr>
</table>
</div>

<div id="icq_status_level1" class="ul.nav" style="position:absolute; left:0%; top:25%; width:150px;height:20px">
<img src="http://status.icq.com/online.gif?icq=344360162&img=5" alt="Пользователь 344360162" onclick="gotopage(5);"/>
ICQ 344360162
</div>

<div id="mail_ref_level1" class="ul.nav" style="position:absolute; left:0%; top:28%; width:150px;height:20px">
<img src="mail.png"/>
krasavin.prokat@mail.ru
</div>
<form method="post" action="login.php">
<div id="login_table_level1" class="ul.nav" style="position:absolute; left:0%; top:40%; width:150px; height:20px">
Авторизация <br>
<table border = "0">
<tr>
<td>Имя:</td>
</tr>
<tr>
<td> <input type="text" name="user" align="left"></td>
</tr>
<tr>
<td>Пароль:</td>
</tr>
<tr>
<td><input type="password" name="password" align="left"></td>
</tr>
</table>
<input type="submit" name="_Sign_In" value="Войти">
</div>
</form>

<div id="copyright_level1" class="ul.nav" style="position:absolute; left: 50%; top:95%; width:150px; height:20px">
<p class="a"> ИП Красавин Д.В. 2011</p>
</div>
<form method="post" action="register_user.php">
<div id="register_new_user_level1" class="ul.nav" style="position:absolute; left:0%; top:57%; width:150px; height:20px">
<input type="submit" name="_Registering" value="Зарегистрироваться">
</div>
</form>

HTMLOUTPUT;

if ((isset($_REQUEST['status']))) {
	if ($_REQUEST['status']==0) {
		$status_table='<div id="authenticate_user_level1" class="ul.nav" style="position:absolute; left:30%; top:10%; width:500px; height:30px">';
		$status_table.='<table width="500" height="50" border="1">';
		$status_table.='  <caption>';
		$status_table.='    Данные Авторизации';
		$status_table.='  </caption>';
		$status_table.='  <tr>';
		$status_table.='    <td> Данного пользователя не существует. Пожалуйста зарегистрируйтесь. </td>';
		$status_table.='  </tr>';
		$status_table.='</table>';
		$status_table.='</div>';
		print($status_table);
	}
}
//echo $_SERVER['HTTP_USER_AGENT'] . "<br>";
//if(ini_get("browscap")) {
//$browser = get_browser(null,true);
//print <<<HTMLOUTPUT
//<div id="level3" class="ul.nav" style="position:absolute; left:20%; top:10%; width:550px; height:620px">
//<p class="a">
//HTMLOUTPUT;
//while (list ($key, $value) = each ($browser)) {
//if ($value == "") {
// $value = 0;
//}
//print "$key : $value <br>";
//}
//print <<<HTMLOUTPUT
//</p>
//</div>
//HTMLOUTPUT;

//}
?>
</body>
</html>