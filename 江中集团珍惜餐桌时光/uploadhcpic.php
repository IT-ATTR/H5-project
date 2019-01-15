
<?php
//header("Content-type:image/jpeg");

// $img_content=str_replace('data:image/jpeg;base64,','',$_POST['dataimg']);
$img_content=str_replace('data:image/png;base64,','',$_POST['dataimg']);
//echo $img_content;
create_image('./img_hc/',$img_content);

function create_image($path,$img_content){
	if (!is_dir($path)) {
		mkdir($path,0777,true);
	}
   // $filename=$path.time().mt_rand(1,1000).".jpeg";
   // $filename=$path.time().mt_rand(1,1000).".png";
   $filename=$path.date('YmdHis').rand(1000,9999).".png";
   if(file_put_contents($filename,base64_decode($img_content))){
	   echo $filename;
   }
   else{
	   echo 'error';
   }
}
?>





