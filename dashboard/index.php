<!DOCTYPE html>
<html>
<head>
	<title>總覽｜清大電機線上訂書系統</title>
	<?php require('../meta.php');?>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="../js/book.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
	<div class="row">
		<?php require('../nav.php');?>
	</div>
	<div class="row container">
		<div class="col-lg-12 container">
			<h3>公告</h3>
			<div class="well">
				<ul>
					<?php
						date_default_timezone_set('Asia/Taipei');
						$date = date('Y-m-d H:i:s');
						$sql = "SELECT * FROM `announce` WHERE `start_date`<='$date' AND `end_date`>='$date'";
						$result = mysql_query($sql);

						if(mysql_num_rows($result)==0){
							echo "<li>沒有任何公告。</li>";
						}
						else{
							while($row = mysql_fetch_array($result)){
									$content = $row['content'];
									$color = $row['color'];
									echo "<li class=\"text-$color\">$content</li>";
							}
						}
					?>
				</ul>
			</div>
		</div>
	</div>
	<div class="row container">
		<div class="col-lg-12 container">
			<h3>訂購清單</h3>
			<table class="table table-hover table-bordered">
				<col width="5%">
				<col width="80%">
				<col width="10%">
				<col width="5%">
				<thead>
					<tr>
						<th>#</th>
						<th>書名</th>
						<th>價格</th>
						<?php if($config['order']){?><th>操作</th><?php } else{?><th>狀態</th><?php } ?>
					</tr>
				</thead>
				<tbody>
					<?php
						$sql = "SELECT * FROM order_10402 WHERE sid='$sid'";
						$result = mysql_query($sql);
						$count = 1;
						$sum = 0;

						if(mysql_num_rows($result)==0){
							echo "<tr><td class=\"text-center\" colspan=\"4\">尚未訂購任何書籍。</td></tr>";
						}
						else{
							while($row = mysql_fetch_array($result)){
								$oid = $row['oid'];
								$bid = $row['bid'];
								$status = $row['status'];
								$sql = "SELECT * FROM books WHERE bid='$bid'";
								$book_result = mysql_query($sql);
								if(mysql_num_rows($book_result)==0){
									$sql = "DELETE FROM `order_10402` WHERE `order_10402`.`oid` = $oid";
									$result = mysql_query($sql);
									continue;
								}
								while($book_row = mysql_fetch_array($book_result)){
									$title = $book_row['title'];
									$price = $book_row['price'];
									$sum += $price;
									echo "<tr id=\"row$bid\"><td>$count</td><td>$title</td><td class=\"text-right\">$price</td><td>";
									if($config['order']){
										echo "<a class=\"btn btn-danger btn-xs\" href=\"#\" role=\"button\" onclick=\"book('delete','$bid','$sid')\" id=\"delbtn$bid\">刪除本書</a>";
									}
									else{
										if($status=='ordered') echo "<span class=\"label label-info\">訂單成立</span>";
										if($status=='arrived') echo "<span class=\"label label-primary\">等待領書</span>";
										if($status=='recieved') echo "<span class=\"label label-success\">已領書</span>";
									}
									echo "</td></tr>";
								}
								$count++;
							}
						}
					?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="2" class="text-right">應付書費</th>
						<th colspan="2" class="text-right"><?php echo $sum;?></th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
	<div class="row">
		<?php require('../foot.php');?>
	</div>
</div>
</body>
</html>