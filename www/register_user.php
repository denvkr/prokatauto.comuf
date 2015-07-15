
<?php
//header('Last-Modified: '.gmdate('D, d M Y H:i:s', filemtime($fn)).' GMT', true, 304);
//header("Location: http://".$_SERVER['SERVER_NAME']."/register_user.php?si=".$_SESSION['SESSIONID']);
//header( 'Expires: Sat, 30 Aug 2013 05:00:00 GMT' );
//header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
//header( 'Cache-Control: no-store, no-cache, must-revalidate' );
//header( 'Cache-Control: post-check=0, pre-check=0', false );
//header( 'Pragma: no-cache' ); 
//header("Location: http://".$_SERVER['SERVER_NAME']."/register_user.php?si=".$_SESSION['SESSIONID']);
//echo $ses_id;
//Генерим сессию для страницы
$site_config='site_config.xml';
if (!(isset($_REQUEST['si']))){
	die;
} else {
	if ($_REQUEST['data_modification']==1){
		$cur_session_id=db_get_session_id($_REQUEST['si']);
		$ses_id=$cur_session_id;	
		$main_session_link=$_REQUEST['si'];
	} else {
		session_start();
		session_regenerate_id();	
		$ses_id=session_id();
		$main_session_link=$_REQUEST['si'];
	}
}

if ($_REQUEST['data_modification']==1){
	$cur_session_id=db_get_session_id($_REQUEST['si']);
	if (($_REQUEST['captcha'])!=substr($cur_session_id,-4,4)){
		//echo $_REQUEST['captcha']." ".substr($cur_session_id,-4,4);
		die('Символы на картинке введены неверно!');
	} else {
		//$status_store = db_update_user_data($_REQUEST['login'],$_REQUEST['password'],$_REQUEST['mail_address'],$_REQUEST['name'],$_REQUEST['last_name'],$_REQUEST['address'],$_REQUEST['age'],$_REQUEST['drivers_length'],$_REQUEST['rent_request'],$mail_link_activation);
	header("Location: http://".$_SERVER['SERVER_NAME']."/send_mail_to_user.php?login=".$_REQUEST['login']."&password=".$_REQUEST['password']."&mail_address=".$_REQUEST['mail_address']."&name=".$_REQUEST['name']."&last_name=".$_REQUEST['last_name']."&address=".$_REQUEST['address']."&age=".$_REQUEST['age']."&drivers_length=".$_REQUEST['drivers_length']."&rent_request=".$_REQUEST['rent_request']);
	}
	session_start();
	session_regenerate_id();	
	$ses_id=session_id();
}

db_store_session_info($ses_id,$main_session_link);

