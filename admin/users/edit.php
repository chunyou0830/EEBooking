<!DOCTYPE html>
<html>
<head>
	<title>設定｜清大電機線上訂書系統</title>
	<?php require('../../meta.php');?>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="../../js/register.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
	<div class="row">
		<?php require('../../nav.php');?>
	</div>
	<div class="row container">
		<div class="col-lg-12 container">
			<h3>用戶管理</h3>
			<div class="well">
            <?php if(isset($_GET["status"]) && $_GET["status"] == 'updated'){?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                資料已更新。
            </div>
            <?php }?>
            <?php if(isset($_GET["status"]) && $_GET["status"] == 'unauth'){?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                權限不足。
            </div>
            <?php }?>
            <?php
            	$user_uid = $_GET['uid'];
            	$user_array = mysql_query("SELECT * FROM `users` WHERE `uid`='$user_uid'");
            	while($user_row = mysql_fetch_array($user_array)){
            		$user_name = $user_row['name'];
            		$user_sid = $user_row['sid'];
            		$user_email = $user_row['email'];
            		$user_auth = $user_row['auth'];
            		$user_fb_id = $user_row['fb_id'];
            	}
            ?>
			    <form method="POST" action="userop.php?action=update">
				  <input type="hidden" id="uid" name="uid" value="<?php echo $user_uid; ?>" required>
				  <div class="form-group">
				    <label for="name">姓名</label>
				    <input type="text" class="form-control" id="name" name="name" value="<?php echo $user_name; ?>" required>
				  </div>
				  <div class="form-group">
				    <label for="sid">學號</label>
				    <input type="text" class="form-control" value="<?php echo $user_sid; ?>" required disabled>
				    <input type="hidden" class="form-control" id="sid_hidden" name="sid" value="<?php echo $user_sid; ?>" required>
				  </div>
				  <div class="form-group">
				    <label for="email">Email</label>
				    <input type="email" class="form-control" id="email" name="email" value="<?php echo $user_email; ?>" required>
				  </div>
				  <div class="form-group">
				    <label for="auth">權限等級</label>
				    <input type="auth" class="form-control" id="auth" name="auth" value="<?php echo $user_auth; ?>" required>
					<p class="help-block">系統管理員或班代 255；一般學生 100；廠商 50。最高不得超過 255！</p>
				  </div>
				  <div class="form-group">
				    <label for="fb_id">Facebook ID</label>
				    <input type="fb_id" class="form-control" id="fb_id" name="fb_id" value="<?php echo $user_fb_id; ?>" required>
				    <p class="help-block">除非確定，否則請勿任意更改。</p>
				  </div>
				  <div class="form-group">
				    <label for="password">新密碼</label>
				    <input type="password" class="form-control" id="password" name="password">
				    <p class="help-block">若要更新，請輸入新密碼。</p>
				  </div>
				  <div class="form-group">
				    <label for="password_check">確認新密碼</label>
				    <input type="password" class="form-control" id="password_check" name="password_check">
				    <p class="text-danger" id="password_not_match">兩次密碼不一致。</p>
				  </div>
				  <input type="hidden" id="fb_id" name="fb_id" value="<?php echo $fb_id; ?>" required>
				  <input type="hidden" id="fb_token" name="fb_token" value="<?php echo $fb_token; ?>" required>
				  <p class="text-right"><button type="submit" class="btn btn-primary" id="submit">儲存</button></p>
				</form>
			</div>
		</div>
	</div>
	<div class="row">
		<?php require('../foot.php');?>
	</div>
</div>
</body>
</html>