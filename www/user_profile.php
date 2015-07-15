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
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
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
                	webvisor:true,                
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
<div class="container" id="container" style="position:relative; left:0%; top:0%; width:1160px; height:768px; z-index:0">
<div id="h1_level1" class="h1" style="position:relative; left:1%; top:1%; width:1160px; height:25px; z-index:0">
<h1> Личный кабинет. </h1>
</div>
<?php
//echo $_REQUEST['captcha'].session_id();
//echo isset($_REQUEST['mail_link_activation']);
if (isset($_REQUEST['user'])==1 && isset($_REQUEST['password'])==1){
	//echo $_REQUEST['user'].$_REQUEST['password'];
	//Генерим сессию для страницы
	session_start();
	session_regenerate_id();
	$mail_link_activation=session_id();
	db_store_session_info($mail_link_activation);
	$mail_link_activation_old=db_check_mail_link_info('',$_REQUEST['user'],$_REQUEST['password']);
	//echo substr($mail_link_activation_old,-33);
	$retval=db_get_user_info(substr($mail_link_activation_old,-33));
	//print_r($retval);
	$str_tab='<form method="POST" action="/user_profile.php?mail_link_activation='.substr($mail_link_activation_old,-33).'&data_modification=1"><div id="userinfo_level1" class="ul.nav" style="position:relative;left:35%;top:130px !important;width:300px;height:150px;z-index:0"><table border="1" cols="2"><tr><td>Логин:</td><td><input type="text" name="login" value="'.$retval[0].'"/></td></tr><tr><td>Пароль:</td><td><input type="text" name="password" value="'.$retval[1].'"/><br></td></tr><tr><td>Ел. почта:</td><td><input type="text" name="mail_address" value="'.$retval[2].'"/><br></td></tr><tr><td>Имя:</td><td><input type="text" name="name" value="'.$retval[3].'"/><br></td></tr><tr><td>Фамилия:</td><td><input type="text" name="last_name" value="'.$retval[4].'"/><br></tr><tr><td>Дом. адрес:</td><td><input type="text" name="address" value="'.$retval[5].'"/><br></td></tr><tr><td>Возраст:</td><td><input type="text" name="age" value="'.$retval[6].'"/><br></td></tr><tr><td>Стаж:</td><td><input type="text" name="drivers_length" value="'.$retval[7].'"/><br></td></tr><tr><td>Желаемые условия аренды автомобиля:</td><td><textarea name="rent_request" style="width:227px;height:81px;">'.$retval[8].'</textarea><br></td></tr></table></div><div id="captcha" class="ul" style="position:relative;left:40%;top:340px;width:150px;height:30px">Введите код с картинки: <img src="captcha.php?mail_link_activation='.$mail_link_activation.'" width=50 height=30><input name="captcha" size=5 type="text" /><input type="submit" name="_Registering" value="Обновить данные"></div></form><div id="copyright_level1" class="ul.nav" style="position:relative;left: 40%;top:550px; width:200px; height:20px"><p class="a"> ИП Красавин Д.В. 2011-2014</p></div></div>';
	echo $str_tab;
}

