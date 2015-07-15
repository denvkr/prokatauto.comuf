<?php
include 'admin/logged_user_class.php';
include 'context_reader.php';
// *nix style (note capital 'S')
require_once('smarty/libs/Smarty.class.php');
ini_set('display_errors', true);
ini_set ('session.save_handler', 'files');
ini_set('session.gc_maxlifetime', 86400);
date_default_timezone_set('Europe/Moscow');
$site_config='site_config.xml';
$outstr='';
	$retval=get_site_config($site_config,'siteconfig');
	
	 if (count($retval)>0) {
		$dbhost=$retval[0]['db_server_name'];
	 } else {
		$dbhost= 'localhost';
	 }
	 if (count($retval)>0) {
		$dbuser=$retval[0]['db_user_name'];
	 } else {
		$dbuser ='prokatau_root';
	 }
	  if (count($retval)>0) {
		$dbpass=$retval[0]['db_user_password'];
	 } else {
		$dbpass ='Hftg8bp';
	 }
	  if (count($retval)>0) {
		$dbname=$retval[0]['db_name'];
	 } else {
	    $dbname = 'prokatau_rentcar';
	 }

   //session_start();
   // register some session variables
   //session_register("SESSIONID");
   $_SESSION['SESSIONID']=session_id();
   //session_register('id_aut');
   $_SESSION['id_aut']=session_id();
   //session_register("CNT");
   $_SESSION['CNT']=0;
   //session_register('TIME');
   $_SESSION['TIME']=time();
   $_COOKIE['CNT']=0;
   //Read all files in directory
   if (file_exists(addslashes('usersessions/').$_SESSION['SESSIONID'])) {
      //$fp = fopen(addslashes('usersessions/').$_SESSION['SESSIONID'], "w");
   } else {
      //$fp = fopen(addslashes('usersessions/').$_SESSION['SESSIONID'], "x");
   }
   //fwrite($fp,$_SESSION['SESSIONID']."\r\n");
   //fwrite($fp,$_SESSION['CNT']);
   //fclose($fp);
   $mylogged_user_class=new logged_user_class();
   $mylogged_user_class->set_dbhost($dbhost);
   $mylogged_user_class->set_user($dbuser);
   $mylogged_user_class->set_dbpass($dbpass);
   $mylogged_user_class->set_dbname($dbname);
   $mylogged_user_class->add_row_logged_user($_SESSION['SESSIONID'],$_SESSION['SESSIONID'],$_SESSION['CNT']);
   $smarty = new Smarty();
   $smarty->template_dir = 'smarty/smarty/templates/';
   $smarty->compile_dir  = 'smarty/smarty/templates_c/';
   $smarty->config_dir   = 'smarty/smarty/configs/';
   $smarty->cache_dir    = 'smarty/smarty/cache/';
   //$smarty->assign('name','Ned');
   //$smarty->left_delimiter = '<!--{';
   //$smarty->right_delimiter = '}-->';
   //$smarty->assign('foo', 'bar');
   //$smarty->assign('name', 'Albert');
   //** un-comment the following line to show the debug console
   //$smarty->debugging = true;
   //$smarty->display('index.tpl');
