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
<SCRIPT language="javascript" onload="document.open();document.write('<h1>document.styleSheetSets</h1>');document.close();">
<!--//
function hide(num)
  {   
      //eval('level'+num+'.style.visibility="hidden"')
      if (document.getElementById)
      {
         document.getElementById('level'+num).style.visibility='hidden';
      }
 }
function show(num)
 {
      //eval('level'+num+'.style.visibility="visible"');
      if (document.getElementById)
      {
         document.getElementById('level'+num).style.visibility='visible';
      }
 }
function hide_all_child_menuitems()
   {
    var i=2;
    for (i=2;i<=4;i++) {
        document.getElementById('level'+i).style.visibility='hidden';
    }  
   }
//-->
</script>
<noscript>
Your browser doesn't support JavaScript
</noscript>
</head>
<body onload="hide_all_child_menuitems();"}>
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
          $parent_menu[$obj->id]['id'] = $obj->id; 
          $parent_menu[$obj->id]['level'] = $obj->level;
          $parent_menu[$obj->id]['level_id'] = $obj->level_id;
       } else {
          $sub_menu[$obj->id]['parent'] = $obj->parent_id;
          $sub_menu[$obj->id]['level'] = $obj->level;
          $sub_menu[$obj->id]['level_id'] = $obj->level_id;
          //$parent_menu[$obj->parent_id]['count']++;
       }
       //собираем массив элементов меню
      $my_menu[$obj->id]['id']=$obj->id;
      $my_menu[$obj->id]['level']=$obj->level;
      $my_menu[$obj->id]['parent_id']=$obj->parent_id;
      $my_menu[$obj->id]['level_id']=$obj->level_id;
    }
mysql_free_result($items);

//print_r($parent_menu);
//print("</br>");
//print_r($sub_menu);
//print_r($my_menu);

$menu = "<ul>\n";
foreach ($parent_menu as $pkey => $pval) {           
           $menu.="<div id=\"layer1\" class=\"ul.menu".$pval['id']."\" onload=\"this.style.background='white'\" onmouseout=\"hide(2)\" style=\"position:absolute; left:20; top:20; width:150px; height:150px; z-index:1\">\n";
           $menu .= "  <li onload=\"this.style.background='white'\" onClick=\"document.write(document.location);\" onmouseover=\"show(2);this.style.background='blue'\" onmouseout=\"this.style.background='white'\">".$pval['level']."</li>\n";
           $menu.="</div>\n";
        }
$menu .= "</ul>\n";

print <<<HTMLOUTPUT
<form method="GET" action="$_SERVER[PHP_SELF]">
<div id="layer0" onload="this.style.background='white'" class="ul.hide_button" style="position:absolute; left:20; top:20; width:0px; height:0px; z-index:0">
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
          $sub_menu[$obj->id]['id']=$obj->id;
          $sub_menu[$obj->id]['level'] = $obj->level;
          $sub_menu[$obj->id]['parent'] = $obj->parent_id;
          $sub_menu[$obj->id]['level_id'] = $obj->level_id;
    }
    mysql_free_result($items);

    $top_position=20;
    $submenu = "<ul>\n";
    $submenu.="<div id=\"layer2\" class=\"ul.menu".$pval['id']."\" onload=\"this.style.background='white'\" onmouseover=\"show(2)\" style=\"position:absolute; left:170; top:".$top_position."; width:150px; height:150px; z-index:2\">\n";
    foreach ($sub_menu as $pkey=>$pval) {
            $submenu.="  <li class=\"ul.menu".$pval['id']."\" onload=\"this.style.background='white'\" onmouseover=\"this.style.background='blue'\" onmouseout=\"this.style.background='white'\">".$pval['level']."</li>\n";
            $top_position=$top_position+20;
    }
$submenu.="</div>\n";
$submenu .= "</ul>\n";

return $submenu;
}

function menu_traverse($menu_item) {
    $cur_parent_id=0;
    $cur_level_id=1;
    $cur_level=0;
    $top_pos=20;
    $left_pos=20;
    $submenu = "<ul>\n";
    foreach ($menu_item as $pkey => $pval) {

            for ($cur_parent_id=0;$cur_parent_id<=$pval['parent_id'];$cur_parent_id++) {
                 $left_pos+=150;
            }

            for ($cur_level_id=1;$cur_level_id<=$pval['level_id'];$cur_level_id++) {
                 $top_pos+=20;
            }

            //Требуется чтобы стиль применялся только к определенному уровню по parent_id
            if ($pval['parent_id']>$cur_level || $pval['parent_id']==0) {
                
                if ($pval['parent_id']>0) $submenu.="</div>\n";
                
                if (($pval['parent_id']+2)<=count($pval)) {
                   $submenu.="<div id=\"".$pval['level']."\" class=\"ul.menu".$pval['id']."\" onload=\"this.style.visibility='hidden'\" onmouseover=\"show(".($pval['parent_id']+1).")\" onmouseout=\"hide(".($pval['parent_id']+2).")\" style=\"position:absolute; left:".$left_pos."; top:".$top_pos."; width:150px; height:20px; z-index:0\">\n";
                }
                else {
                   $submenu.="<div id=\"".$pval['level']."\" class=\"ul.menu".$pval['id']."\" onload=\"this.style.visibility='hidden'\" onmouseover=\"show(".($pval['parent_id']+1).")\" style=\"position:absolute; left:".$left_pos."; top:".$top_pos."; width:150px; height:20px; z-index:0\">\n";                    
                }  
                
                $cur_level=$pval['parent_id'];
            }
            
            if (($pval['parent_id']+2)<=count($pval)) {            
               $submenu.="  <li class=\"ul.menu".$pval['id']."\" onload=\"this.style.visibility='hidden'\" onmouseover=\"show(".($pval['parent_id']+2).");this.style.background='blue'\" onmouseout=\"this.style.background='white'\">".$pval['level']."</li>\n";
            }
            else {
               $submenu.="  <li class=\"ul.menu".$pval['id']."\" onload=\"this.style.visibility='hidden'\" onmouseover=\"show(".($pval['parent_id']+1).");this.style.background='blue'\" onmouseout=\"this.style.background='white'\">".$pval['level']."</li>\n";
            }
             if ($pval['parent_id']==0) {
                 $cur_level=$pval['parent_id'];    
                 $submenu.="</div>\n"; 
            }
            
            $left_pos=20;
            $top_pos=20;
    }
    $submenu .= "</ul>\n";
    return $submenu;
}

//echo $menu;
//echo sub_menu($parent_menu);
echo menu_traverse($my_menu);
?>
</body>
</html>
