<?php
	$file = $_GET;


	$tablename = "active_h5_".$file['projectName'];

	//先判断有没有传
	$mysql = new PDO("mysql:host=localhost;dbname=mrgcgz;charset=utf8","mrgcgz","mrgcgz1234");


	$sel = "select * from {$tablename} where openid='{$file['openid']}' limit 1";


	$stmt = $mysql->query($sel);


	$user = $stmt->fetchAll();

	if ($user[0]['cover']) {

		echo "已经上传了";
		die();
	}

	//进行图片的上传
	$imgpath = file_get_contents($file['headimgurl']);

	$path = "./upload/";


	if (!is_dir($path)) {
		# code...
		mkdir($path,0777,true);
	}

	$filename = date("YmdHis",time()).mt_rand(100,999).".jpg";

	if (file_put_contents($path.$filename, $imgpath)) {

		# 图像上传成功，进行图片的入库

		$sql = "update {$tablename} set cover='{$filename}' where openid='{$file['openid']}'";

		if($mysql->exec($sql)){
			echo json_encode("success");
		}
	}




?>