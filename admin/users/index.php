<!DOCTYPE html>
<html>
<head>
	<title>用戶管理｜清大電機線上訂書系統</title>
	<?php require('../../meta.php');?>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="../../js/book.js"></script>
	<script src="../../js/filter_users.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
	<div class="row">
		<?php require('../../nav.php');?>
	</div>
	<div class="row container">
		<div class="col-lg-12 container">

			<h3>用戶管理

		<div class="form-group pull-right">
			<input type="text" class="form-control" id="filter" placeholder="快速搜尋">
		</div>
			</h3>
            <?php if(isset($_GET["status"]) && $_GET["status"] == 'updated'){?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                資料已更新。
            </div>
            <?php }?>
			<table class="table table-hover table-bordered">
				<col width="5%">
				<col width="15%">
				<col width="10%">
				<col width="35%">
				<col width="15%">
				<col width="15%">
				<col width="5%">
				<thead>
				    <tr>
					  	<th>編號</th>
					  	<th>姓名</th>
					  	<th>學號</th>
					  	<th>Email</th>
					  	<th>Facebook ID</th>
					  	<th>權限級別</th>
					  	<th>操作</th>
				    </tr>
			  	</thead>
			  	<tbody id="list">
				  	<?php
					    $sql = "SELECT * FROM users";
					    $result = mysql_query($sql);
					    $count = 1;

						if(mysql_num_rows($result)==0){
						    echo "<tr><td class=\"text-center\" colspan=\"7\">沒有任何用戶。</td></tr>";
						}
						else{
						    while($row = mysql_fetch_array($result)){
						    	$uid = $row['uid'];
						    	$name = $row['name'];
						    	$sid = $row['sid'];
						    	$email = $row['email'];
						    	$fb_id = $row['fb_id'];
						    	$auth = $row['auth'];
						    	$isbn = $row['isbn'];
							    echo "<tr id=\"row$uid\"><td>$uid</td><td>$name</td><td>$sid</td><td>$email</td><td>$fb_id</td><td>$auth</td><td><a class=\"btn btn-default btn-xs\" href=\"edit.php?action=update&uid=$uid\" role=\"button\" id=\"btn$uid\">編輯</a></td></tr>";
							    $count++;
						    }
						}
				    ?>
			  	</tbody>
			</table>
		</div>
	</div>
	<div class="row">
		<?php require('../../foot.php');?>
	</div>
</div>
</body>
</html>