if (isset($_REQUEST['mail_link_activation'])==1){
	$mail_link_activation_mod=str_replace(' ','+',$_REQUEST['mail_link_activation']);
	$mail_link_activation=addslashes($mail_link_activation_mod);
	if ($_REQUEST['data_modification']==1){
		$cur_session_id=db_get_session_id($mail_link_activation);
		if (($_REQUEST['captcha'])!=substr($cur_session_id,-4,4)){
			//echo $_REQUEST['captcha']." ".substr($cur_session_id,-4,4);
			die('Символы на картинке введены неверно!');
		} else {
			$status_store = db_update_user_data($_REQUEST['login'],$_REQUEST['password'],$_REQUEST['mail_address'],$_REQUEST['name'],$_REQUEST['last_name'],$_REQUEST['address'],$_REQUEST['age'],$_REQUEST['drivers_length'],$_REQUEST['rent_request'],$mail_link_activation);
		}
	}
	//Генерим сессию для страницы
	session_start();
	session_regenerate_id();
	db_store_session_info($mail_link_activation);
	db_check_mail_link_info($mail_link_activation,'','');
	$retval=db_get_user_info($mail_link_activation);
	$str_tab='<form method="POST" action="/user_profile.php?mail_link_activation='.$mail_link_activation.'&data_modification=1"><div id="userinfo_level1" class="ul.nav" style="position:relative;left:35%;top:130px !important;width:300px;height:150px;z-index:0"><table border="1" cols="2"><tr><td>Логин:</td><td><input type="text" name="login" value="'.$retval[0].'"/></td></tr><tr><td>Пароль:</td><td><input type="text" name="password" value="'.$retval[1].'"/><br></td></tr><tr><td>Ел. почта:</td><td><input type="text" name="mail_address" value="'.$retval[2].'"/><br></td></tr><tr><td>Имя:</td><td><input type="text" name="name" value="'.$retval[3].'"/><br></td></tr><tr><td>Фамилия:</td><td><input type="text" name="last_name" value="'.$retval[4].'"/><br></tr><tr><td>Дом. адрес:</td><td><input type="text" name="address" value="'.$retval[5].'"/><br></td></tr><tr><td>Возраст:</td><td><input type="text" name="age" value="'.$retval[6].'"/><br></td></tr><tr><td>Стаж:</td><td><input type="text" name="drivers_length" value="'.$retval[7].'"/><br></td></tr><tr><td>Желаемые условия аренды автомобиля:</td><td><textarea name="rent_request" style="width:227px;height:81px;">'.$retval[8].'</textarea><br></td></tr></table></div><div id="captcha" class="ul" style="position:relative;left:40%;top:340px;width:150px;height:30px">Введите код с картинки: <img src="captcha.php?mail_link_activation='.$mail_link_activation.'" width=50 height=30><input name="captcha" size=5 type="text" /><input type="submit" name="_Registering" value="Обновить данные"></div></form><div id="copyright_level1" class="ul.nav" style="position:relative;left: 40%;top:550px; width:200px; height:20px"><p class="a"> ИП Красавин Д.В. 2011-2014</p></div></div>';
	echo $str_tab;
}

function db_check_mail_link_info($mail_link_activation,$username,$userpassword)
{
	//проверяем линк пользователя на предмет существования такового а бд
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
	mysqli_query($conn,"SET NAMES utf8");
    mysqli_query($conn,"SET @retval = 0;");
	if ($mail_link_activation!='') {
		$result = mysqli_query($conn,"set @retval=(SELECT DISTINCT mail_link_info FROM userinfo  WHERE  substr(mail_link_info,LENGTH(mail_link_info)-32,33)='".$mail_link_activation."')");
		$result = mysqli_query($conn,"select @retval;");
		if (empty($result)==0){
			$str='';
			if (($cnt)) {
				while($row = mysqli_fetch_array($result)) {
					$str.= $row[0];
				}
				print ($result);
				mysqli_free_result($result);
				mysqli_close($conn);
				return $str;
			}
			else {
				mysqli_free_result($result);
				mysqli_close($conn);
				return 0;
			}
		}
		else {
			mysqli_free_result($result);
			return 0;	
		}
	}

	if (($username!='' && $userpassword=='') || ($username!='' && $userpassword!='')){
		//echo "set @retval=(SELECT DISTINCT mail_link_info FROM userinfo WHERE  login='".$username."' and password='".$userpassword."')";
		$result = mysqli_query($conn,"set @retval=(SELECT DISTINCT mail_link_info FROM userinfo WHERE  login='".$username."' and password='".$userpassword."')");
		$result = mysqli_query($conn,"select @retval;");
		if (empty($result)==0){
			$str='';
			$row = mysqli_fetch_array($result);
			$str= $row[0];
			mysqli_free_result($result);
			mysqli_close($conn);
			return $str;
		}
		else {
			mysqli_free_result($result);
			mysqli_close($conn);
			return 0;	
		}
		
	}
}
function db_get_user_info($mail_link_activation){
	$dbhost= 'localhost';
	$dbuser ='prokatau_root';
	$dbpass ='Hftg8bp';
    $retval =0;
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
    $dbname = 'prokatau_rentcar';
    mysqli_select_db($conn,$dbname);
    mysqli_query($conn,"SET NAMES utf8");
    $result = mysqli_query($conn,"SELECT DISTINCT login,password,mail_address,Name,Last_Name,Address,Age,drivers_length,rent_request,Mail_Link_Info FROM ".$dbname.".userinfo WHERE substr(mail_link_info,LENGTH(mail_link_info)-32,33)='".$mail_link_activation."'",MYSQLI_USE_RESULT);
	//echo "SELECT DISTINCT login,password,mail_address,Name,Last_Name,Address,Age,drivers_length,rent_request,Mail_Link_Info FROM ".$dbname.".userinfo WHERE substr(mail_link_info,LENGTH(mail_link_info)-32,33)='".$mail_link_activation."'"; 
    //print_r($retval);
    if (empty($result)==0){
			$row = mysqli_fetch_row($result);
			//print_r($row);
			mysqli_free_result($result);
			mysqli_close($conn);
			return $row;
	}
	else {
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
		  print "Data was inserted cusessfully.";
	}
	//mysqli_free_result($result); 
	mysqli_close($conn);
}

