<?php
    /** *********************
     * 用户评论信息的入库
     *
     * @author:江亮 (jiangliangscau@163.com)
     * @time：2018-05-20
     * @modify 2018-06-07
     * @param string 参数  [参数介绍1]
     * @param string 参数  [参数介绍2]
     * @return json
     ***********************************************/
   $pdo = new PDO('mysql:host=localhost;port=3306;charset=utf8;dbname=mrgcgz',"mrgcgz","mrgcgz1234");

   $data = $_GET;

   $tablename  = "active_h5_".$data['tablename'];
   $openid     = $data['openid'];
   $nickname   = $data['nickname'];
   $headimgurl = $data['headimgurl'];
   $comment    = $data['comment'];
   $addtime    = time();

   $sql = "insert into {$tablename} values(null,'{$openid}','{$nickname}','{$headimgurl}','{$comment}',{$addtime},'0')";
   // var_dump($pdo->prepare($sql));
   if ($pdo->exec($sql)) {
     	echo json_encode("1");
   }else{
   	    echo json_encode("0");
   }


 ?>