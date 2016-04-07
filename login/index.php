<?php

session_start();

if(isset($_SESSION['auth']) && ($_SESSION['auth'] == 'admin' || $_SESSION['auth'] == 'leader' || $_SESSION['auth'] == 'student')){
    header('Location: ../dashboard/index.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>清大電機線上訂書系統</title>
    <?php require('../meta.php');?>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4"><br><br><br><br>
			<div class="panel panel-default">
			  <h3 align="center">清大電機線上訂書系統</h3>
			  <div class="panel-body">
			    <form method="post" action="auth.php?action=login">
				  <div class="form-group">
				    <label for="email">Email</label>
				    <input type="email" class="form-control" id="email" name="email" required>
				  </div>
				  <div class="form-group">
				    <label for="password">密碼</label>
				    <input type="password" class="form-control" id="password" name="password" required>
				  </div>
				  <a class="btn btn-primary" href="../login/fbconn.html">Facebook 登入</a> 
				  <a class="btn btn-default" href="../login/register.php">註冊</a>
				  <button type="submit" class="btn btn-default pull-right">登入</button>
				</form>
			  </div>
			</div>
            <?php if(isset($_GET["status"]) && $_GET["status"] == 'incorrect'){?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                密碼錯誤。
            </div>
            <?php }else if(isset($_GET["status"]) && $_GET["status"] == 'notfound'){?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                找不到此使用者。
            </div>
            <?php }else if(isset($_GET["status"]) && $_GET["status"] == 'logreq'){?>
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                請登入。
            </div>
            <?php }else if(isset($_GET["status"]) && $_GET["status"] == 'unauth'){?>
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                您沒有權限瀏覽本頁面。
            </div>
            <?php }else if(isset($_GET["status"]) && $_GET["status"] == 'logout'){?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                已登出。
            </div>
            <?php }else if(isset($_GET["status"]) && $_GET["status"] == 'regsuc'){?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                註冊成功。
            </div>
            <?php }?>
            <?php if(isset($_GET["status"]) && $_GET["status"] == 'sysdwn'){?>
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                系統暫停服務中。
            </div>
            <?php }?>
		</div>
	</div>
</div>
</body>
</html>