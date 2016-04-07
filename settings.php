<?php
    $sql_result = mysql_query("SELECT * FROM `setting` WHERE `name`='system'");
    while($row = mysql_fetch_array($sql_result)){
        if($row['value']=='true'){$config['system'] = true;}
        else{$config['system'] = false;}
    }

    $sql_result = mysql_query("SELECT * FROM `setting` WHERE `name`='order'");
    while($row = mysql_fetch_array($sql_result)){
        if($row['value']=='true'){$config['order'] = true;}
        else{$config['order'] = false;}
    }

    $uid = $_SESSION['uid'];
    $result = mysql_query("SELECT * FROM `users` WHERE `uid`='$uid'");
    while($row = mysql_fetch_array($result)){
        $name = $row['name'];
        $sid = $row['sid'];
        $email = $row['email'];
        $fb_id = $row['fb_id'];
        $fb_token = $row['fb_token'];
        $uid = $row['uid'];
        $auth = $row['auth'];
    }