$outstr='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
$outstr.='<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">';
$outstr.='<head>';
$outstr.='<title>Аренда автомобилей без залога.</title>';
$outstr.='<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></meta>';
$outstr.='<meta name="msvalidate.01" content="ECF60037541066A8F7B2E327E17B8153" />';
$outstr.='<link href="style.css" type="text/css" rel="stylesheet"></link>';
$outstr.='<meta name="Keywords" content="Аренда авто, аренда автомобиля, аренда автомобилей, аренда автомобилей без залога, аренда автомобиля без водителя, аренда автомобиля с водителем, аренда авто без залога,аренда авто без водителя, аренда авто с водителем, аренда skoda,аренда bmw,аренда ваз" />';
$outstr.='<meta name="description" content="У нас вы можете взять напрокат автомобиль без залога. Стоимость аренды может быть низкой при длительном сроке аренды.Прокат,аренда автомобилей для физических и юридических лиц. Прокат, аренда автомобилей без ограничения пробега." />';
$outstr.='<meta name="robots" content="index,follow" />';
$outstr.='<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.min.js"></script>';
$outstr.='<script type="text/javascript" src="bootstrap/dist/js/bootstrap.min.js" async></script>';
$outstr.='<script type="text/javascript" src="w_load.js" async></script>';
$outstr.='    <!-- Bootstrap core CSS -->';
$outstr.='    <link href="bootstrap/docs/dist/css/bootstrap.min.css" rel="stylesheet">';
$outstr.='    <!-- Bootstrap theme -->';
$outstr.='    <link href="bootstrap/docs/dist/css/bootstrap-theme.min.css" rel="stylesheet">';
$outstr.='    <!-- Custom styles for this template -->';
$outstr.='    <link href="bootstrap/theme.css" rel="stylesheet">';
$outstr.='    <!-- Just for debugging purposes. Don\'t actually copy these 2 lines! -->';
$outstr.='    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->';
$outstr.='    <script src="bootstrap/docs/assets/js/ie-emulation-modes-warning.js"></script>';
$outstr.='    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->';
$outstr.='    <script src="bootstrap/docs/assets/js/ie10-viewport-bug-workaround.js"></script>';
$outstr.='    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->';
$outstr.='    <!--[if lt IE 9]>';
$outstr.='      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>';
$outstr.='      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>';
$outstr.='    <![endif]-->';
$outstr.='<script type="text/javascript">';
$outstr.='function BrowserInfo() {';
$outstr.=' uaVers="";';
$outstr.='	if (window.navigator.userAgent.indexOf("Opera") >= 0)';
$outstr.='	  {';
$outstr.='	   ua = "Opera";';
$outstr.='	   uaVers=window.navigator.userAgent.substr(window.navigator.userAgent.indexOf("Opera")+6,4);';
$outstr.='	  }';
$outstr.='	else';
$outstr.='	if (window.navigator.userAgent.indexOf("Gecko") >= 0)';// (Mozilla, Netscape, FireFox)
$outstr.='	  {';
$outstr.='	   ua = "Netscape";';
$outstr.='	   uaVers=window.navigator.userAgent.substr(window.navigator.userAgent.indexOf("Gecko")+6,8)+ " ("+ window.navigator.userAgent.substr(8,3) + ")";';
$outstr.='	  }';
$outstr.='	else';
$outstr.='	if (window.navigator.userAgent.indexOf("MSIE") >= 0)';
$outstr.='	  {';
$outstr.='	   ua = "Explorer";';
$outstr.='	   uaVers=window.navigator.userAgent.substr(window.navigator.userAgent.indexOf("MSIE")+5,3);';
$outstr.='	  }';
$outstr.='	else';
$outstr.='	   ua = window.navigator.appName;';
$outstr.='return ua;';
$outstr.='}';
$outstr.='</script>';
$outstr.='</head>';
$outstr.='<body id="body_container" style="position: absolute; width:100%;height:100%;max-width:100%;max-height:100%;" onresize="btn_font_size()">'; //onload="javascript:Dimension();" width: 1160px; height: 800px;visibility:hidden;
$outstr.='<script type="text/javascript">';
$outstr.='function Dimension () {';
$outstr.='	var Width = (window.screen.width);';
$outstr.='	var Height = (window.screen.height);';
$outstr.='	if (Width < 1160) {';
$outstr.='		document.getElementById("container_main").style.left="0px";';
$outstr.='	} else if (Width >= 1160) {';
$outstr.='		var left_size=Math.round((Width-1160)/2);';
$outstr.='		document.getElementById("container_main").style.left=String(left_size)+"px";';
$outstr.='	}';
$outstr.='}';
$outstr.='</script>';
$outstr.='<div class="container1 container-fluid" id="container_main">'; //style="position:relative; left:0px; top:0px; width:1160px; height:800px; z-index:0;"
$outstr.='<!--<div class="bg-info" id="h1_level">-->';//style="position:relative;display:block; left:0px; top:0px; width:1160px; height:40px; z-index:0;border-radius: 3px;border: 1px solid #000;overflow: hidden;"
$outstr.='<h1 class="bg-info" style="border-radius: 3px;border: 1px solid #000;overflow: hidden;">Аренда автомобилей без залога.</h1>';//style="position:relative;left:0px; top:0px; width:1160px; height:40px; z-index:0; color:white;margin:0 0 0 0;"
$outstr.='<!--</div>-->';
$outstr.='<!--<div class="row" style="width:100%; height:50px; z-index:0;">-->';//left:0px; top:10px;
$outstr.='<div class="navbar navbar-default">';
$outstr.='        <div class="container">';
$outstr.='          <div class="navbar-header">';
$outstr.='            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">';
$outstr.='              <span class="sr-only">Toggle navigation</span>';
$outstr.='              <span class="icon-bar"></span>';
$outstr.='              <span class="icon-bar"></span>';
$outstr.='              <span class="icon-bar"></span>';
$outstr.='            </button>';
$outstr.='            <a class="navbar-brand" href="#" onclick="gotopage(0);">О проекте</a>';
$outstr.='          </div>';
$outstr.='          <div class="navbar-collapse collapse">';
$outstr.='            <ul class="nav navbar-nav">';
$outstr.='              <li onclick="gotopage(1);"><a href="#">Новости,акции</a></li>';
$outstr.='              <li onclick="gotopage(2);"><a href="#">Правила аренды</a></li>';
$outstr.='              <li onclick="gotopage(3);"><a href="#">Парк автомобилей</a></li>';
$outstr.='				<li onclick="gotopage(4);"><a href="#">Контакты</a></li>';
$outstr.='            </ul>';
$outstr.='          </div><!--/.nav-collapse -->';
$outstr.='        </div>';
$outstr.='</div>';
$outstr.='<!--</div>-->';
$outstr.='<script type="text/javascript">';
$outstr.='function gotopage(Page){';
$outstr.='	switch (Page)';
$outstr.='	{';
$outstr.='	case 0:';
$outstr.='		window.location.href = "http://"+location.host+"/index.php";';
$outstr.='		break;';
$outstr.='	case 1:';
$outstr.='		window.location.href = "http://"+location.host+"/news.php";';
$outstr.='		break;';
$outstr.='	case 2:';
$outstr.='		window.location.href = "http://"+location.host+"/rentrules.php";';
$outstr.='		break;';
$outstr.='	case 3:';
$outstr.='		window.location.href = "http://"+location.host+"/cars.php";';
$outstr.='		break;';
$outstr.='    case 4:';
$outstr.='		window.location.href = "http://"+location.host+"/contact.php";';
$outstr.='		break;';
$outstr.='	};';
$outstr.='}';
$outstr.='</script>';
//$outstr='<div id="menu_level1" class="ul.menu1" style="position:relative; left:0%; top:10%; width:150px; height:20px; z-index:0">';
//$outstr.='<table border = "0">';
//$outstr.='<tr onclick="gotopage(1);">';
//$outstr.='<td class="ul.menu1" onmouseover="this.style.background=\'red\'"; onmouseout="this.style.background=\'#FF9900\'">Новости, акции</td>';
//$outstr.='</tr>';
//$outstr.='<tr onclick="gotopage(2);">';
//$outstr.='<td class="ul.menu1" onmouseover="this.style.background=\'red\'"; onmouseout="this.style.background=\'#FF9900\'">Правила аренды</td>';
//$outstr.='</tr>';
//$outstr.='<tr onclick="gotopage(3);">';
//$outstr.='<td class="ul.menu1" onmouseover="this.style.background=\'red\'"; onmouseout="this.style.background=\'#FF9900\'">Парк автомобилей</td>';
//$outstr.='</tr>';
//$outstr.='<tr onclick="gotopage(4);">';
//$outstr.='<td class="ul.menu1" onmouseover="this.style.background=\'red\'"; onmouseout="this.style.background=\'#FF9900\'">Контакты</td>';
//$outstr.='</tr>';
//$outstr.='</table>';
//$outstr.='</div>';
$outstr.='<!--<div class="content_level1" style="position:relative;display:block; left:0px; top:20px; width:100%; height:656px; z-index:0;border-radius: 3px;border: 1px solid #000;overflow: hidden;">-->';
$outstr.='<!--<table style="position:relative;display:block;left:0px;top:0px;width:100%;height:656px;border:0px;float:left;">-->';
$outstr.='<!--первая строка таблицы-->';
$outstr.='<!--<tr>-->';
$outstr.='<!--<td>-->';
$outstr.='<div class="row">';
$outstr.='<div class="col-xs-4">';
$outstr.='<div class="bg-info" id="icq_status_level1">';//style="position:relative; left:0px; top:-120px; width:230px; height:20px;"
$outstr.='<img src="http://status.icq.com/online.gif?icq=344360162&img=5" alt="Пользователь 344360162" onclick="gotopage(5);"/>';
$outstr.='ICQ 344360162';
$outstr.='</div>';
$outstr.='<div class="bg-info" id="mail_ref_level1">';//style="position:relative; left:0px; top:-90px; width:230px;height:20px;"
$outstr.='<img src="mail.png"/>';
$outstr.='prokat.auto@gmail.com';
$outstr.='</div>';
$outstr.='<!--<div class="bg-info" id="login_table_level1">-->';//style="position:relative; left:0px; top:1px; width:230px; height:20px;"
$outstr.='<form class="bg-info" id="loginform" class="form-signin" role="form" method="post" action="login.php">';
$outstr.='<h2 class="form-signin-heading">Авторизация</h2>';
$outstr.='<input type="text" name="user" class="form-control" placeholder="Email address" required autofocus>';
$outstr.='<input type="password" name="password" class="form-control" placeholder="Password" required>';
$outstr.='<label class="checkbox">';
$outstr.='<input type="checkbox" value="Запомнить"> Запомнить';
$outstr.='</label>';
$outstr.='<button class="btn btn-lg btn-primary btn-block" name="_Sign_In" type="submit" form="loginform" formmethod="post">Войти</button>';
$outstr.='</form>';
//$outstr.='</div> <!-- /container -->';
//$outstr.='<form id="loginform" method="post" action="login.php">';
//$outstr.='Авторизация <br>';
//$outstr.='<table style="width:100%;border:1px solid black;background-color:#FF9900;">';
//$outstr.='<tr style="max-width:50px; min-width:50px; max-height:10px; min-height:10px; width:50px; height:10px;">';
//$outstr.='<td>Имя:</td>';
//$outstr.='</tr>';
//$outstr.='<tr style="max-width:50px; min-width:50px; max-height:10px; min-height:10px; width:50px; height:10px;">';
//$outstr.='<td style="max-width:50px; min-width:50px; max-height:10px; min-height:10px; width:50px; height:10px;"> <input type="text" name="user" align="left" style="max-width:135px; min-width:135px; max-height:20px; min-height:20px; width:135px; height:20px;"></td>';
//$outstr.='</tr>';
//$outstr.='<tr style="max-width:50px; min-width:50px; max-height:10px; min-height:10px; width:50px; height:10px;">';
//$outstr.='<td style="max-width:50px; min-width:50px; max-height:10px; min-height:10px; width:50px; height:10px;">Пароль:</td>';
//$outstr.='</tr>';
//$outstr.='<tr style="max-width:50px; min-width:50px; max-height:10px; min-height:10px; width:50px; height:10px;">';
//$outstr.='<td style="max-width:50px; min-width:50px; max-height:10px; min-height:10px; width:50px; height:10px;"><input type="password" name="password" align="left" style="max-width:135px; min-width:135px; max-height:20px; min-height:20px; width:135px; height:20px;"></td>';
//$outstr.='</tr>';
//$outstr.='</table>';
//$outstr.='<button name="_Sign_In" type="submit" class="btn btn-xs btn-default" value="Войти" form="loginform" formmethod="post">Войти</button>';//'<input type="submit" name="_Sign_In" value="Войти" style="max-width:80px; min-width:80px; max-height:25px; min-height:25px; width:80px; height:25px;" >';
//$outstr.='</form>';
$outstr.='<!--</div>-->';
$outstr.='<!--<div id="register_new_user_level1">-->';//style="position:relative; left:0px; top:-80px; width:150px; height:30px"
$outstr.='<form id="requestauto" method="post" action="register_user.php?si='.$_SESSION['SESSIONID'].'">';
$outstr.='<button name="_Registering" class="btn btn-lg btn-primary btn-block" type="submit" form="requestauto" formmethod="post">Оставить запрос на авто</button>';
//$outstr.='<button name="_Registering" type="submit" class="btn btn-xs btn-default" value="Оставить запрос на авто" form="requestauto" formmethod="post">Оставить запрос на авто</button>';//'<input type="submit" name="_Registering" value="Оставить запрос на авт.">';
$outstr.='</form>';
$outstr.='<!--</div>-->';
$outstr.='<!--</td>-->';
$outstr.='</div>';

