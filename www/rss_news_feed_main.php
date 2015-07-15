<?php
include "context_reader.php";
//создаем экземпл€р класса дл€ чтени€ данных с сайтов
$myreader=new context_reader();
//читаем rss c тематическими ннвост€ми
$site_info=$myreader->read("za_rulem");
//$pattern = '/^\="leed"/';
//preg_match($pattern ,$site_info, $matches, PREG_OFFSET_CAPTURE);
//print_r($matches);
echo $site_info;
?>