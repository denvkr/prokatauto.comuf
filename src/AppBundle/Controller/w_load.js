/*
window.onload = function () {
	var Width = (window.screen.width);
	var Height = (window.screen.height);
	if (Width < 1160) {
		
		if (document.getElementById("container_main")!==null) {
			document.getElementById("container_main").style.left="0px";			
		}
		if (document.getElementById("container_news")!==null) {
			document.getElementById("container_news").style.left="0px";			
		}
		if (document.getElementById("container_rentrules")!==null) {
			document.getElementById("container_rentrules").style.left="0px";			
		}
		if (document.getElementById("container_cars")!==null) {
			document.getElementById("container_cars").style.left="0px";			
		}
		if (document.getElementById("container_contact")!==null) {
			document.getElementById("container_contact").style.left="0px";			
		}		
	} else if (Width >= 1160) {
		
		var left_size=Math.round((Width-1160)/2);

		if (document.getElementById("container_main")!==null) {
			document.getElementById("container_main").style.left=String(left_size)+"px";			
		}
		if (document.getElementById("container_news")!==null) {
			document.getElementById("container_news").style.left=String(left_size)+"px";			
		}
		if (document.getElementById("container_rentrules")!==null) {
			document.getElementById("container_rentrules").style.left=String(left_size)+"px";			
		}
		if (document.getElementById("container_cars")!==null) {
			document.getElementById("container_cars").style.left=String(left_size)+"px";			
		}
		if (document.getElementById("container_contact")!==null) {
			document.getElementById("container_contact").style.left=String(left_size)+"px";			
		}
	}
	document.getElementById("body_container").style.visibility="visible";
}
*/
$(document).ready(function() {

function btn_font_size() {
	//console.log('clientWidth'+' '+$('#body_container').prop('clientWidth'));
	//console.log('clientHeight'+' '+$('#body_container').prop('clientHeight'));

	var Width = $('#body_container').prop('clientWidth');
	var Height = $('#body_container').prop('clientHeight');
	
	//console.log(Width);
	//console.log(Height);	
	console.log($(".btn-lg, .btn-group-lg > .btn[name='_Registering']").css('font-size'));
	if (Width < 700) {
		$("[name='_Registering']").css('font-size','8px');
		$("[name='_Sign_In']").css('font-size','10px');
	} else if (Width >= 700) {
		$("[name='_Registering']").css('font-size','18px');
		$("[name='_Sign_In']").css('font-size','18px');		
	}
}
});

function BrowserInfo() {
 uaVers="";
	if (window.navigator.userAgent.indexOf("Opera") >= 0)
	  {
	   ua = "Opera";
	   uaVers=window.navigator.userAgent.substr(window.navigator.userAgent.indexOf("Opera")+6,4);
	  }
	else
	if (window.navigator.userAgent.indexOf("Gecko") >= 0)// (Mozilla, Netscape, FireFox)
	  {
	   ua = "Netscape";
	   uaVers=window.navigator.userAgent.substr(window.navigator.userAgent.indexOf("Gecko")+6,8)+ " ("+ window.navigator.userAgent.substr(8,3) + ")";
	  }
	else
	if (window.navigator.userAgent.indexOf("MSIE") >= 0)
	  {
	   ua = "Explorer";
	   uaVers=window.navigator.userAgent.substr(window.navigator.userAgent.indexOf("MSIE")+5,3);
	  }
	else
	   ua = window.navigator.appName;
return ua;
}

function Dimension () {
	var Width = (window.screen.width);
	var Height = (window.screen.height);
	if (Width < 1160) {
		document.getElementById("container_main").style.left="0px";
	} else if (Width >= 1160) {
		var left_size=Math.round((Width-1160)/2);
		document.getElementById("container_main").style.left=String(left_size)+"px";
	}
}

function gotopage(Page){
	switch (Page)
	{
	case 0:
		window.location.href = "http://"+location.host+"/index.php";
		break;
	case 1:
		window.location.href = "http://"+location.host+"/news.php";
		break;
	case 2:
		window.location.href = "http://"+location.host+"/rentrules.php";
		break;
	case 3:
		window.location.href = "http://"+location.host+"/cars.php";
		break;
    case 4:
		window.location.href = "http://"+location.host+"/contact.php";
		break;
	};
}