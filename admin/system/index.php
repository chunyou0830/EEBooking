<!DOCTYPE html>
<html>
<head>
	<title>系統設定｜清大電機線上訂書系統</title>
	<?php require('../../meta.php');?>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="../../js/register.js"></script>
	<script>
		function conf(id){
			if(confirm("確認刪除？"))
				window.location.assign("bookop.php?action=delete&bid="+id);
		}
	</script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
	<div class="row">
		<?php require('../../nav.php');?>
	</div>
	<div class="row container">
		<div class="col-lg-12 container">
			<h3>系統設定</h3>
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
			    <form method="POST" action="sysop.php">
				  <input type="hidden" id="uid" name="uid" value="<?php echo $uid; ?>" required>
				  <div class="form-group">
				    <label for="order">訂書開放狀態</label><br>
				    <label class="radio-inline"><input type="radio" id="order_true" name="order" value="true" <?php if($config['order']) echo "checked" ?>> 開放</label>
				    <label class="radio-inline"><input type="radio" id="order_false" name="order" value="false" <?php if(!$config['order']) echo "checked" ?>> 關閉</label>
				  </div>
				  <div class="form-group">
				    <label for="author">系統開放狀態</label><br>
				    <label class="radio-inline"><input type="radio" id="system_true" name="system" value="true" <?php if($config['system']) echo "checked" ?>> 開放</label>
				    <label class="radio-inline"><input type="radio" id="system_false" name="system" value="false" <?php if(!$config['system']) echo "checked" ?>> 關閉</label>
				  </div>
				  
				  <p class="text-right"><button type="submit" class="btn btn-primary" id="submit">儲存</button></p>
				</form>
			</div>
		</div>
	</div>
	<div class="row">
		<?php require('../../foot.php');?>
	</div>
</div>
</body>
</html>