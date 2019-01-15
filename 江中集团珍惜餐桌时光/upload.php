
<?php

// header("Content-type:image/jpeg");

// $img_content=str_replace('data:image/jpeg;base64,','',$_POST['dataimg']);

// create_image('./upload_images/',$img_content);

// function create_image($path,$img_content){
//    $filename=$path.time().mt_rand(1,1000).".jpeg";
//    if(file_put_contents($filename,base64_decode($img_content))){
// 	   echo $filename;
//    }
//    else{
// 	   echo 'error';   
//    }
// }



$img_content=str_replace('data:image/jpeg;base64,','',$_POST['dataimg']);
create_image('./upload_images/',$img_content);

function create_image($path,$img_content){
	if (!is_dir($path)) {
		mkdir($path);
	}

   $filename = $path.date('YmdHis').mt_rand(1,1000).'.jpg';
   if(file_put_contents($filename,base64_decode($img_content))){

	   echo $filename;
   }
   else{
	   echo 'error';
   }
}


?>










