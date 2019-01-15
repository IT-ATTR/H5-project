<?php
    
	// 转码成功后的通知文件
    
	
	
	$info = "转码成功-";
	
	$date=date("Y-m-d H:i:s");
	
	$log = $info.$date;
	
	
	// 转码成功写入日志文件	
	file_put_contents("./log/notify.txt",$log."\r\n".PHP_EOL,FILE_APPEND); 



?>