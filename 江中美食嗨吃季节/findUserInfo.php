<?php 
	$pdo = new PDO('mysql:host=localhost;port=3306;charset=utf8;dbname=mrgcgz',"mrgcgz","mrgcgz1234");

   $openid = $_GET['openid'];

   $sql = "select * from active_h5_jzyy20180823 where openid='{$openid}' limit 1";
   $stmt = $pdo->query($sql);
   $userinfo = $stmt ->fetch(PDO::FETCH_ASSOC);

   // var_dump(  $userinfo  );die;

   	# code...
      echo json_encode( $userinfo );




 ?>