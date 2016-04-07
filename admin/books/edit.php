<!DOCTYPE html>
<html>
<head>
	<title>書籍設定｜清大電機線上訂書系統</title>
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
			<h3>書籍資料</h3>
			<div class="well">
            <?php if(isset($_GET["status"]) && $_GET["status"] == 'updated'){?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                資料已更新。
            </div>
            <?php }?>
				  	<?php
						if($_GET['action']=="add"){
				  			$bid = "";
							$title = "";
							$author = "";
							$price = "";
							$isbn = "";
							$recieve_available = "0";
							$recieve_start = "";
							$recieve_end = "";
							$recieve_place = "";
							$recieve_charge = "";
						}
						else if($_GET['action']=="update"){
				  			$bid = $_GET['bid'];
						    $sql = "SELECT * FROM books WHERE `bid`='$bid'";
						    $result = mysql_query($sql);
						    $count = 1;
							while($row = mysql_fetch_array($result)){
								$title = $row['title'];
								$author = $row['author'];
								$price = $row['price'];
								$isbn = $row['isbn'];
								$recieve_available = $row['recieve_available'];
								$recieve_start = $row['recieve_start'];
								$recieve_end = $row['recieve_end'];
								$recieve_place = $row['recieve_place'];
								$recieve_charge = $row['recieve_charge'];
							}
						}
				    ?>
			    <form method="POST" action="bookop.php?action=<?php echo $_GET['action'];?>">
				  <input type="hidden" id="bid" name="bid" value="<?php echo $bid; ?>" required>
				  <div class="form-group">
				    <label for="title">書名</label>
				    <input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>" required>
				  </div>
				  <div class="form-group">
				    <label for="author">作者</label>
				    <input type="text" class="form-control" id="author" name="author" value="<?php echo $author; ?>" required>
				  </div>
				  <div class="form-group">
				    <label for="isbn">ISBN</label>
				    <input type="text" class="form-control" id="isbn" name="isbn" value="<?php echo $isbn; ?>" required>
				  </div>
				  <div class="form-group">
				    <label for="price">售價</label>
  					<div class="input-group">
    					<span class="input-group-addon">$</span>
				    	<input type="text" class="form-control" id="price" name="price" value="<?php echo $price; ?>" required>
  					</div>
				  </div>
				  <div class="form-group">
				    <label for="recieve_date">領書資訊</label>
				    <div class="row">
					    <div class="col-lg-2">
				    		<p class="help-block">領書狀態</p>
							<label class="radio-inline">
								<input type="radio" id="recieve_available" name="recieve_available" value="1" <?php if($recieve_available) echo "checked";?>> 可領書
							</label>
							<label class="radio-inline">
								<input type="radio" id="recieve_unavailable" name="recieve_available" value="0" <?php if(!$recieve_available) echo "checked";?>> 不可領書
							</label>
					    </div>
					    <div class="col-lg-5">
				    		<p class="help-block">開始時間</p>
					    	<input type="datetime-local" class="form-control" id="recieve_start" name="recieve_start" value="<?php echo substr($recieve_start, 0, 10)."T".substr($recieve_start, 11, 8); ?>">
					    </div>
					    <div class="col-lg-5">
				    		<p class="help-block">結束時間</p>
					    	<input type="datetime-local" class="form-control" id="recieve_end" name="recieve_end" value="<?php echo substr($recieve_end, 0, 10)."T".substr($recieve_end, 11, 8); ?>">
					    </div>
				    </div>
				  </div>
				  <div class="form-group">
				    <p class="help-block">領書地點</p>
				    <input type="text" class="form-control" id="recieve_place" name="recieve_place" value="<?php echo $recieve_place; ?>">
				  </div>
				  <div class="form-group">
				    <p class="help-block">領書負責人</p>
				    <input type="text" class="form-control" id="recieve_charge" name="recieve_charge" value="<?php echo $recieve_charge; ?>">
				  </div>
				  <p><a href="index.php" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> 返回清單</a><span class="pull-right"><?php if($_GET['action']!="add"){?><a type="submit" class="btn btn-danger" id="submit" onclick="conf(<?php echo $bid; ?>);">刪除</a><?php } ?> <button type="submit" class="btn btn-primary" id="submit">儲存</button></span></p>
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