//echo $_SERVER['SERVER_NAME'];
//header("Location: http://".$_SERVER['SERVER_NAME']."/register_user.php?si=".$ses_id);
$outstr='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
$outstr.='<html xmlns="http://www.w3.org/1999/xhtml">';
$outstr.='<head>';
$outstr.='<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
$outstr.='<meta name="msvalidate.01" content="ECF60037541066A8F7B2E327E17B8153" />';
$outstr.='<link href="style.css" type="text/css" rel="stylesheet" />';
$outstr.='<title>Аренда автомобилей без залога.-Отправить запрос</title>';
$outstr.='<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.min.js"></script>';
$outstr.='<script src="jquery-ui-1.11.2.custom/jquery-ui.js"></script>';
$outstr.='<link rel="stylesheet" href="jquery-ui-1.11.2.custom/jquery-ui.theme.css">';
$outstr.='<link rel="stylesheet" href="jquery-ui-1.11.2.custom/jquery-ui.structure.css">';
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
$outstr.='<script type="text/javascript" src="form_events.js"></script>';
$outstr.='</head>';
$outstr.='<body id="body_container" style="position: absolute; width: 1160px; height: 800px;visibility:hidden;">';
$outstr.='<noscript>';
$outstr.='Для полной функциональности этого сайта необходимо включить JavaScript.';
$outstr.='Вот <a href="http://www.enable-javascript.com/ru/" target="_blank">';
$outstr.='инструкции, как включить JavaScript в вашем браузере</ a>.';
$outstr.='</noscript>';
$outstr.='<div class="container1" id="container_main" style="position:relative; left:0px; top:0px; width:1160px; height:800px; z-index:0;">';
$outstr.='<div class="h1_level1" id="h1_level" style="position:relative;display:block; left:0px; top:0px; width:1160px; height:40px; z-index:0;border-radius: 3px;border: 1px solid #000;overflow: hidden;">';
$outstr.='<h1 style="position:relative;left:0px; top:0px; width:1160px; height:40px; z-index:0; color:white;margin:0 0 0 0;">Регистрация пользователя.</h1>';
$outstr.='</div>';
$outstr.='<a href="http://autovarendu.biz/"><button class="btn btn-lg btn-primary btn-block" style="position:relative;top:7px;"name="_BakToMain" value="На главную">На главную</button></a>';
$outstr.='<div class="content_level1" style="position:relative;display:block; left:0px; top:20px; width:100%; height:656px; z-index:0;border-radius: 3px;border: 1px solid #000;overflow: hidden;">';
$outstr.='<form method="post" id="loginform" role="form" action="/register_user.php?si='.$main_session_link.'&data_modification=1">';
$outstr.='<div id="userinfo_level1" class="ul.nav" style="position: relative;margin-left: 26%;margin-top: 5%;width: 300px;height: 150px;">';
$outstr.='<table border="1" cols="3" style="display block;">';
$outstr.='<tr>';
$outstr.='<td>';
$outstr.='Логин:';
$outstr.='</td>';
$outstr.='<td>';
$outstr.='<input type="text" class="ui-widget ui-state-default ui-selectmenu-button" id="login" name="login" value="'.$_REQUEST['login'].'" onfocusout="checkresult_login(this);"/><br>';
$outstr.='</td>';
$outstr.='<td>';
$outstr.='Пример: langust,opetron...';
$outstr.='</td>';
$outstr.='</tr>';
$outstr.='<tr>';
$outstr.='<td>';
$outstr.='Пароль:';
$outstr.='</td>';
$outstr.='<td>';
$outstr.='<input type="password" class="ui-widget ui-state-default ui-selectmenu-button" id="password" name="password" disabled value="'.$_REQUEST['password'].'" onblur="checkresult_password(this)" onfocus="console.log(\'focused\')"/><br>';
$outstr.='</td>';
$outstr.='<td>';
$outstr.='Пример: Ghtdtl23,3gJrF42...';
$outstr.='</td>';
$outstr.='</tr>';
$outstr.='<tr>';
$outstr.='<td>';
$outstr.='Ел. почта:';
$outstr.='</td>';
$outstr.='<td>';
$outstr.='<input type="email" class="ui-widget ui-state-default ui-selectmenu-button" id="email" name="mail_address" disabled="1" value="'.$_REQUEST['mail_address'].'" onblur="checkresult_email(this)"/><br>';
$outstr.='</td>';
$outstr.='<td>';
$outstr.='Пример: ivanov@yandex.ru,i.pertoff@gmail.com...';
$outstr.='</td>';
$outstr.='</tr>';
$outstr.='<tr>';
$outstr.='<td>';
$outstr.='Имя:';
$outstr.='</td>';
$outstr.='<td>';
$outstr.='<input type="text" class="ui-widget ui-state-default ui-selectmenu-button" id="firstname" name="name" disabled="1" value="'.$_REQUEST['name'].'" onblur="checkresult_firstname(this)"/><br>';
$outstr.='</td>';
$outstr.='<td>';
$outstr.='Пример: Ivan,Petr,Иван,Петр...';
$outstr.='</td>';
$outstr.='</tr>';
$outstr.='<tr>';
$outstr.='<td>';
$outstr.='Фамилия:';
$outstr.='</td>';
$outstr.='<td>';
$outstr.='<input type="text" class="ui-widget ui-state-default ui-selectmenu-button" id="lastname" name="last_name" disabled="1" value="'.$_REQUEST['last_name'].'" onblur="checkresult_lastname(this)"/><br>';
$outstr.='</td>';
$outstr.='<td>';
$outstr.='Пример: Ivanov,Petroff,Иванов,Петров...';
$outstr.='</td>';
$outstr.='</tr>';
$outstr.='<tr>';
$outstr.='<td>';
$outstr.='Дом. адрес:';
$outstr.='</td>';
$outstr.='<td>';
$outstr.='<input type="text" class="ui-widget ui-state-default ui-selectmenu-button" id="address" name="address" disabled="1" value="'.$_REQUEST['address'].'" onblur="checkresult_address(this)"/><br>';
$outstr.='</td>';
$outstr.='<td>';
$outstr.='Пример: 11111,Иваново,ул. складческая, д 6/1';
$outstr.='</td>';
$outstr.='</tr>';
$outstr.='<tr>';
$outstr.='<td>';
$outstr.='Возраст:';
$outstr.='</td>';
$outstr.='<td>';
$outstr.='<select id="age" class="ui-widget ui-state-default ui-selectmenu-button" name="age" value="'.$_REQUEST['age'].'" onfocusout="checkresult_age(this)" style="width:60px">';
$outstr.='<option>25</option>';
$outstr.='<option>26</option>';
$outstr.='<option>27</option>';
$outstr.='<option>28</option>';
$outstr.='<option>29</option>';
$outstr.='<option>30</option>';
$outstr.='<option>31</option>';
$outstr.='<option>32</option>';
$outstr.='<option>33</option>';
$outstr.='<option>34</option>';
$outstr.='<option>35</option>';
$outstr.='<option>36</option>';
$outstr.='<option>37</option>';
$outstr.='<option>38</option>';
$outstr.='<option>39</option>';
$outstr.='<option>40</option>';
$outstr.='<option>41</option>';
$outstr.='<option>42</option>';
$outstr.='<option>43</option>';
$outstr.='<option>44</option>';
$outstr.='<option>45</option>';
$outstr.='<option>46</option>';
$outstr.='<option>47</option>';
$outstr.='<option>48</option>';
$outstr.='<option>49</option>';
$outstr.='<option>50</option>';
$outstr.='<option>51</option>';
$outstr.='<option>52</option>';
$outstr.='<option>53</option>';
$outstr.='<option>54</option>';
$outstr.='<option>55</option>';
$outstr.='<option>56</option>';
$outstr.='<option>57</option>';
$outstr.='<option>58</option>';
$outstr.='<option>59</option>';
$outstr.='<option>60</option>';
$outstr.='</select>';
$outstr.='<br>';
$outstr.='</td>';
$outstr.='<td>';
$outstr.='Пример: 31';
$outstr.='</td>';
$outstr.='</tr>';
$outstr.='<tr>';
$outstr.='<td>';
$outstr.='Стаж:';
$outstr.='</td>';
$outstr.='<td>';
//$outstr.='<input type="text" class="ui-widget ui-state-default ui-selectmenu-button" id="drivers_length" name="drivers_length" value="'.$_REQUEST['drivers_length'].'" onfocusout="checkresult_drivers_length(this)"/><br>';
$outstr.='<select class="ui-widget ui-state-default ui-selectmenu-button" id="drivers_length" name="drivers_length" value="'.$_REQUEST['drivers_length'].'" onfocusout="checkresult_drivers_length(this)" style="width:60px">';
$outstr.='<option>1</option>';
$outstr.='<option>2</option>';
$outstr.='<option>3</option>';
$outstr.='<option>4</option>';
$outstr.='<option>5</option>';
$outstr.='<option>6</option>';
$outstr.='<option>7</option>';
$outstr.='<option>8</option>';
$outstr.='<option>9</option>';
$outstr.='<option>10</option>';
$outstr.='<option>11</option>';
$outstr.='<option>12</option>';
$outstr.='<option>13</option>';
$outstr.='<option>14</option>';
$outstr.='<option>15</option>';
$outstr.='<option>16</option>';
$outstr.='<option>17</option>';
$outstr.='<option>18</option>';
$outstr.='<option>19</option>';
$outstr.='<option>21</option>';
$outstr.='<option>22</option>';
$outstr.='<option>23</option>';
$outstr.='<option>24</option>';
$outstr.='<option>25</option>';
$outstr.='<option>26</option>';
$outstr.='<option>27</option>';
$outstr.='<option>28</option>';
$outstr.='<option>29</option>';
$outstr.='<option>30</option>';
$outstr.='<option>31</option>';
$outstr.='<option>32</option>';
$outstr.='<option>33</option>';
$outstr.='<option>34</option>';
$outstr.='<option>35</option>';
$outstr.='<option></option>';
$outstr.='</select>';
$outstr.='</td>';
$outstr.='<td>';
$outstr.='Пример: 5';
$outstr.='</td>';
$outstr.='</tr>';
$outstr.='<tr>';
$outstr.='<td>';
$outstr.='Автомобиль:';
$outstr.='</td>';
$outstr.='<td>';
//$outstr.='<input type="select" id="car_name" name="car_name" disabled="1" value="'.$_REQUEST['car_name'].'"/><br>';
$outstr.='<select id="car_name" name="car_name" class="ui-widget ui-state-default ui-selectmenu-button" style="width:190px;" onfocusout="checkresult_car_name(this)">';
$get_avail_cars=db_get_available_cars();
//foreach($get_avail_cars as $get_avail_cars_items){
	$outstr.='<option>'.$get_avail_cars[0].'</option>';
	$outstr.='<option>'.$get_avail_cars[1].'</option>';
	$outstr.='<option>'.$get_avail_cars[2].'</option>';
