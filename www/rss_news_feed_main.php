<?php
include "context_reader.php";
//������� ��������� ������ ��� ������ ������ � ������
$myreader=new context_reader();
//������ rss c ������������� ���������
$site_info=$myreader->read("za_rulem");
//$pattern = '/^\="leed"/';
//preg_match($pattern ,$site_info, $matches, PREG_OFFSET_CAPTURE);
//print_r($matches);
echo $site_info;
?>