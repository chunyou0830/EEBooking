<!DOCTYPE html>
<html>
<head>
	<title>書籍設定｜清大電機線上訂書系統</title>
	<?php require('../../meta.php');?>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="../../js/book.js"></script>
	<script src="../../js/orderop.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
	<div class="row">
		<?php require('../../nav.php');?>
	</div>
	<div class="row container">
		<div class="col-lg-12 container">
			<h3>發書作業<?php if(isset($_GET['sid'])) echo " : ".$_GET['sid'];?>
			<form method="get" action="index.php" target="_self" class="form-inline pull-right">
				<input type="text" class="form-control" autofocus="autofocus" name="sid" placeholder="學號">
				<button type="submit" class="btn btn-primary">查詢</button>
			</form></h3>
			<table class="table table-hover table-bordered">
				<col width="10%">
				<col width="35%">
				<col width="15%">
				<col width="15%">
				<col width="30%">
				<thead>
					<tr>
						<th>訂單編號</th>
						<th>書籍名稱 (ISBN)</th>
						<th>作者</th>
						<th>價格</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$count = 0;
						$total_price = 0;
						if(!isset($_GET['sid'])){
							echo "<tr><td class=\"text-center\" colspan=\"5\">請輸入領書同學學號。</td></tr>";
						}
						else{
							$sid = $_GET['sid'];
							$sql = "SELECT * FROM `order_10402` WHERE `sid`='$sid'";
							$result = mysql_query($sql);

							if(mysql_num_rows($result)==0){
								echo "<tr><td class=\"text-center\" colspan=\"5\">沒有任何訂購紀錄。</td></tr>";
							}
							else{
								while($row = mysql_fetch_array($result)){
									$bid = $row['bid'];
									$oid = $row['oid'];
									$order_status = $row['status'];

									$sql = "SELECT * FROM `books` WHERE `bid`='$bid'";
									$result_row = mysql_query($sql);
									while($row_book = mysql_fetch_array($result_row)){
										$book_title=$row_book['title'];
										$book_author=$row_book['author'];
										$book_isbn=$row_book['isbn'];
										$book_price=$row_book['price'];
									}
									$total_price += $book_price;
									$count++;
									echo "
										<tr id=\"row$oid\">
											<td>$oid</td>
											<td>$book_title ($book_isbn)</td>
											<td>$book_author</td>
											<td class=\"text-right\">$book_price</td>
											<td>
												<div class=\"btn-group\" role=\"group\" aria-label=\"...\">
													<a onclick=\"order_status('ordered','$oid')\" id=\"status-ordered-$oid\" class=\"btn btn-xs "; if($order_status=="ordered"){echo ' active btn-primary';} else{echo " btn-info";} echo "\">訂單成立</a>
													<a onclick=\"order_status('arrived','$oid')\" id=\"status-arrived-$oid\" class=\"btn btn-xs "; if($order_status=="arrived"){echo ' active btn-primary';} else{echo " btn-info";} echo "\">等待領書</a>
													<a onclick=\"order_status('recieved','$oid')\" id=\"status-recieved-$oid\" class=\"btn btn-xs "; if($order_status=="recieved"){echo ' active btn-primary';} else{echo " btn-info";} echo "\">已領書</a>
												</div>
												<a class=\"btn btn-danger btn-xs\" onclick=\"book('delete','$bid','$sid')\" role=\"button\" id=\"delbtn$oid\">刪除訂單</a>
											</td>
										</tr>";
								}
							}
						}
					?>
				</tbody>
				<?php
					echo "
					<tfoot>
						<tr>
							<td colspan=\"5\">總數量：$count / 總金額：$total_price</td>
						</tr>
					</tfoot>"
				?>
			</table>
		</div>
	</div>
	<div class="row">
		<?php require('../../foot.php');?>
	</div>
</div>
</body>
</html>