//}
$outstr.='</select><br>';
$outstr.='</td>';
$outstr.='<td>';
$outstr.='';
$outstr.='</td>';
$outstr.='</tr>';
$outstr.='<tr>';
$outstr.='<td>';
$outstr.='Желаемые условия аренды автомобиля:';
$outstr.='</td>';
$outstr.='<td>';
$outstr.='<textarea id="rent_request" class="ui-state-default" name="rent_request" disabled rows="3" cols="30" style="width:227px;height:81px;" value="'.$_REQUEST['rent_request'].'"></textarea><br>';
$outstr.='</td>';
$outstr.='</tr>';
$outstr.='</table>';
$outstr.='</div>';
$outstr.='<div id="captcha" class="body" style="position:relative; margin-left:45%; margin-top:20%; width:170px; height:30px">Введите код с картинки: <img src="captcha.php?mail_link_activation='.$main_session_link.'&fs=1" style="position:relative;margin-left:15px;"width=50 height=30><input name="captcha" style="position:relative;margin-left:20px;" size=5 type="text" />';
$outstr.='<button class="btn btn-xs btn-primary btn-block" name="_Registering" style="position:relative;margin-top:5px;" type="submit" form="loginform" formmethod="post">Зарегистрироваться</button>';
//$outstr.='<input type="submit" name="_Registering" value="Зарегистрироваться">';
$outstr.='</div>';
$outstr.='</form>';
$outstr.='<div id="copyright_level1" class="ul" style="position:relative; left: 40%; top:25%; width:200px; height:20px;font-size:13px;">';
$outstr.='<p class="a"> ИП Красавин Д.В. 2011-2015</p>';
$outstr.='</div>';
$outstr.='</div>';
$outstr.='</div>';
$outstr.='</body>';
$outstr.='</html>';
print $outstr;