function db_update_user_data($login, $password, $mail_address,$user_name,$user_last_name,$address,$age,$drivers_length,$rent_request,$mail_link_activation)
{
    //$dbhost = 'localhost';
    //$dbuser ='root';//$_REQUEST['user'];
    //$dbpass ='postman';//$_REQUEST['password'];
    //$retval =0;
    //echo "UPDATE userinfo set login='".$login."',PASSWORD='".$password."',mail_address='".$mail_address."',NAME='".$user_name."',Last_Name='".$user_last_name."',Address='".$address."',age=".$age.",drivers_length=".$drivers_length.",rent_request='".$rent_request."' WHERE Mail_link_Info='".$mail_link_activation."'";
	$dbhost= 'localhost';
	$dbuser ='prokatau_root';
	$dbpass ='Hftg8bp';
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
    $dbname = 'prokatau_rentcar';
    mysqli_select_db($conn,$dbname);
	//print ("call STORE_USER_DATA('".$login."','".$password."','".$mail_address."','".$user_name."','".$user_last_name."','".$address."',".$age.",".$drivers_length.",'".$mail_link_activation."',".$retval.")");
	mysqli_query($conn,"SET NAMES utf8");
    mysqli_query($conn,"SET @retval = 0;");
	$result = mysqli_query($conn,"UPDATE userinfo set login='".$login."',PASSWORD='".$password."',mail_address='".$mail_address."',NAME='".$user_name."',Last_Name='".$user_last_name."',Address='".$address."',age=".$age.",drivers_length=".$drivers_length.",rent_request='".$rent_request."' WHERE Mail_link_Info like'%".$mail_link_activation."%'");
	if ((mysqli_errno)){
		  print "Data was  modified cusessfully.";
	}
	//mysqli_free_result($result); 
	mysqli_close($conn);
}

function db_store_session_info($mail_link_activation) {
	$dbhost= 'localhost';
	$dbuser ='prokatau_root';
	$dbpass ='Hftg8bp';
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
    $dbname = 'prokatau_rentcar';
    mysqli_select_db($conn,$dbname);
	mysqli_query($conn,"SET NAMES utf8");
	$result = mysqli_query($conn,"SELECT DISTINCT login FROM user_session_info WHERE login='".$mail_link_activation."'");
	$row = mysqli_fetch_row($result);
	if ($row[0]==$mail_link_activation){
		mysqli_free_result($result);
		mysqli_query($conn,"UPDATE user_session_info SET session_id='".session_id()."' WHERE login='".$mail_link_activation."'");
		//echo "UPDATE user_session_info SET session_id='".session_id()."' WHERE login='".$mail_link_activation."'";
	} else {
		mysqli_query($conn,"INSERT INTO user_session_info(login,session_id,login_time) VALUES ('".$mail_link_activation."','".session_id()."','".date("Y-m-d H:i:s")."');");
		//echo "INSERT INTO user_session_info(login,session_id,login_time) VALUES ('".$mail_link_activation."','".session_id()."','".date("Y-m-d H:i:s")."');"; 
	}	
	if ((mysqli_errno)){
		  //print "Data was  modified cusessfully.";
	}
	mysqli_close($conn);
}

function db_get_session_id($mail_link_activation){
	$dbhost= 'localhost';
	$dbuser ='prokatau_root';
	$dbpass ='Hftg8bp';
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
    $dbname = 'prokatau_rentcar';
    mysqli_select_db($conn,$dbname);
	mysqli_query($conn,"SET NAMES utf8");
	$result = mysqli_query($conn,"SELECT DISTINCT session_id FROM user_session_info WHERE login='".$mail_link_activation."'");
	if ((mysqli_errno)){
		$row = mysqli_fetch_row($result);
		mysqli_free_result($result);
		mysqli_close($conn);		
		return $row[0];
	} else {
		return 0;
	}
}
?>
