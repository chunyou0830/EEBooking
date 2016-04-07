<!DOCTYPE html>
<html>
<head>
	<title>設定｜清大電機線上訂書系統</title>
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
		<?php require('../nav.php');?>
	</div>
	<div class="row container">
		<div class="col-lg-12 container">
			<h3>個人資料</h3>
			<div class="well">
            <?php if(isset($_GET["status"]) && $_GET["status"] == 'updated'){?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                資料已更新。
            </div>
            <?php }?>
            <?php if(isset($_GET["status"]) && $_GET["status"] == 'incorrect'){?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                原密碼錯誤。
            </div>
            <?php }?>
			    <form method="POST" action="userop.php?action=update">
				  <input type="hidden" id="uid" name="uid" value="<?php echo $uid; ?>" required>
				  <div class="form-group">
				    <label for="name">姓名</label>
				    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
				  </div>
				  <div class="form-group">
				    <label for="sid">學號</label>
				    <input type="text" class="form-control" value="<?php echo $sid; ?>" required disabled>
				    <input type="hidden" class="form-control" id="sid_hidden" name="sid" value="<?php echo $sid; ?>" required>
				  </div>
				  <div class="form-group">
				    <label for="email">Email</label>
				    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
				  </div>
				  <div class="form-group">
				    <label for="password_old">原密碼</label>
				    <input type="password" class="form-control" id="password_old" name="password_old" required>
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