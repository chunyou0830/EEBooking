<!DOCTYPE html>
<html>
<head>
	<title>公告設定｜清大電機線上訂書系統</title>
	<?php require('../../meta.php');?>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="../../js/book.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
	<div class="row">
		<?php require('../../nav.php');?>
	</div>
	<div class="row container">
		<div class="col-lg-12 container">

			<h3>公告設定			<a class="btn btn-primary pull-right btn-sm" href="edit.php?action=add">新增公告</a></h3>
            <?php if(isset($_GET["status"]) && $_GET["status"] == 'updated'){?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                資料已更新。
            </div>
            <?php }?>
			<table class="table table-hover table-bordered">
				<col width="5%">
				<col width="50%">
				<col width="20%">
				<col width="20%">
				<col width="5%">
				<thead>
				    <tr>
					  	<th>編號</th>
					  	<th>內文</th>
					  	<th>開始時間</th>
					  	<th>結束時間</th>
					  	<th>操作</th>
				    </tr>
			  	</thead>
			  	<tbody>
				  	<?php
					    $sql = "SELECT * FROM `announce`";
					    $result = mysql_query($sql);
					    $count = 1;

						if(mysql_num_rows($result)==0){
						    echo "<tr><td class=\"text-center\" colspan=\"5\">沒有任何公告。</td></tr>";
						}
						else{
						    while($row = mysql_fetch_array($result)){
						    	$aid = $row['aid'];
						    	$content = $row['content'];
						    	$start_date = $row['start_date'];
						    	$end_date = $row['end_date'];
							    echo "<tr id=\"row$aid\"><td>$aid</td><td>$content</td><td>$start_date</td><td>$end_date</td><td><a class=\"btn btn-default btn-xs\" href=\"edit.php?action=update&aid=$aid\" role=\"button\" id=\"detbtn$aid\">詳細資料</a></td></tr>";
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