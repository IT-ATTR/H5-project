<?php
	$file = $_POST;
	$path = "./upload/";
	if (!is_dir($path)) {
		# code...
		mkdir($path,0777,true);
	}

	$filename = date("YmdHis",time()).mt_rand(100,999).".png";

	if (file_put_contents($path.$filename,base64_decode($file['base64']))) {
		//进行签名的入库,先提示成功，再进行入库，增加程序运行效率

		$pdo = new PDO("mysql:host=localhost;dbname=mrgcgz;port=3306;charset=utf8",'mrgcgz',"mrgcgz1234");

		// $sql2 = "select count(*) as num from active_h5_kjqm20190107 where 1";
		// $stmt2 = $pdo->prepare($sql2);

		// $stmt2->execute();

		// $shuliang = $stmt2->fetch(PDO::FETCH_ASSOC);
		// //先进行数据展示，防止时间过长
		if ($shuliang) {
			# code...
			$shuliang = mt_rand($shuliang,5000);
		}else{
			$shuliang = mt_rand(4000,5000);
		}


		echo json_encode($shuliang);

		//如果图片存在删除文件后再入库
		$sql = "select * from active_h5_kjqm20190107 where openid='{$file['openid']}' limit 1";

		$stmt = $pdo->prepare($sql);

		$stmt->execute();

		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		if (intval($user['sign_time'])<3) {
			# 进行抽奖次数的增加
			$signNum = intval($user['sign_time'])+1;
			$prizeTime = intval($user['prizetime'])+1;
			$sql1 = "update active_h5_kjqm20190107 set sign_time='{$signNum}',prizetime='{$prizeTime}' where openid='{$file['openid']}'";

			$pdo->exec($sql1);
		}

		//进行新数据入库
		$sql1 = "update active_h5_kjqm20190107 set signature='{$filename}' where openid='{$file['openid']}'";

		$pdo->exec($sql1);


	}
 ?>