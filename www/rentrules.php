<?php
include_once "document_reader_class.php";
ini_set('display_errors', true);
$outstr='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
$outstr='<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">';
$outstr.='<head>';
$outstr.='<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
$outstr.='<meta name="Keywords" content="" />';
$outstr.='<meta name="robots" content="index,follow" />';
$outstr.='<link href="style.css" type="text/css" rel="stylesheet" />';
$outstr.='<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.min.js"></script>';
$outstr.='<script type="text/javascript" src="w_load.js" async></script>';
$outstr.='    <!-- Bootstrap core CSS -->';
$outstr.='    <link href="bootstrap/docs/dist/css/bootstrap.min.css" rel="stylesheet">';
$outstr.='    <!-- Bootstrap theme -->';
$outstr.='    <link href="bootstrap/docs/dist/css/bootstrap-theme.min.css" rel="stylesheet">';
$outstr.='    <!-- Custom styles for this template -->';
$outstr.='    <link href="bootstrap/theme.css" rel="stylesheet">';
$outstr.='    <!-- Just for debugging purposes. Don\'t actually copy these 2 lines! -->';
$outstr.='    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->';
$outstr.='    <script src="bootstrap/docs/assets/js/ie-emulation-modes-warning.js"></script>';
$outstr.='    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->';
$outstr.='    <script src="bootstrap/docs/assets/js/ie10-viewport-bug-workaround.js"></script>';
$outstr.='    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->';
$outstr.='    <!--[if lt IE 9]>';
$outstr.='      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>';
$outstr.='      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>';
$outstr.='    <![endif]-->';
$outstr.='</head>';
$outstr.='<body id="body_container" style="position: absolute; width: 1160px; height: 800px;visibility:hidden;">'; // onload="javascript:Dimension();"
$outstr.='<script type="text/javascript">';
$outstr.='function Dimension ()';
$outstr.='{';
$outstr.='	var Width = (window.screen.width);';
$outstr.='	var Height = (window.screen.height);';
$outstr.='	if (Width < 1160) {';
$outstr.='		document.getElementById("container_rentrules").style.left="0px";';
$outstr.='	} else if (Width >= 1160) {';
$outstr.='		var left_size=Math.round((Width-1160)/2);';
$outstr.='		document.getElementById("container_rentrules").style.left=String(left_size)+"px";';
$outstr.='	}';
$outstr.='}';
$outstr.='</script>';
$outstr.='<script>';
$outstr.='(function(i,s,o,g,r,a,m){';
$outstr.='i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){';
$outstr.='(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),';
$outstr.='m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)';
$outstr.='})(window,document,\'script\',\'//www.google-analytics.com/analytics.js\',\'ga\');';
$outstr.='ga(\'create\', \'UA-43061315-1\', \'comuf.com\');';
$outstr.='ga(\'send\', \'pageview\');';
$outstr.='</script>';
$outstr.='<!-- Yandex.Metrika counter -->';
$outstr.='<script type="text/javascript">';
$outstr.='(function (d, w, c) {';
$outstr.='(w[c] = w[c] || []).push(function() {';
$outstr.='try {';
$outstr.='w.yaCounter22020040 = new Ya.Metrika({';
$outstr.='id:22020040,';
$outstr.='clickmap:true,';
$outstr.='trackLinks:true,';
$outstr.='accurateTrackBounce:true});';
$outstr.='} catch(e) {';
$outstr.='}';
$outstr.='});';
$outstr.='var n = d.getElementsByTagName("script")[0],';
$outstr.='s = d.createElement("script"),';
$outstr.='f = function () {';
$outstr.='n.parentNode.insertBefore(s, n);';
$outstr.='};';
$outstr.='s.type = "text/javascript";';
$outstr.='s.async = true;';
$outstr.='s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";';
$outstr.='if (w.opera == "[object Opera]") {';
$outstr.='d.addEventListener("DOMContentLoaded", f, false);';
$outstr.='} else { f();';
$outstr.='}';
$outstr.='})(document, window, "yandex_metrika_callbacks");';
$outstr.='</script>';
$outstr.='<noscript><div><img src="//mc.yandex.ru/watch/22020040" style="position:absolute; left:-9999px;" alt="" /></div></noscript>';
$outstr.='<!-- /Yandex.Metrika counter -->';
$outstr.='<div class="container_rentrules" id="container_rentrules" style="position:relative; left:0px; top:0px; width:1160px; height:800px; z-index:0;">';
//$outstr.='<form method="post" action="login.php">';
$outstr.='<div id="h1_level1" class="h1" style="position:relative;display:block; left:0px; top:0px; width:1160px; height:40px; z-index:0;border-radius: 3px;border: 1px solid #000;overflow: hidden;">';
$outstr.='<h1 style="position:relative;left:0px; top:0px; width:1160px; height:40px; z-index:0; color:white;margin:0 0 0 0;">Правила аренды</h1>';
$outstr.='</div>';
$outstr.='<a href="http://autovarendu.biz/"><button class="btn btn-lg btn-primary btn-block" name="_BakToMain" value="На главную">На главную</button></a>';
$outstr.='<div class="content_level1" style="position:relative;display:block; left:0px; top:20px; width:100%; height:656px; z-index:0;border-radius: 3px;border: 1px solid #000;overflow: hidden;font-size:8px;">';
$mydocument_reader_class=new document_reader_class('rentrules.txt');
$outstr.=$mydocument_reader_class->get_file_data('rentrules.txt');
$outstr.='<div id="copyright_level1" class="ul.nav" style="position:relative; left: 40%; top:1%; width:200px; height:20px;font-size:13px;">';
$outstr.='<p class="a"> ИП Красавин Д.В. 2011-2015</p>';
$outstr.='</div>';
$outstr.='</div>';
//$outstr.='</form>';
$outstr.='</div>';
$outstr.='</body>';
$outstr.='</html>';
print $outstr;
?>
