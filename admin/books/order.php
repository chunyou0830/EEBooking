<!DOCTYPE html>
<html>
<head>
	<title>書籍設定｜清大電機線上訂書系統</title>
	<?php require('../../meta.php');?>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="../../css/custom.css">

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
				  	<?php
				  		$bid = $_GET['bid'];
					    $sql = "SELECT * FROM `books` where `bid`='$bid'";
					    $result = mysql_query($sql);
						while($row = mysql_fetch_array($result)){
							$bid = $row['bid'];
							$title = $row['title'];
							$author = $row['author'];
							$price = $row['price'];
							$isbn = $row['isbn'];
						}
				    ?>

			<h3>書籍訂單：<?php echo $title." (".$isbn.")";?></h3>
			<table class="table table-hover table-bordered">
				<col width="10%">
				<col width="15%">
				<col width="40%">
				<col width="10%">
				<col width="30%" class="printDisable">
				<thead>
				    <tr>
					  	<th>訂單編號</th>
					  	<th>訂購人 (學號)</th>
					  	<th>領書簽名</th>
					  	<th>總價</th>
					  	<th class="printDisable">操作</th>
				    </tr>
			  	</thead>
			  	<tbody>
				  	<?php
					    $sql = "SELECT * FROM `order_10402` WHERE `bid`='$bid'";
					    $result = mysql_query($sql);
					    $count = 0;

						if(mysql_num_rows($result)==0){
						    echo "<tr><td class=\"text-center\" colspan=\"5\">沒有任何訂購紀錄。</td></tr>";
						}
						else{
						    while($row = mysql_fetch_array($result)){
						    	$bid = $row['bid'];
						    	$oid = $row['oid'];
						    	$order_sid = $row['sid'];
						    	$order_status = $row['status'];

							    $sql = "SELECT `name` FROM `users` WHERE `sid`='$order_sid'";
							    $result_row = mysql_query($sql);
							    while($row_name = mysql_fetch_array($result_row)){$name_row=$row_name['name'];}
							    echo "
							    	<tr id=\"row$oid\">
							    		<td>$oid</td>
							    		<td>$name_row ($order_sid)</td>
							    		<td></td>
							    		<td class=\"text-right\">$price</td>
							    		<td class=\"printDisable\">
							    			<div class=\"btn-group\" role=\"group\" aria-label=\"...\">
												<a onclick=\"order_status('ordered','$oid')\" id=\"status-ordered-$oid\" class=\"btn btn-xs "; if($order_status=="ordered"){echo ' active btn-primary';} else{echo " btn-info";} echo "\">訂單成立</a>
												<a onclick=\"order_status('arrived','$oid')\" id=\"status-arrived-$oid\" class=\"btn btn-xs "; if($order_status=="arrived"){echo ' active btn-primary';} else{echo " btn-info";} echo "\">等待領書</a>
												<a onclick=\"order_status('recieved','$oid')\" id=\"status-recieved-$oid\" class=\"btn btn-xs "; if($order_status=="recieved"){echo ' active btn-primary';} else{echo " btn-info";} echo "\">已領書</a>
											</div>
											<a class=\"btn btn-danger btn-xs\" onclick=\"book('delete','$bid','$order_sid')\" role=\"button\" id=\"delbtn$oid\">刪除訂單</a>
										</td>
									</tr>";
							    $count++;
						    }
						}
				    ?>
			  	</tbody>
			  	<?php
			  		echo "
			  		<tfoot>
			  			<tr>
			  				<td colspan=\"5\">總數量：$count / 總金額：".$count*$price."</td>
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