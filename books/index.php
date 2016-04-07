<!DOCTYPE html>
<html>
<head>
	<title>書本｜清大電機線上訂書系統</title>
	<?php require('../meta.php');?>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" type="text/css" href="../css/custom.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="../js/filter.js"></script>
	<script src="../js/book.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
	<div class="row">
		<?php require('../nav.php');?>
	</div>
	<div class="row">
		<div class="col-lg-3 col-xs-12 form-inline col-md-offset-9 col-xs-offset-0">
		<div class="form-group pull-right">
			<label for="filter">搜尋：</label>
			<input type="text" class="form-control" id="filter" placeholder="書名 / 作者 / ISBN / 課程...">
		</div>
		</div>
	</div>
	<hr>

	<div class="row" id="books">
		<?php
			$sql = "SELECT * FROM books";
			$result = mysql_query($sql);
			$ordered_books[] = 0;

			$sql = "SELECT * FROM `order_10402` WHERE sid='$sid'";
			$order_result = mysql_query($sql);
			while($order_row = mysql_fetch_array($order_result)){
				$ordered_books[] = $order_row['bid'];
			}

			if(mysql_num_rows($result)==0){
				echo "<p class=\"text-center\">沒有任何書籍可供訂購。</p>";
			}
			else{
				while($row = mysql_fetch_array($result)){
					$bid = $row['bid'];
					$title = $row['title'];
					$author = $row['author'];
					$isbn = $row['isbn'];
					$price = $row['price'];
					echo "
	<div class=\"col-xs-6 col-sm-6 col-lg-3\">
		<div class=\"thumbnail book\"><img src=\"http://static.findbook.tw/image/book/$isbn/large\" alt=\"$title\" class=\"img-thumbnail\">
		  <div class=\"caption\">
			<h4 class=\"pull-right text-primary\">\$$price</h4>
			<h4>$title</h4>
			<ul>
				<li>作者: $author</li>
				<li>ISBN: $isbn</li>
				<li>相關課程:
					<ul>";
					$sql_getclasses = "SELECT * FROM `classes` WHERE `book`='$isbn'";
					$result_getclasses = mysql_query($sql_getclasses);

					if(mysql_num_rows($result_getclasses)==0){
						echo "<li>沒有任何相關課程。</li>";
					}
					else{
						while($row_getclasses = mysql_fetch_array($result_getclasses)){
							$teacher_class = $row_getclasses['teacher'];
							$title_class = $row_getclasses['title'];
							echo "<li>$title_class ( $teacher_class )</li>";
						}
					}
					echo "</ul>
				</li>
			</ul>";
			if($config['order']){
				echo "<p class=\"text-right\"><button href=\"#\" class=\"btn btn-primary\" onclick=\"book('order','$bid','$sid')\" id=\"btn$bid\"";
				if(in_array($bid, $ordered_books)){
					echo "disabled=\"disabled\">已訂購";
				}
				else{
					echo ">訂購本書";
				}
				echo "</button></p>";
			}

		  echo "</div>
		</div>
	  </div>";
				}
			}
		?>
	</div>
	<div class="row">
		<?php require('../foot.php');?>
	</div>
</div>
</body>
</html>