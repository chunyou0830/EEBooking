<!DOCTYPE html>
<html>
<head>
	<title>領書｜清大電機線上訂書系統</title>
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
			<h3>可領書清單</h3>
			<table class="table table-hover table-bordered">
				<col width="5%">
				<col width="25%">
				<col width="10%">
				<col width="30%">
				<col width="15%">
				<col width="15%">
				<thead>
					<tr>
						<th>#</th>
						<th>書名 (ISBN)</th>
						<th>價格</th>
						<th>領書時間</th>
						<th>領書地點</th>
						<th>發書負責人</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$sql = "SELECT * FROM order_10402 WHERE sid='$sid'";
						$result = mysql_query($sql);
						$count = 1;
						$sum = 0;
						$none_flag = 1;

						if(mysql_num_rows($result)!=0){
							while($row = mysql_fetch_array($result)){
								$oid = $row['oid'];
								$bid = $row['bid'];
								$sql = "SELECT * FROM `books` WHERE `bid`='$bid' AND `recieve_available`='1'";
								$book_result = mysql_query($sql);
								if(mysql_num_rows($book_result)!=0){
									$none_flag = 0;
								}
								while($book_row = mysql_fetch_array($book_result)){
									$title = $book_row['title'];
									$isbn = $book_row['isbn'];
									$price = $book_row['price'];
									$rcv_start = $book_row['recieve_start'];
									$rcv_end = $book_row['recieve_end'];
									$rcv_place = $book_row['recieve_place'];
									$rcv_charge = $book_row['recieve_charge'];
									$sum += $price;
									echo "<tr id=\"row$bid\"><td>$count</td><td>$title ($isbn)</td><td class=\"text-right\">$price</td><td>$rcv_start ~ $rcv_end</td><td>$rcv_place</td><td>$rcv_charge</td></tr>";
								}
								$count++;
							}
						}

						if($none_flag){
							echo "<tr><td class=\"text-center\" colspan=\"6\">沒有任何書籍可供領取。</td></tr>";
						}
					?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="5" class="text-right">應付書費</th>
						<th colspan="1" class="text-right"><?php echo $sum;?></th>
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