$myreader=new context_reader();

//читаем za_rulem auto_ru
//$site_info=$myreader->read("za_rulem");
$site_info2=$myreader->read('auto_ru');

//$pattern = '/^\="leed"/';
//preg_match($pattern ,$site_info, $matches, PREG_OFFSET_CAPTURE);
//print_r($matches);

$outstr.='<!--<td>-->';
$outstr.='<div class="col-xs-4">';
$outstr.='<div class="bg-info" id="rss_reader">';//style="position:relative; left: 1px; top:1px; width:700px; height:600px; overflow:hidden;"

//$outstr.= $site_info;
$outstr.= $site_info2;

$outstr.='</div>';
$outstr.='<!--</td>-->';
$outstr.='</div>';
$outstr.='<!--<td>-->';
$outstr.='<div class="col-xs-4">';
$outstr.='<div class="bg-info" id="subscribe_level1">';//style="position:relative; left:20px; top:-90px; width:230px;height:60px;"
$outstr.='<form action="http://subscribe.ru/member/quick" method="post" target="_top">';
$outstr.='<table border="1" cellspacing="0" cellpadding="2" style="margin-left:30%;">';
$outstr.='<tr><td bgcolor="#FCF5E9" align="center" colspan="2">';
$outstr.='<font size="-1">Рассылки';
$outstr.='<a href="http://subscribe.ru/"><b>Subscribe.Ru</b></a></font>';
$outstr.='</td>';
$outstr.='</tr>';
$outstr.='<tr><td bgcolor="#FFFFFF" align="center" valign="middle" colspan="2">';
$outstr.='<input type="hidden" name="addgrp" value="rss.8890">';
$outstr.='<font size="-1">Лента';
$outstr.='<a href="http://subscribe.ru/catalog/rss.8890" target="_top">"Comavto.ru - всё о подержанных автомобилях"</a><br />';
$outstr.='<input type="text" name="email" size="20" maxlength="80" value="ваш e-mail"';
$outstr.='style="font-size: 9pt">';
$outstr.='<input type=submit value="Подписаться" style="font-size: 9pt">';
$outstr.='</font>';
$outstr.='</td>';
$outstr.='</tr>';
$outstr.='</table>';
$outstr.='</form>';
$outstr.='</div>';
$outstr.='<!--</td>-->';
$outstr.='<!--</tr>-->';
$outstr.='</div>';
$outstr.='</div>';