if ((isset($_REQUEST['status']))) {
	if ($_REQUEST['status']==0) {
		$status_table='<div id="authenticate_user_level1" class="ul.nav" style="position:absolute; left:30%; top:10%; width:500px; height:30px">';
		$status_table.='<table width="500" height="50" border="1">';
		$status_table.='  <caption>';
		$status_table.='    Данные Авторизации';
		$status_table.='  </caption>';
		$status_table.='  <tr>';
		$status_table.='    <td> Введены неправильные данные. Пожалуйста введите информацию снова. </td>';
		$status_table.='  </tr>';
		$status_table.='</table>';
		$status_table.='</div>';
		print($status_table);
	}
}

function db_store_session_info($session_link,$main_session_link) {
 global $site_config;
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

	$conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
    mysqli_select_db($conn,$dbname);
	mysqli_query($conn,"SET NAMES utf8");
	mysqli_query($conn,"CALL GET_LOGIN ($main_session_link,@LOGIN);");
	$result = mysqli_query($conn,"SELECT @LOGIN;");
	//$result = mysqli_query($conn,"SELECT DISTINCT login FROM register_user_session_info WHERE login='".$main_session_link."'");
	$row = mysqli_fetch_row($result);
	if ($row[0]==$main_session_link){
		mysqli_free_result($result);
		mysqli_query($conn,"CALL UPDATE_LOGIN ('".session_id()."','$main_session_link');");		
		//mysqli_query($conn,"UPDATE register_user_session_info SET session_id='".session_id()."' WHERE login='".$main_session_link."'");
		//echo "UPDATE register_user_session_info SET session_id='".$session_link."' WHERE login='".$main_session_link."'";
	} else {
		mysqli_query($conn,"CALL UPDATE_LOGIN ('$main_session_link','$session_link','".date("Y-m-d H:i:s")."');");
		//mysqli_query($conn,"INSERT INTO register_user_session_info(login,session_id,login_time) VALUES ('".$main_session_link."','".$session_link."','".date("Y-m-d H:i:s")."');");
		//echo "INSERT INTO register_user_session_info(login,session_id,login_time) VALUES ('".$main_session_link."','".$session_link."','".date("Y-m-d H:i:s")."');"; 
	}	
	if ((mysqli_errno)){
		  //print "Data was  modified cusessfully.";
	}
	mysqli_close($conn);
}

