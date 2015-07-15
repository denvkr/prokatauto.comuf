<html>
<style type="text/css">
<!--
ul.menu {color: yellow; background: red;}
ul.nav {color: yellow; background: blue;}
-->
</style>
<body>
<?php
//проверяем поддерживает ли броузер javascript
//echo $_SERVER['HTTP_USER_AGENT'] . "<br>";
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
  }
  if ($browser["javascript"]==0) {
     print "No javascript allowed please enable it.";
  }
  else {
     print "Javascript allowed.";
  }
}

//Соединяемся с базой данных (надо потом сделать это через ссылку на единый класс
    $dbhost = 'localhost';
    $dbuser ='root';
    $dbpass ='postman';
    $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
    $dbname = 'localhost';
    mysql_select_db($dbname,$conn);
    $sql = "SELECT id, label, link_url, parent_id FROM dyn_menu ORDER BY parent_id, id ASC";
    $items = mysql_query($sql);
    while ($obj = mysql_fetch_object($items)) {
       if ($obj->parent_id == 0) {
          $parent_menu[$obj->id]['label'] = $obj->label;
          $parent_menu[$obj->id]['link'] = $obj->link_url;
       } else {
          $sub_menu[$obj->id]['parent'] = $obj->parent_id;
          $sub_menu[$obj->id]['label'] = $obj->label;
          $sub_menu[$obj->id]['link'] = $obj->link_url;
          $parent_menu[$obj->parent_id]['count']++;
       }
    }
mysql_free_result($items);

//print_r($parent_menu);
//print_r($sub_menu);

function dyn_menu($parent_array, $sub_array, $qs_val = "menu", $main_id = "nav", $sub_id = "subnav", $extra_style = "foldout") {
    //$menu = "<ul id=\"".$main_id."\" class=\"menu\" onmouseover=\"this.style.background='blue'\" onmouseout=\"this.style.background='red'\" >\n";
    $menu = "<ul>\n";
    foreach ($parent_array as $pkey => $pval) {
        if (!empty($pval['count'])) {
            $menu .= "  <tr><td><li class=\"menu\" onmouseover=\"this.style.background='blue'\" onmouseout=\"this.style.background='red'\"><a class=\"".$extra_style."\" href=\"".$pval['link']."?".$qs_val."=".$pkey."\">".$pval['label']."</a></li></td></tr>\n";
        } else {
            $menu .= "  <tr><td><li class=\"menu\" onmouseover=\"this.style.background='blue'\" onmouseout=\"this.style.background='red'\"><a href=\"".$pval['link']."\">".$pval['label']."</a></li></td></tr>\n";
        }
        if (!empty($_REQUEST[$qs_val])) {
            //$menu .= "<ul id=\"".$sub_id."\">\n";
            $menu .= "<ul>\n";
            foreach ($sub_array as $sval) {
                if ($pkey == $_REQUEST[$qs_val] && $pkey == $sval['parent']) {
                    $menu .= "<tr><td><li class=\"menu\" onmouseover=\"this.style.background='blue'\" onmouseout=\"this.style.background='red'\"><a href=\"".rebuild_link($sval['link'], $qs_val, $sval['parent'])."\">".$sval['label']."</a></li></td></tr>\n";
                }
            }
            $menu .= "</ul>\n";
        }
    }
    $menu .= "</ul>\n";
    return $menu;
}

function rebuild_link($link, $parent_var, $parent_val) {
    $link_parts = explode("?", $link);
    $base_var = "?".$parent_var."=".$parent_val;
    if (!empty($link_parts[1])) {
        $link_parts[1] = str_replace("&amp;", "##", $link_parts[1]);
        $parts = explode("##", $link_parts[1]);
        $newParts = array();
        foreach ($parts as $val) {
            $val_parts = explode("=", $val);
            if ($val_parts[0] != $parent_var) {
                array_push($newParts, $val);
            }
        }
        if (count($newParts) != 0) {
            $qs = "&amp;".implode("&amp;", $newParts);
        }
        return $link_parts[0].$base_var.$qs;
    } else {
        return $link_parts[0].$base_var;
    }
}
print <<<HTMLOUTPUT
<div>
<table border = "0">
HTMLOUTPUT;
echo dyn_menu($parent_menu, $sub_menu, "menu", "nav", "subnav");
echo "<tr>".empty($_REQUEST[$qs_val])."<td></td></tr>";
print <<<HTMLOUTPUT
</table>
</div>
HTMLOUTPUT;
//Пример работы с табличными видами
print <<<HTMLOUTPUT
<table border="1">
  <tr>
    <th>Month</th>
    <th>Savings</th>
  </tr>
  <tr>
    <td>January</td>
    <td>$100</td>
  </tr>
</table>
HTMLOUTPUT;

?>
</body>
</html>
