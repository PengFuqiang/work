
	var registerForm = $("#form_register");
	function beforeSubmit() {
		var phone = $.trim($("#phone").val());
		var password = $.trim($("#password").val());
		var check_pwd = $.trim($("#check_pwd").val());
		var flag = true;
		if (phone == '') {
			flag = false;
           	alert("手机号不能为空！");
        } else if (phone.length != 11) {
        	flag = false;
            alert("请输入11位手机号码！");
        } else {
            var phone_mode = /^[1][3,4,5,7,8][0-9]{9}$/;
            if (!phone_mode.test(phone)) {
            	flag = false;
                alert("请输入有效手机号！");
            }
        }
        if (password == '') {
        	flag = false;
           	alert("密码不能为空！");
        } else if (password.length < 6 || password.length > 16) {
        	flag = false;
            alert("密码长度为6-16位！");
        } else {
            var password_mode = /^[0-9a-zA-Z]{3,16}$/;
            if (!password_mode.test(password)) {
            	flag = false;
                alert("密码格式为数字或字母组合！");
            }
        }
        if (check_pwd != password) {
        	flag = false;
        	alert("密码不一致！");
        }
        if (flag) {
        	registerForm.submit();
        }
	}