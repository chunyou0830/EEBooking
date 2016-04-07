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
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
	<div class="row">
		<?php require('../../nav.php');?>
	</div>
	<div class="row container">
		<div class="col-lg-12 container">

			<h3>書籍設定			<a class="btn btn-primary pull-right btn-sm" href="edit.php?action=add">新增書籍</a></h3>
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
				<col width="10%">
				<col width="15%">
				<thead>
				    <tr>
					  	<th>書號</th>
					  	<th>書名</th>
					  	<th>作者</th>
					  	<th>價格</th>
					  	<th>操作</th>
				    </tr>
			  	</thead>
			  	<tbody>
				  	<?php
					    $sql = "SELECT * FROM books";
					    $result = mysql_query($sql);
					    $count = 1;

						if(mysql_num_rows($result)==0){
						    echo "<tr><td class=\"text-center\" colspan=\"5\">沒有任何書籍。</td></tr>";
						}
						else{
						    while($row = mysql_fetch_array($result)){
						    	$bid = $row['bid'];
						    	$title = $row['title'];
						    	$author = $row['author'];
						    	$price = $row['price'];
						    	$isbn = $row['isbn'];
							    echo "<tr id=\"row$bid\"><td>$bid</td><td>$title</td><td>$author</td><td class=\"text-right\">$price</td><td><a class=\"btn btn-default btn-xs\" href=\"edit.php?action=update&bid=$bid\" role=\"button\" id=\"detbtn$bid\">詳細資料</a> <a class=\"btn btn-default btn-xs\" href=\"order.php?bid=$bid\" role=\"button\" id=\"detbtn$bid\">查看訂單</a></td></tr>";
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