function db_get_session_id($session_link){
	global $site_config;
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
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
    mysqli_select_db($conn,$dbname);
	mysqli_query($conn,"SET NAMES utf8");
	//$result = mysqli_query($conn,"SELECT DISTINCT session_id FROM register_user_session_info WHERE login='".$session_link."'");
	mysqli_query($conn,"CALL GET_LOGIN ($session_link,@LOGIN);");
	$result = mysqli_query($conn,"SELECT @LOGIN;");	
	if ((mysqli_errno)){
		$row = mysqli_fetch_row($result);
		mysqli_free_result($result);
		mysqli_close($conn);		
		return $row[0];
	} else {
		return 0;
	}
}

function db_get_available_cars(){
	global $site_config;
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
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
	mysqli_select_db($conn,$dbname);
	mysqli_query($conn,"SET NAMES utf8");
	mysqli_query($conn,"CALL GET_AVAILABLE_CARS (@AVAILABLE_CARS1,@AVAILABLE_CARS2,@AVAILABLE_CARS3);");
	$result = mysqli_query($conn,"SELECT @AVAILABLE_CARS1,@AVAILABLE_CARS2,@AVAILABLE_CARS3;");
	if ((mysqli_errno)){
		$row = mysqli_fetch_row($result);
		//print_r($row);
		mysqli_free_result($result);
		mysqli_close($conn);
		return $row;
	} else {
		return 0;
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
?>