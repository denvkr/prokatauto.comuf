function checkresult_login(field) {
	
	//var regExpr = new RegExp('^\w+$','i');
	var re = /^[\d\w\u0410-\u044F\-\ ]+$/ig;	
	//alert("Возникла ошибка. Пожалуйста проверьте вводимые данные.");
	
	//alert(regExpr.test(field.value));
	//console.log(field.value);
	if (re.exec(field.value) === null) {
	//if (regExpr.test(field.value)===false) {
		//alert("Возникла ошибка. Пожалуйста проверьте вводимые данные Login.");
		//	document.forms[0].login.value="";		
		//document.forms[0].login.focus();
		setTimeout("$('#login').focus();",1);
		setTimeout("$('#login').select();",1);
		console.log('null');
	} else {
		//document.forms[0].password.disabled="0";
		$('#password').attr('disabled', false);
		$('#password').focus();
		$('#password').select();
		console.log($('#password').attr('disabled')+field.value);		
	}

}

function checkresult_password(field) {
	
	//var regExpr = new RegExp('^(?=.*[a-zA-Z0-9]).{6,25}$','ig');
	var re = /^(?=.*[a-zA-Z0-9]).{6,25}$/ig;	
	//alert("Возникла ошибка. Пожалуйста проверьте вводимые данные.");
	
	//alert(regExpr.test(field.value));
	//console.log(field.value);
	if (re.exec(field.value) === null) {
	
		//alert("Возникла ошибка. Пожалуйста проверьте вводимые данные Password.");
	
		//	document.forms[0].password.value="";
	
		//document.forms[0].login.focus();
		//$('#password').focus();
			$('#password').focus();
			$('#password').select();	
	} else {
			$('#email').attr('disabled', false);
			$('#email').focus();
			$('#email').select();
	}

}


function checkresult_email(field) {
	
	//var regExpr = new RegExp('^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$','ig');
	var re = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/ig;	
	//alert("Возникла ошибка. Пожалуйста проверьте вводимые данные.");
	
	//alert(regExpr.test(field.value));
	//console.log(field.value);
	if (re.exec(field.value) === null) {
	
		//alert("Возникла ошибка. Пожалуйста проверьте вводимые данные Email.");
	
		//document.forms[0].email.value="";
	
		//document.forms[0].login.focus();
		//$('#email').focus();
			$('#email').focus();
			$('#email').select();
		
	} else {
			$('#firstname').attr('disabled', false);
			$('#firstname').focus();
			$('#firstname').select();
	}
}

function checkresult_firstname(field) {

	//var regExpr = new RegExp('^[\-A-Za-z\u0410-\u044F]+$','ig');
	var re = /^[\-A-Za-z\u0410-\u044F]+$/ig;	
	//alert("Возникла ошибка. Пожалуйста проверьте вводимые данные.");
	
	//alert(regExpr.test(field.value));
	//console.log(field.value);
	if (re.exec(field.value) === null) {
	
		//alert("Возникла ошибка. Пожалуйста проверьте вводимые данные FirstName.");

		//document.forms[0].firstname.value="";
	
		//document.forms[0].login.focus();
	
		//$('#firstname').focus();
			$('#firstname').focus();
			$('#firstname').select();
		
	} else {
			$('#lastname').attr('disabled', false);
			$('#lastname').focus();
			$('#lastname').select();
	}
}

function checkresult_lastname(field) {

	//var regExpr = new RegExp('^[\-A-Za-z\u0410-\u044F]+$','ig');
	var re = /^[\-A-Za-z\u0410-\u044F]+$/ig;	
	//alert("Возникла ошибка. Пожалуйста проверьте вводимые данные.");
	
	//alert(regExpr.test(field.value));
	//console.log(field.value);
	if (re.exec(field.value) === null) {
	
	//alert("Возникла ошибка. Пожалуйста проверьте вводимые данные LastName.");
	
	//document.forms[0].lastname.value="";
	
	//document.forms[0].login.focus();
			$('#lastname').focus();
			$('#lastname').select();
		
	} else {
			$('#address').attr('disabled', false);
			$('#address').focus();
			$('#address').select();
	}
}

