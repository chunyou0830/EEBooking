<?php

session_start();

if(isset($_SESSION['auth']) && ($_SESSION['auth'] == 'admin' || $_SESSION['auth'] == 'leader' || $_SESSION['auth'] == 'student')){
	header('Location: ../dashboard/index.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>註冊｜清大電機線上訂書系統</title>
	<?php require('../meta.php');?>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="../js/register.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4"><br><br><br><br>
			<div class="panel panel-default">
			  <h3 align="center">清大電機線上訂書系統<br>使用者註冊</h3>
			  <div class="panel-body">
				<form method="post" action="../settings/userop.php?action=register">
				  <div class="form-group">
					<label for="name">姓名</label>
					<input type="text" class="form-control" id="name" name="name" required>
				  </div>
				  <div class="form-group">
					<label for="sid">學號</label>
					<input type="text" class="form-control" id="sid" name="sid" required>
					<p class="help-block">一旦註冊，學號無法更動，請再次確認學號正確！</p>
					<p class="text-danger" id="sid_not_match">學號格式錯誤。</p>
				  </div>
				  <div class="form-group">
					<label for="email">Email</label>
					<input type="email" class="form-control" id="email" name="email" required value="<?php echo isset($_GET['email']) ? $_GET['email'] : ""; ?>" >
				  </div>
				  <div class="form-group">
					<label for="password">密碼</label>
					<input type="password" class="form-control" id="password" name="password" required>
				  </div>
				  <div class="form-group">
					<label for="password_check">密碼確認</label>
					<input type="password" class="form-control" id="password_check" name="password_check" required>
					<p class="text-danger" id="password_not_match">兩次密碼不一致。</p>
				  </div>
				  <input type="hidden" id="fb_id" name="fb_id" value="<?php echo isset($_GET['fb_id']) ? $_GET['fb_id'] : "" ?>" required>
				  <input type="hidden" id="fb_token" name="fb_token" value="<?php echo isset($_GET['fb_token']) ? $_GET['fb_token'] : "" ?>" required>
				  <a href="../login/index.php" class="btn btn-default">登入</a>
				  <button type="submit" class="btn btn-primary pull-right" id="submit">註冊</button>
				</form>
			  </div>
			</div>
		</div>
	</div>
</div>
</body>
</html>