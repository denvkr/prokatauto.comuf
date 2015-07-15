<html>
<head>
<style type="text/css">
<!--
ul.menu {
color: black;
background-image:url('background.png');
background-repeat:no-repeat;
background-attachment:fixed;
background-position:center;
}
li {
color: black;
background-image:url('background.png');
background-repeat:no-repeat;
background-attachment:fixed;
background-position:center;
}
ul.nav {
color: yellow; 
background-image:url('background.png');
background-repeat:no-repeat;
background-attachment:fixed;
background-position:center;
}
ul.hide_button {
color:white; 
background:white;
}
-->
</style>
<SCRIPT language="javascript">
<!--//
function cl()
 { for(var i=1; i<=5; i++)
  {//eval('sub'+i+'.style.visibility="hidden"')
   document.getElementById('sub'+i).style.visibility='hidden'
}
 }
function show(num)
 {cl();
      //eval('sub'+num+'.style.visibility="visible"');
      document.getElementById('sub'+num).style.visibility='visible';
 }
//-->
</script>
<noscript>
Your browser doesn't support JavaScript
</noscript>
</head>
<body>
<?php

//Соединяемся с базой данных (надо потом сделать это через ссылку на единый класс
    $dbhost = 'localhost';
    $dbuser ='root';
    $dbpass ='postman';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
    $dbname = 'localhost';
    mysql_select_db($dbname,$conn);
    $sql = "SELECT id,level,parent_id,level_id FROM t1 ORDER BY parent_id, id ASC";
    $items = mysql_query($sql);
    while ($obj = mysql_fetch_object($items)) {
       if ($obj->parent_id == 0) {
          $parent_menu[$obj->id]['level'] = $obj->level;
          $parent_menu[$obj->id]['level_id'] = $obj->level_id;
       } else {
          $sub_menu[$obj->id]['parent'] = $obj->parent_id;
          $sub_menu[$obj->id]['level'] = $obj->level;
          $sub_menu[$obj->id]['level_id'] = $obj->level_id;
          //$parent_menu[$obj->parent_id]['count']++;
       }
    }
mysql_free_result($items);

//print_r($parent_menu);
//print("</br>");
//print_r($sub_menu);

$menu = "<ul>\n";
foreach ($parent_menu as $pkey => $pval) {
           $menu .= "  <tr><td><li onload=\"this.style.background='white'\" onClick=\"document.write(document.location);\" onmouseover=\"this.style.background='blue'\" onmouseout=\"this.style.background='white'\">".$pval['level']."</li></td></tr>\n";
        }
$menu .= "</ul>\n";

print <<<HTMLOUTPUT
<form method="GET" action="$_SERVER[PHP_SELF]">
<div id="layer0" onload="this.style.background='white'" class="ul.hide_button" style="position:absolute; left:20; top:18; width:0px; height:0px; z-index:0">
HTMLOUTPUT;
print "<input style=\"position:absolute; width: 0; left: 0; top: 0;\" type=\"submit\" name=\"SubmitMenuItem\" value=\"test\">";
print <<<HTMLOUTPUT
</div>
</form>
HTMLOUTPUT;

function sub_menu($p_menu_item) {
    $dbhost = 'localhost';
    $dbuser ='root';
    $dbpass ='postman';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
    $dbname = 'localhost';
    mysql_select_db($dbname,$conn);
    $sql = "SELECT id,level,parent_id,level_id FROM t1 where parent_id=".$p_menu_item[1]['level_id']." ORDER BY parent_id, id ASC";
    $items = mysql_query($sql);
    while ($obj = mysql_fetch_object($items)) {
          $sub_menu[$obj->id]['parent'] = $obj->parent_id;
          $sub_menu[$obj->id]['level'] = $obj->level;
          $sub_menu[$obj->id]['level_id'] = $obj->level_id;
    }
    mysql_free_result($items);

    $submenu = "<ul>\n";
    foreach ($sub_menu as $pkey=>$pval) {
            $submenu.="  <tr><td> </td><td><li onload=\"this.style.background='white'\" onmouseover=\"this.style.background='blue'\" onmouseout=\"this.style.background='white'\">".$pval['level']."</li></td></tr>\n";
    }
$submenu .= "</ul>\n";

return $submenu;
}

print <<<HTMLOUTPUT
<div id="layer2" class="ul.menu" onload="this.style.background='white'" style="position:absolute; left:0; top:0; width:300px; height:150px; z-index:2">
<table border="0">
HTMLOUTPUT;
echo $menu;
echo sub_menu($parent_menu);
print <<<HTMLOUTPUT
</table>
</div>
<div id="layer1" class="ul.menu" onload="this.style.background='white'" style="position:absolute; left:0; top:0; width:300px; height:150px; z-index:1">
<table border = "0">
HTMLOUTPUT;
echo $menu;
print <<<HTMLOUTPUT
</table>
</div>
HTMLOUTPUT;
?>
</body>
</html>
