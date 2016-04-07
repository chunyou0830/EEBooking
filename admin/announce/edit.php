<!DOCTYPE html>
<html>
<head>
	<title>公告設定｜清大電機線上訂書系統</title>
	<?php require('../../meta.php');?>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="../../js/register.js"></script>
	<script>
		function conf(id){
			if(confirm("確認刪除？"))
				window.location.assign("announceop.php?action=delete&aid="+id);
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
			<h3>公告資料</h3>
			<div class="well">
            <?php if(isset($_GET["status"]) && $_GET["status"] == 'updated'){?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                資料已更新。
            </div>
            <?php }?>
				  	<?php
						if($_GET['action']=="add"){
				  			$aid = "";
							$content = "";
							$link = "";
							$color = "";
							$start_date = "";
							$end_date = "";
						}
						else if($_GET['action']=="update"){
				  			$aid = $_GET['aid'];
						    $sql = "SELECT * FROM `announce` WHERE `aid`='$aid'";
						    $result = mysql_query($sql);
						    $count = 1;
							while($row = mysql_fetch_array($result)){
								$content = $row['content'];
								$link = $row['link'];
								$color = $row['color'];
								$start_date = $row['start_date'];
								$end_date = $row['end_date'];
							}
						}
				    ?>
			    <form method="POST" action="announceop.php?action=<?php echo $_GET['action'];?>">
				  <input type="hidden" id="aid" name="aid" value="<?php echo $aid; ?>" required>
				  <div class="form-group">
				    <label for="content">公告內文</label>
				    <input type="text" class="form-control" id="content" name="content" value="<?php echo $content; ?>" required>
				  </div>
				  <div class="form-group">
				    <label for="link">連結</label>
				    <input type="text" class="form-control" id="link" name="link" value="<?php echo $link; ?>">
				  </div>
				  <div class="form-group">
				    <label for="color">顏色</label>
				    <select class="form-control" id="color" name="color" required>
				    	<option <?php echo ($color=="default")? "selected":""; ?> value="default">預設</option>
				    	<option <?php echo ($color=="success")? "selected":""; ?> value="success">綠色</option>
				    	<option <?php echo ($color=="info")? "selected":""; ?> value="info">淺藍</option>
				    	<option <?php echo ($color=="primary")? "selected":""; ?> value="primary">深藍</option>
				    	<option <?php echo ($color=="warning")? "selected":""; ?> value="warning">橘色</option>
				    	<option <?php echo ($color=="danger")? "selected":""; ?> value="danger">紅色</option>
				    </select>
				  </div>
				  <div class="form-group">
				    <label for="recieve_date">公告時間</label>
				    <div class="row">
					    <div class="col-lg-6">
				    		<p class="help-block">開始：</p>
					    	<input type="datetime-local" class="form-control" id="recieve_start" name="recieve_start" value="<?php echo substr($start_date, 0, 10)."T".substr($start_date, 11, 8); ?>" required>
					    </div>
					    <div class="col-lg-6">
				    		<p class="help-block">結束：</p>
					    	<input type="datetime-local" class="form-control" id="recieve_end" name="recieve_end" value="<?php echo substr($end_date, 0, 10)."T".substr($end_date, 11, 8); ?>" required>
					    </div>
				    </div>
				  </div>
				  <p><a href="index.php" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> 返回清單</a><span class="pull-right"><?php if($_GET['action']!="add"){?><a type="submit" class="btn btn-danger" id="submit" onclick="conf(<?php echo $aid; ?>);">刪除</a><?php }?> <button type="submit" class="btn btn-primary" id="submit">儲存</button></span></p>
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