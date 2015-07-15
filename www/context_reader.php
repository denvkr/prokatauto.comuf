


<?php
class context_reader {
public function add_javascript(){
	//$outstr='<script src="http://code.jquery.com/jquery-latest.js"></script>';
	$outstr='<script type="text/javascript">';
	//$outstr.='$(document).ready(function () {';
	$outstr.='var $newcss_rule = $(\'<style type="text/css"> #rss_reader {font-weight: bold;font: 100%/1.4 Verdana, Arial, Helvetica, sans-serif; margin: 0;padding: 0;color: #FFF;} #table_rss_reader tr td {border: 1px solid #DFDFDF;width:795px;-moz-border-radius: 3px;-webkit-border-radius: 3px;	border-radius: 3px;font-weight: bold;font: 100%/1.4 Verdana, Arial, Helvetica, sans-serif; margin: 0;padding: 0;color: #FFF;}</style>\');';
	$outstr.='$("head").append($newcss_rule);';
	$outstr.='$("#table_rss_reader").append($newcss_rule);';
	//$outstr.='});';
	$outstr.='</script>';
	return $outstr; 
}
public function read($url){
	switch ($url) {
	case "za_rulem":
		$site_info = file_get_contents('http://www.zr.ru/category/pressrelease/');
	$news_start_pos=0;
	$news_reader='';
/*
	$news_reader.='<style type="text/css">';
	$news_reader.='#zr_rss_info {';
	$news_reader.='	font-family: Georgia, "Times New Roman", Times, serif;';
	$news_reader.='	font-size: 10px;';
	$news_reader.='	color: #000;';
	$news_reader.='	background-color: #999;';
	$news_reader.='	position: absolute;';
	$news_reader.='	visibility: visible;';
	$news_reader.='	z-index: auto;';
	$news_reader.='	height: 600px;';
	$news_reader.='	width: 600px;';
	$news_reader.='}';
	$news_reader.='</style>';
	$news_reader.='<div class="zr_rss_info" id="zr_rss_info">';	
*/
//		while (strpos($site_info,'class="leed"',$news_start_pos)!==false) {
		$counter=0;
		while ($counter<3) {
			if ($site_info=='') {
				$site_info=='error';
			}
			$news_start_pos=stripos($site_info,'class="cmp-posts-list--title"',$news_start_pos);
			$news_start_pos_next=stripos($site_info,'>',$news_start_pos);
			$news_end_pos=stripos($site_info,'</a>',$news_start_pos_next);
			$news_reader.='<table id="table_rss_reader"><caption>Источник: http://www.zr.ru/category/pressrelease/</caption>';
			$news_reader.='<tr><td>'.substr($site_info,$news_start_pos_next+1,($news_end_pos-($news_start_pos_next+1))).'</td></tr>';
			$news_reader.='</table>';
			$news_reader.='<br />';
			$news_start_pos=$news_end_pos+1;
			$counter++;
		};
		break;
	case 'auto_ru':
		$site_info = file_get_contents('http://carsguru.net/news/');
		$news_start_pos=0;
		$news_reader='';
		$counter=0;
		while ($counter<3) {
			if ($site_info=='') {
				$site_info=='error';
			}		
			$news_start_pos=strpos($site_info,'class="pseudo-h3"><a href="/news',$news_start_pos);
			$news_start_pos_next=strpos($site_info,'>',$news_start_pos+19);
			$news_end_pos=strpos($site_info,'</a>',$news_start_pos_next);
			$rss_source=$this->Utf8ToWin('Источник: http://carsguru.net/news/');
			$news_reader.='<table id="table_rss_reader"><caption>'.$rss_source.' </caption>';
			$news_reader.='<tr><td>'.substr($site_info,$news_start_pos_next+1,($news_end_pos-($news_start_pos_next+1))).'</td></tr>';
			$news_reader.='</table>';
			$news_reader.='<br />';
			$news_start_pos=$news_end_pos+1;
			$counter++;
		};
		$news_reader=$this->WinToUtf8($news_reader);
		break;
};
return $news_reader.$this->add_javascript();
}

public function Utf8ToWin($s)
        {
			$out='';
            $byte2=false;
            for ($c=0;$c<strlen($s);$c++)
            {
               $i=ord($s[$c]);
               if ($i<=127) $out.=$s[$c];
                   if ($byte2){
                       $new_c2=($c1&3)*64+($i&63);
                       $new_c1=($c1>>2)&5;
                       $new_i=$new_c1*256+$new_c2;
                   if ($new_i==1025){
                       $out_i=168;
                   } else {
                       if ($new_i==1105){
                           $out_i=184;
                       } else {
                           $out_i=$new_i-848;
                       }
                   }
                   $out.=chr($out_i);
                   $byte2=false;
                   }
               if (($i>>5)==6) {
                   $c1=$i;
                   $byte2=true;
               }
            }
            return $out;
        }
		
public function WinToUtf8($data)
{
    if (is_array($data))
    {
        $d = array();
        foreach ($data as $k => &$v) $d[WinToUtf8($k)] = WinToUtf8($v);
        return $d;
    }
    if (is_string($data))
    {
        if (function_exists('iconv')) return iconv('cp1251', 'utf-8//IGNORE//TRANSLIT', $data);
        if (! function_exists('cp1259_to_utf8')) include_once 'cp1259_to_utf8.php';
        return WinToUtf8($data);
    }
    if (is_scalar($data) or is_null($data)) return $data;
    #throw warning, if the $data is resource or object:
    trigger_error('An array, scalar or null type expected, ' . gettype($data) . ' given!', E_USER_WARNING);
    return $data;
}
}
?>