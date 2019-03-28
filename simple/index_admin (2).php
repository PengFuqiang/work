<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<title>学生档案</title>
	<style>
	
		body {
			margin: 0;
			padding: 0;
			background-color: #F7F7F7;
			font-family: '汉仪大隶书繁';
		}

		form {
			max-width: 640px;
			width: 100%;
			margin: 24px auto;
			font-size: 18px;
		}

		label {
			display: block;
			margin: 10px 10px 15px;
			font-size: 16px;
		}

		input {
			display: block;
			width: 100%;
			height: 40px;
			font-size: 16px;
			margin-top: 10px;
			padding: 6px 10px;
			color: #333;
			border: 1px solid #CCC;
			box-sizing: border-box;
		}

		meter, progress {
			display: block;
			width: 100%;
			margin-top: 10px;
		}

		.btn {
			margin-top: 30px;
		}

		.btn input {
			color: #FFF;
			background-color: green;
			border: 0 none;
			outline: none;
			cursor: pointer;
		}

	</style>
</head>
<body>
	<form action="">
		<fieldset>
			<legend>学生档案</legend>
			<label for="">
				姓名: <input type="text" required autofocus placeholder="请输入姓名">
			</label>
			<label for="">
				手机号码: <input type="tel" pattern="1\d{10}" placeholder="请输入手机号码">
			</label>
			<label for="">
				邮箱地址: <input type="email" placeholder="请输入邮箱地址">
			</label>
			<label for="">
				所属学院: <input type="text" list="course" placeholder="前端与移动开发学院">
				<datalist id="course">
					<option value="前端与移动开发"></option>
					<option value="PHP"></option>
					<option value="JAVA"></option>
					<option value="Android"></option>
					<option value="IOS"></option>
					<option value="UI设计"></option>
					<option value="C++"></option>
				</datalist>
			</label>
			<label for="">
				入学成绩: <input type="number" max="100" id="score" step="10" value="80">
			</label>
			<label for="">
				基础水平: <meter min="0" max="100" low="60" high="80" value="80" id="level"></meter>
			</label>
			<label for="">
				入学日期: <input type="date" value="2016-01-01">
			</label>
			<label for="">
				毕业时间: <input type="date" value="2016-05-01">
			</label>
			<label for="">
				课程进度: <progress min="0" max="100" value="10"></progress>
			</label>
			<label for="" class="btn">
				<input type="submit" value="保存">
			</label>
		</fieldset>
	</form>
	<script>
		var score = document.getElementById('score');
		var level = document.getElementById('level');

		score.oninput = function () {
			level.value = this.value;
		}
	</script>
</body>
</html>