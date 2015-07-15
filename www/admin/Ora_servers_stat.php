<html>
<LINK HREF="zengarden-sample.css" TYPE="text/css" REL="stylesheet">
<body>
1. Проверка серверов БД MQ:</br>
<?php
$Servers_list[0] = 'MSKNCKPIDWH';
$Servers_list[1] = 'MSKRSDWH';
$Servers_list[2] = 'MSKLMSDWH';
$Servers_list[3] = 'MSKTCAPDWH';
$Servers_list[4] = 'IP-KPI';
$Servers_list[5] = 'GB-KPI';
$i=0;
while ($i <= COUNT($Servers_list)-1) {
if ($c=OCILogon("system", "manager",$Servers_list[$i],"WE8ISO8859P15")) {
    $strout .= "$Servers_list[$i] connection=OK </br>";
  OCILogoff($c);
} else {
  $err = OCIError();
    $strout .= "$Servers_list[$i] connection=Error $err[text] </br>";
  OCILogoff($c);
}
$i++;
}
print $strout;
?>
<?php
print <<<HTMLOUTPUT
<form method="get" action="$_SERVER[PHP_SELF]">
<input type="submit" name="_Refresh" value="Refresh">
</form>
HTMLOUTPUT;
?>
</body>
</html>