<!DOCTYPE html>
<html>
<head>
	<title>課程設定｜清大電機線上訂書系統</title>
	<?php require('../../meta.php');?>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script>
		function conf_del(cnum){
			if(confirm("確認刪除？"))
				window.location.assign("classop.php?action=delete&cnum="+cnum);
		}
	</script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
	<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
	<script src="../../js/class_book.js"></script>
	<script src="../../js/register.js"></script>
</head>
<body>
<div class="container">
	<div class="row">
		<?php require('../../nav.php');?>
	</div>
	<div class="row container">
		<div class="col-lg-12 container">
			<h3>課程資料</h3>
			<div class="well">
            <?php if(isset($_GET["status"]) && $_GET["status"] == 'updated'){?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                資料已更新。
            </div>
            <?php }?>
				  	<?php
						if($_GET['action']=="add"){
				  			$cid = "";
							$title = "";
							$teacher = "";
							$cnum = "";
							$book = "";
						}
						else if($_GET['action']=="update"){
				  			$cnum = $_GET['cnum'];
						    $sql = "SELECT * FROM `classes` WHERE `cnum`='$cnum'";
						    $result = mysql_query($sql);
						    $count = 1;
							while($row = mysql_fetch_array($result)){
								$title = $row['title'];
								$teacher = $row['teacher'];
								$cid = $row['cid'];
								$book = $row['book'];
							}
						}
				    ?>
			    <form method="POST" action="classop.php?action=<?php echo $_GET['action'];?>">
				  <input type="hidden" id="cid" name="cid" value="<?php echo $cid; ?>" required>
				  <div class="form-group">
				    <label for="title">課名</label>
				    <input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>" required>
				  </div>
				  <div class="form-group">
				    <label for="teacher">授課教師</label>
				    <input type="text" class="form-control" id="teacher" name="teacher" value="<?php echo $teacher; ?>" required>
				  </div>
				  <div class="form-group">
				    <label for="cnum">課號</label>
				    <input type="text" class="form-control" id="cnum" name="cnum" value="<?php echo $cnum; ?>" required <?php if($_GET['action']=="update") echo "disabled";?>>
				    <?php if($_GET['action']=="update") echo "<input type=\"hidden\" class=\"form-control\" id=\"cnum\" name=\"cnum\" value=\"$cnum\" required>";?>
				  </div>
				  <?php if($_GET['action']=="update"){ ?>
				  <div class="form-group">
				    <label for="recieve_date">關聯用書</label>
				    <table class="table table-hover table-bordered">
						<col width="7%">
						<col width="48%">
						<col width="20%">
						<col width="20%">
						<col width="5%">
						<thead>
						    <tr>
							  	<th>書號</th>
							  	<th>書名</th>
							  	<th>作者</th>
							  	<th>ISBN</th>
							  	<th>操作</th>
						    </tr>
					  	</thead>
					  	<tbody>
						  	<?php
							    $sql2 = "SELECT `book` FROM `classes` WHERE `cnum`='$cnum";
							    $result2 = mysql_query($sql);
							    $count = 1;
								while($row2 = mysql_fetch_array($result2)){
									$isbn = $row2['book'];
									$result3 = mysql_query("SELECT * FROM `books` WHERE `isbn`='$isbn'");
									while($row_book = mysql_fetch_array($result3)){
										$bid = $row_book['bid'];
										$book_title = $row_book['title'];
										$author = $row_book['author'];
										echo "<tr id=\"row$cid\"><td>$bid</td><td>$book_title</td><td>$author</td><td>$isbn</td><td><a class=\"btn btn-danger btn-xs\" href=\"#\" onclick=\"class_book('delete_book','$cnum','$isbn');\" role=\"button\" id=\"detbtn$cid\">刪除用書</a></td></tr>";
										$count++;
									}
								}
						    ?>
						    <tr>
						    	<td>新增</td>
						    	<td colspan="3">
						    		<!--<input type="isbn_input" class="form-control input-sm" id="book" name="book" placeholder="書籍 ISBN">-->
						    		<select class="isbn-dropdown form-control" name="book" id="book"></select>
						    		<script>
										$('select').select2();
										$(".isbn-dropdown").select2({
											data: [
											<?php
											$book_query = mysql_query("SELECT * FROM `books`");
											while($book_list = mysql_fetch_array($book_query)){
												$title = $book_list['title'];
												$isbn = $book_list['isbn'];
												echo "{ id: '$isbn', text: '$title ($isbn)' },";
											}
											?>
										   ]
										})
									</script>
						    	</td>
						    	<td><a class="btn btn-primary btn-xs" href="#" onclick="<?php echo "class_book('add_book', '$cnum', '')"?>" role="button" id="addbook">增加用書</a></td>
						    </tr>
					  	</tbody>
					</table>
				  </div>
				  <?php }?>
				  <p><a href="index.php" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> 返回清單</a><span class="pull-right"><?php if($_GET['action']!="add"){?><a type="submit" class="btn btn-danger" id="submit" onclick="conf_del('<?php echo $cnum ?>');">刪除</a><?php } ?> <button type="submit" class="btn btn-primary" id="submit">儲存</button></span></p>
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