function checkresult_address(field) {

	//var regExpr = new RegExp('^[0-9]{6}\,[\d\D\w\W]+\,[\d\D\w\W]+\,[A-Za-z0-9\.]{1,3}\ ?[0-9]{1,4}\\?[0-9]{0,4}$','ig'); //\s[0-9\\]{1,4}
	var re = /^[0-9]{6}\,[\d\D\w\W]+\,[\d\D\w\W]+\,[A-Za-z0-9\.]{1,3}\ ?[0-9]{1,4}\\?[0-9]{0,4}$/ig;	
	//alert("Возникла ошибка. Пожалуйста проверьте вводимые данные.");
	
	//alert(regExpr.test(field.value));
	//console.log(field.value);
	if (re.exec(field.value) === null) {
	
	//alert("Возникла ошибка. Пожалуйста проверьте вводимые данные LastName.");
	
	//document.forms[0].lastname.value="";
	
	//document.forms[0].login.focus();
			$('#address').focus();
			$('#address').select()
		
	} else {
			$('#age').attr('disabled', false);
			$('#age').focus();
			$('#age').select();
	}
}

function checkresult_age(field) {

	//var regExpr = new RegExp('^[0-9]{2,3}$','ig');
	var re = /^[0-9]{2,3}$/ig;	
	//alert("Возникла ошибка. Пожалуйста проверьте вводимые данные.");
	
	//alert(regExpr.test(field.value));
	//console.log(field.value);
	if (re.exec(field.value) === null) {
	
	//alert("Возникла ошибка. Пожалуйста проверьте вводимые данные LastName.");
	
	//document.forms[0].lastname.value="";
	
	//document.forms[0].login.focus();
			$('#age').focus();
			$('#age').select();
		
	} else {
			$('#drivers_length').attr('disabled', false);
			$('#drivers_length').focus();
			$('#drivers_length').select();
	}
}

function checkresult_drivers_length(field) {

	//var regExpr = new RegExp('^[0-9]{1,2}$','ig');
	var re = /^[0-9]{1,2}$/ig;	
	//alert("Возникла ошибка. Пожалуйста проверьте вводимые данные.");
	
	//alert(regExpr.test(field.value));
	//console.log(field.value);
	if (re.exec(field.value) === null) {
	
	//alert("Возникла ошибка. Пожалуйста проверьте вводимые данные LastName.");
	
	//document.forms[0].lastname.value="";
	
	//document.forms[0].login.focus();
			$('#drivers_length').focus();
			$('#drivers_length').select();
		
	} else {
			$('#car_name').attr('disabled', false);
			$('#car_name').focus();
			$('#car_name').select();
	}
}
function checkresult_car_name(field) {

	//var regExpr = new RegExp('^[A-Za-z0-9\u0410-\u044F\-\,\.\\\/]+$','ig');
	var re = /^[A-Za-z0-9\u0410-\u044F\-\,\.\\\/]+$/ig;	
	//alert("Возникла ошибка. Пожалуйста проверьте вводимые данные.");
	
	//alert(regExpr.test(field.value));
	//console.log(field.value);
	if (re.exec(field.value) === null) {
	
	//alert("Возникла ошибка. Пожалуйста проверьте вводимые данные LastName.");
	
	//document.forms[0].lastname.value="";
	
	//document.forms[0].login.focus();
			$('#car_name').focus();
			('#car_name').select();
	} else {
			$('#rent_request').attr('disabled', false);
			$('#rent_request').focus();
			$('#rent_request').select();
	}
}

//ajax форма обработки запроса пользователя на авто в аренду
function submit_user_request(){
	
}
$(document).ready(function(){
	//console.log('test');
	//$( "#login" ).selectmenutext();
	//document.getElementById("age").addEventListener("blur", checkresult_age(document.getElementById("age")), true);
    $( "#car_name" ).selectmenu();
    $( "#age" ).selectmenu();
    $( "#drivers_length" ).selectmenu();
    //.selectmenu( "menuWidget" )
    //  .addClass( "overflow" );    
  });