$outstr.='<!--вторая строка таблицы-->';
$outstr.='<!--<tr>-->';
$outstr.='<!--<td>-->';
$outstr.='<div class="row">';
$outstr.='<div class="col-xs-4">';
$outstr.='<!-- START OF HIT COUNTER CODE -->';
$outstr.='<br><script language="JavaScript" src="http://www.counter160.com/js.js?img=2"></script><br><a href="http://www.000webhost.com"><img src="http://www.counter160.com/images/2/left.png" alt="Free web hosting" border="0" align="texttop"></a><a href="http://www.hosting24.com"><img alt="Web hosting" src="http://www.counter160.com/images/2/right.png" border="0" align="texttop"></a>';
$outstr.='<!-- END OF HIT COUNTER CODE -->';
$outstr.='<!--</td>-->';
$outstr.='</div>';
$outstr.='<div class="col-xs-4">';
$outstr.='<!--<td>-->';
$outstr.='<!--<div id="copyright_level1">-->'; //style="position:relative; left: 40%; top:95%; width:200px; height:20px;font-size:13px;"
$outstr.='<p class="bg-info"> ИП Красавин Д.В. 2011-2015</p>';
$outstr.='<!--</div>-->';
$outstr.='<!--</td>-->';
$outstr.='</div>';
$outstr.='<div class="col-xs-4">';
$outstr.='<!--<td>-->';
$outstr.='<!--</td>-->';
$outstr.='</div>';
$outstr.='<!--</tr>-->';
$outstr.='</div>';
$outstr.='<!--</table>-->';
$outstr.='<!--</div>-->';
//print $outstr;
$smarty->assign('outstr', $outstr);
//** un-comment the following line to show the debug console
//$smarty->debugging = true;
$smarty->display('index.tpl');

