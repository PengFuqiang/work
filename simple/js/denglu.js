
	function beforeSubmit() {
		var loginForm = $("#form_login");
		var phone = $.trim($("#phone").val());
		var password = $.trim($("#password").val());
        loginForm.submit();
	}