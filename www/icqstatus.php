<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
<LINK HREF="style.css" TYPE="text/css" REL="stylesheet">
</head>
<body>
<?php 
 $icq='502025';  // your ICQ number 
 $icqstat="<div style='color:darkred;font-weight:bold'>Offline</div>"; 
 $fp = fsockopen("status.icq.com", 80, $errno, $errstr, 120); 
 if (!$fp) {
 	echo "1";
    echo "$errstr ($errno)<br>\n";
} else {
	fputs($fp, "GET /online.gif?icq=".$icq."&img=5 HTTP/1.0\n\n"); // 
    while ($line=FGetS($fp,128)) { 
    if (ERegI("^Location:.*$", $line)) {
    	if (ERegI("online1",$line)) {
    		$icqstat="<div style='color:darkgreen;font-weight:bold'>Online</div>"; 
    	}
       break; 
     } 
   } 
 } 
 echo 'ICQ: '.$icq.'<br />'.$icqstat; 

print <<<HTMLOUTPUT
<a href="http://www.icq.com/whitepages/cmd.php?uin=502025&action=message">
<img src="http://www.icq.com/scripts/online.dll?icq=502025&img=5" border="0" />
</a>
HTMLOUTPUT;
 
?> 
</body>
</html>