<?php

create_image('./user_images/',$_POST['dataimg']);


function create_image($path,$url){
	if (!is_dir($path)) {
		mkdir($path);
	}

   $filename = $_POST['filename'].'.jpeg';
   $img_file = file_get_contents($url);
   $img_content= base64_encode($img_file);
   if(file_put_contents($path.$filename,base64_decode($img_content))){

	   echo json_encode($filename);
   }else{
	   echo json_encode('error');
   }
}
?>