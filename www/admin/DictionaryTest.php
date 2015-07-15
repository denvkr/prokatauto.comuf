<html>
<meta http-equiv="refresh" content="text/html"; charset="UTF-8">
<body>
<?php
include "dictionary_worker_class.php";

$cnt=0;

//<meta http-equiv="refresh" content="60" > 
print <<<HTMLOUTPUT
<form method="post" action="$_SERVER[PHP_SELF]">
<table border = "1">
<tr>
<td>ID:</td> <td>EnWord:</td> <td>RuWord:</td> <td>Description:</td> <td>Transcription:</td>
</tr>
<tr>
<td> <input type="text" name="ID" align="left"></td> <td><input type="text" name="EnWord" align="left"></td> <td><input type="text" name="RuWord" align="left"></td> <td><input type="text" name="Description" align="left"></td> <td><input type="text" name="Transcription" align="left"></td>
</tr>
</table>
<input type="submit" name="add_record" value="add record">
</form>
HTMLOUTPUT;

$mydictionary_worker_class=new dictionary_worker_class();
$mydictionary_worker_class->set_dbhost('localhost');
$mydictionary_worker_class->set_user('root');
$mydictionary_worker_class->set_dbpass('postman');
$mydictionary_worker_class->get_record('localhost','root','postman');
if (isset($_REQUEST['ID']) && isset($_REQUEST['EnWord']) && isset($_REQUEST['RuWord'])) {
   $mydictionary_worker_class->add_record($_REQUEST['ID'],$_REQUEST['EnWord'],$_REQUEST['RuWord'],$_REQUEST['Description'],$_REQUEST['Transcription']);
   $mydictionary_worker_class->get_record('localhost','root','postman');
}

print <<<HTMLOUTPUT
<form name="F1" method="post" action="$_SERVER[PHP_SELF]">

<input type="submit" method="post" name="first" value="<">
<input type="submit" name="backward" value="<<">
<input type="submit" name="forward" value=">>">
<input type="submit" name="last" value=">">

</form>
HTMLOUTPUT;

