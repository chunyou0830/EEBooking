<?php

error_reporting(0);
//error_reporting(E_ALL);

	session_start();
	if(!isset($_SESSION['login'])){
			header('Location: /booking/login/index.php?status=logreq');
	}
	require("dbconn.php");
	require("settings.php");

	$uid = $_SESSION['uid'];
	$sql = "SELECT * FROM `users` WHERE `uid`='$uid'";
	$result = mysql_query($sql);
	while($row = mysql_fetch_array($result)){
		$name = $row['name'];
		$sid = $row['sid'];
		$email = $row['email'];
		$fb_id = $row['fb_id'];
		$fb_token = $row['fb_token'];
		$uid = $row['uid'];
		$auth = $row['auth'];
	}

	if(!$config['system'] && $auth < '200'){
			header('Location: /booking/login/index.php?status=sysdwn');
	}

?>
<br>
<br>
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<b class="navbar-brand"><a href="/booking/dashboard/index.php" class="text-muted" style="a:hover{text-decoration:none;}">清大電機線上訂書系統</a></b>
					</div>
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li <?php if($_SERVER['REQUEST_URI']=="/booking/dashboard/index.php"){ ?> class="active"<?php } ?>><a href="/booking/dashboard/index.php">總覽</a></li>
							<li <?php if($_SERVER['REQUEST_URI']=="/booking/books/index.php"){ ?> class="active"<?php } ?>><a href="/booking/books/index.php">書本</a></li>
							<li <?php if($_SERVER['REQUEST_URI']=="/booking/release/index.php"){ ?> class="active"<?php } ?>><a href="/booking/release/index.php">領書</a></li>
							<?php if($auth >= '200'){?>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">管理 <span class="caret"></span></a>
									<ul class="dropdown-menu">
										<li><a href="/booking/admin/books/index.php">書籍</a></li>
										<li><a href="/booking/admin/classes/index.php">課程</a></li>
										<li><a href="/booking/admin/announce/index.php">公告</a></li>
										<li><a href="/booking/admin/release/index.php">發書作業</a></li>
										<?php if($auth == '255'){?>
											<li><a href="/booking/admin/users/index.php">用戶管理</a></li>
											<li><a href="/booking/admin/system/index.php">系統設定</a></li>
										<?php } ?>
									</ul>
								</li>
							<?php } ?>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $sid.' '.$name; ?> <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="/booking/settings/index.php">個人資料</a></li>
									<li><a href="/booking/login/auth.php?action=logout">登出</a></li>
								</ul>
							</li>
						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</nav>

