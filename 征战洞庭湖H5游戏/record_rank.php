<?php
require_once "../jssdk1.php";

$sql=mysql_query("select * from active_ztlls20170928_users where game_type='1' order by score desc,addtime desc limit 20");
$rank=0;
$datetime=time();


while($info=mysql_fetch_array($sql)){
  $rank++;
  $sql_1=mysql_query("insert into active_ztlls20170928_lottery (openid,nickname,headimgurl,rank,datetime) values ('$info[openid]','$info[nickname]','$info[headimgurl]','$rank','$datetime')");	
  
}


?>



