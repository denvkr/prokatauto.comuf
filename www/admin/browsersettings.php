<html>
<head>
<title>Browser Information</title>
</head>
<body>
<?php
print <<<HTMLOUTPUT
<form method="GET" action="$_SERVER[PHP_SELF]">
HTMLOUTPUT;
?>
<script "text/javascript"><!--//--><![CDATA[//><!--
      document.open();
      document.write('<input type="hidden" name="type" value="' + navigator.appName + '">');
      //document.write('<input type="hidden" name="screenWidth" value="' + screen.width +'">');
      //document.write('<input type="hidden" name="screenHeight" value="' + screen.height + '">'};
      document.write('<input type="hidden" name="browserHeight" value="' + window.innerWidth + '">');
      document.write('<input type="hidden" name="browserWidth" value="' + window.innerHeight + '">');
      document.write('<input type="submit" name="GetBrowserinformation" value="Get_browser_information">');
      document.close();
//--><!]]>
</script>
<?php
print <<<HTMLOUTPUT
</form>
HTMLOUTPUT;
?>
<?php
echo $_SERVER['HTTP_USER_AGENT'] . "<br>";
echo $_REQUEST['browserHeight']."<br>";
if(ini_get("browscap")) {
// Получить информацию о браузере
$browser = get_browser(null,true);
// Преобразовать $browser в массив
//$Sbrowser = (array) $browser;
while (list ($key, $value) = each ($browser)) {
// Присвоить нули пустым элементам массива
if ($value == "") {
 $value = 0;
}
print "$key : $value <br>";
}
//print_r($browser);
}
print $php_errormsg;
phpinfo();
?>
</body>
</html>
