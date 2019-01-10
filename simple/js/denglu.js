
	var loginForm = $("#form_login");
	function beforeSubmit() {
		var phone = $.trim($("#phone").val());
		var password = $.trim($("#password").val());
        loginForm.submit();
	}