if (isset($_REQUEST['first'])) {
print "button first was clicked";
$row=$mydictionary_worker_class->get_first_record();
$str="<table border = \"1\">
<tr>
<td>ID:</td> <td>EnWord:</td> <td>RuWord:</td> <td>Description:</td> <td>Transcription:</td>
</tr>
<tr>
<td> <input type=\"text\" name=\"ID_1\" align=\"left\" value=\"".$row[0]."\"></td> <td><input type=\"text\" name=\"EnWord_1\" align=\"left\" value=\"".$row[1]."\"></td> <td><input type=\"text\" name=\"RuWord_1\" align=\"left\" value=\"".$row[2]."\"></td> <td><input type=\"text\" name=\"Description_1\" align=\"left\" value=\"".$row[3]."\"></td> <td><input type=\"text\" name=\"Transcription_1\" align=\"left\" value\"".$row[4]."\"></td>
</tr>
</table>";
//$str.='<pre>'.htmlspecialchars(print_r($mydictionary_worker_class->rows_array,true)).'</pre>';
print $str;
//reset($mydictionary_worker_class->rows_array);
}
if (isset($_REQUEST['backward'])) {
   print "button backward was clicked"; 
$row=$mydictionary_worker_class->get_prev_record();

$fp = fopen("C:\\Program Files\\Apache Software Foundation\\Apache2.2\\htdocs\\UserSessions\\".$_COOKIE['PHPSESSID'], "r");
$session_id=fgets($fp);
$cnt=fgets($fp);
fclose($fp);

$str="<table border = \"1\">
<tr>
<td>ID:</td> <td>EnWord:</td> <td>RuWord:</td> <td>Description:</td> <td>Transcription:</td>
</tr>
<tr>
<td> <input type=\"text\" name=\"ID_1\" align=\"left\" value=\"".$mydictionary_worker_class->rows_array[$cnt][0]."\"></td> <td><input type=\"text\" name=\"EnWord_1\" align=\"left\" value=\"".$mydictionary_worker_class->rows_array[$cnt][1]."\"></td> <td><input type=\"text\" name=\"RuWord_1\" align=\"left\" value=\"".$mydictionary_worker_class->rows_array[$cnt][2]."\"></td> <td><input type=\"text\" name=\"Description_1\" align=\"left\" value=\"".$mydictionary_worker_class->rows_array[$cnt][3]."\"></td> <td><input type=\"text\" name=\"Transcription_1\" align=\"left\" value\"".$mydictionary_worker_class->rows_array[$cnt][4]."\"></td>
</tr>
</table>";
//$str.='<pre>'.htmlspecialchars(print_r($mydictionary_worker_class->rows_array,true)).'</pre>';
print $str;

if ( $cnt>0 && $cnt<=count($mydictionary_worker_class->rows_array) ) {
$cnt--;
}

$fp = fopen("C:\\Program Files\\Apache Software Foundation\\Apache2.2\\htdocs\\UserSessions\\".$_COOKIE['PHPSESSID'], "w");
fwrite($fp,$_COOKIE['PHPSESSID']."\r\n");
fwrite($fp,$cnt);
fclose($fp);

//reset($mydictionary_worker_class->rows_array);
}
if (isset($_REQUEST['forward'])) {
   print "button forward was clicked"; 
$row=$mydictionary_worker_class->get_next_record();

$fp = fopen("C:\\Program Files\\Apache Software Foundation\\Apache2.2\\htdocs\\UserSessions\\".$_COOKIE['PHPSESSID'], "r");
$session_id=fgets($fp);
$cnt=fgets($fp);
fclose($fp);

$str="<table border = \"1\">
<tr>
<td>ID:</td> <td>EnWord:</td> <td>RuWord:</td> <td>Description:</td> <td>Transcription:</td>
</tr>
<tr>
<td> <input type=\"text\" name=\"ID_1\" align=\"left\" value=\"".$mydictionary_worker_class->rows_array[$cnt][0]."\"></td> <td><input type=\"text\" name=\"EnWord_1\" align=\"left\" value=\"".$mydictionary_worker_class->rows_array[$cnt][1]."\"></td> <td><input type=\"text\" name=\"RuWord_1\" align=\"left\" value=\"".$mydictionary_worker_class->rows_array[$cnt][2]."\"></td> <td><input type=\"text\" name=\"Description_1\" align=\"left\" value=\"".$mydictionary_worker_class->rows_array[$cnt][3]."\"></td> <td><input type=\"text\" name=\"Transcription_1\" align=\"left\" value\"".$mydictionary_worker_class->rows_array[$cnt][4]."\"></td>
</tr>
</table>";
//$str.='<pre>'.htmlspecialchars(print_r($mydictionary_worker_class->rows_array,true)).'</pre>';
print $str;

if ( $cnt>=0 && $cnt<count($mydictionary_worker_class->rows_array) ) {
$cnt++;
}

$fp = fopen("C:\\Program Files\\Apache Software Foundation\\Apache2.2\\htdocs\\UserSessions\\".$_COOKIE['PHPSESSID'], "w");
fwrite($fp,$_COOKIE['PHPSESSID']."\r\n");
fwrite($fp,$cnt);
fclose($fp);

//reset($mydictionary_worker_class->rows_array);
}
if (isset($_REQUEST['last'])) {
   print "button last was clicked";
$row=$mydictionary_worker_class->get_last_record();
$str="<table border = \"1\">
<tr>
<td>ID:</td> <td>EnWord:</td> <td>RuWord:</td> <td>Description:</td> <td>Transcription:</td>
</tr>
<tr>
<td> <input type=\"text\" name=\"ID_1\" align=\"left\" value=\"".$row[0]."\"></td> <td><input type=\"text\" name=\"EnWord_1\" align=\"left\" value=\"".$row[1]."\"></td> <td><input type=\"text\" name=\"RuWord_1\" align=\"left\" value=\"".$row[2]."\"></td> <td><input type=\"text\" name=\"Description_1\" align=\"left\" value=\"".$row[3]."\"></td> <td><input type=\"text\" name=\"Transcription_1\" align=\"left\" value\"".$row[4]."\"></td>
</tr>
</table>";
//$str.='<pre>'.htmlspecialchars(print_r($mydictionary_worker_class->rows_array,true)).'</pre>';
print $str;
//reset($mydictionary_worker_class->rows_array);
}
?>
</body>
</html>