//HTMLOUTPUT;
if ((isset($_REQUEST['status']))) {
	if ($_REQUEST['status']==0) {
		$status_table='<div id="authenticate_user_level1" class="ul" style="position:absolute; left:30%; top:10%; width:500px; height:30px">';
		$status_table.='<div class="alert alert-warning" role="alert">';
		$status_table.='<strong>Данные Авторизации</strong> Данного пользователя не существует. Пожалуйста зарегистрируйтесь.';
		$status_table.='</div>';
		//$status_table.='<table width="500" height="50" border="1">';
		//$status_table.='  <caption>';
		//$status_table.='    Данные Авторизации';
		//$status_table.='  </caption>';
		//$status_table.='  <tr>';
		//$status_table.='    <td> Данного пользователя не существует. Пожалуйста зарегистрируйтесь. </td>';
		//$status_table.='  </tr>';
		//$status_table.='</table>';
		//$status_table.='</div>';
		print($status_table);
	}
}

function get_site_config($xmlfile,$attribute)
{
$xmlread = new XMLReader;
if (!$xmlread->open($xmlfile,'utf-8')) {
    die("Failed to open xml  file");
}
// Вы должны использовать это
$xmlread->setParserProperty(XMLReader::VALIDATE, false);
//var_dump($xmlread->isValid());
//$xmlread->moveToAttribute($attribute);
//$node_data=$xmlread->readString();
$idx=0;
//$xmlread->next();
$xmlread->read();
  if (($xmlread->nodeType == XMLReader::ELEMENT) && ($xmlread->name == $attribute)) {
    // считываем атрибуты
	$xmlread->read();
	$xmlread->read();
	$xmlarr[$idx][$xmlread->name]= $xmlread->readstring();
	$xmlread->read();	
	$xmlread->read();	
	$xmlread->read();
	$xmlread->read();	
	$xmlarr[$idx][$xmlread->name] = $xmlread->readstring();
	$xmlread->read();
	$xmlread->read();
	$xmlread->read();
	$xmlread->read();	
	$xmlarr[$idx][$xmlread->name] = $xmlread->readstring();
	$xmlread->read();
	$xmlread->read();
	$xmlread->read();	
	$xmlread->read();
	$xmlarr[$idx][$xmlread->name] = $xmlread->readstring();
	$xmlread->read();
	$xmlread->read();
	$xmlread->read();	
	$xmlread->read();
	$xmlarr[$idx][$xmlread->name] = $xmlread->readstring();
    $idx ++;
  }
  elseif (($reader->nodeType == XMLReader::END_ELEMENT) && ($reader->name == $attribute)) {
     break;
  }
$xmlread->close();
if (libxml_get_last_error()) {
    echo "There was an error reading the xml file";
}
//echo $xmlarr[0]['db_server_name'];
  return $xmlarr;
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
</div>
</body>
</html>
