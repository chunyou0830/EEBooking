<!DOCTYPE html>
<html>
<head>
	<title>意見與回報｜清大電機線上訂書系統</title>
	<?php require('meta.php');?>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
	<div class="row">
		<?php require('nav.php');?>
	</div>
	<div class="row container">
		<div class="col-lg-12 container">
			<h3>意見與回報</h3>
			<div class="well">
            <?php if(isset($_GET["status"]) && $_GET["status"] == 'updated'){?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                已送出！
            </div>
            <?php }?>
			<p class="text-muted">本表單僅限填寫系統操作與使用問題。若訂書方面有任何疑問，請直接向班代洽詢。</p>
            <iframe name="hidden_iframe_vhwrngab" id="hidden_iframe_vhwrngab" style="display:none;" onload="if(submitted_vhwrngab){window.location='report.php?status=updated';}"></iframe>
            <form action="https://docs.google.com/forms/d/1z_Smuqkl43NBniygn6nbJjyZVFgH-PC3Ra6CAlIW9YA/formResponse" method="POST" id="ss-form" target="hidden_iframe_vhwrngab" onsubmit="submitted_vhwrngab=true;">
				
				<div class="form-group">
				<input type="hidden" name="entry.2104563966" value="<?php echo $name;?>" class="form-control" id="entry_2104563966" dir="auto" aria-label="Name  " title="">
				</div>
				<div class="form-group">
				<input type="hidden" name="entry.1215946703" value="<?php echo $sid;?>" class="form-control" id="entry_1215946703" dir="auto" aria-label="ID  " title="">
				</div>
				<div class="form-group">
				<input type="hidden" name="entry.344176525" value="<?php echo $email;?>" class="form-control" id="entry_344176525" dir="auto" aria-label="Email  " title="">
				</div>
				<div class="form-group">
				<textarea name="entry.322052050" rows="8" cols="0" class="form-control" id="entry_322052050" dir="auto" aria-label="Content  "></textarea>
				</div>
				<input type="hidden" name="draftResponse" value="[,,&quot;3820870421677502685&quot;]">
				<input type="hidden" name="pageHistory" value="0">
				<input type="hidden" name="fvv" value="0">

				<input type="hidden" name="fbzx" value="3820870421677502685">

				<p class="text-right"><input type="submit" name="submit" value="提交" id="ss-submit" class="btn btn-primary"></p>
			</form>
			</div>
		</div>
	</div>
	<div class="row">
		<?php require('foot.php');?>
	</div>
</div>
</body>
</html>