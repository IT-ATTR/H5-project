<?php
namespace Home\Controller;  
use Think\Controller;
header("content-type:text/html;charset=utf-8");
class AuthController extends Controller{
    function post_curl($url,$data,$agreement = 0){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        if($agreement == 0){//0 https   1   http
            unset($_REQUEST['agreement']);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        }
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    function get_curl($url,$agreement = 0){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        if($agreement == 0){//0 https   1   http
            unset($_REQUEST['agreement']);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        }
        if(defined('CURLOPT_IPRESOLVE') && defined('CURL_IPRESOLVE_V4')){
            curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        }
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
	/*文件写入*/
	function fwrite_txt($path,$txt){
		$myfile = fopen($path,"w") or die("Unable to open file!");
		fwrite($myfile,$txt);
		fclose($myfile);
	}
	/*文件读取*/
	function fread_txt($path){
		$txt = file_get_contents($path);
		return $txt;
	}
    function uploadMedia(){
        $access_token = $this->get_access_token();
        $url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token={$access_token}&type=voice";
        $file = realpath('1490687819845.amr'); //要上传的文件
        $fields['media'] = '@'.$file;
        $ch = curl_init($url) ;
        curl_setopt($ch, CURLOPT_POST, 1);
        if($agreement == 0){//0 https   1   http
            unset($_REQUEST['agreement']);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        }
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch) ;
        if (curl_errno($ch)) {
            exit(curl_errno($ch));
        }
        curl_close($ch);
        dump($result);
    }
    /**
     *  获取多媒体文件
     */
    public function getFile($media_id = "-f5LGrxrvwluevvR9kI4hWuuwG6hz6FhN4RJS6VmePBwJO67xx9wCBcDrPI3ACly"){
        $access_token = $this->get_access_token();
        $url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token={$access_token}&media_id={$media_id}";
        $fileInfo = $this->downloadWeixinFile($url);
        return $fileInfo;
    }
    /**
     *  获取并下载多媒体文件
     *  @param              $url                string          文件所在位置
     *  @return             string 
     */
    function downloadWeixinFile($url,$media_id = ""){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);    
        curl_setopt($ch, CURLOPT_NOBODY, 0);    //对body进行输出。
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $package = curl_exec($ch);
        $httpinfo = curl_getinfo($ch);
        $data = json_decode($package,true);
        if($data['errcode'] == '40001'){
            $this->fwrite_txt($_SERVER['DOCUMENT_ROOT'].'/jsd/tocket.txt','');
            $this->fwrite_txt($_SERVER['DOCUMENT_ROOT'].'/jsd/access_token.txt','');
            $this->get_ticket();
            return $this->getFile($media_id);
        }
        curl_close($ch);
        $media = array_merge(array('mediaBody' => $package), $httpinfo);
        preg_match('/\w\/(\w+)/i', $media["content_type"], $extmatches);
        $fileExt = $extmatches[1];
        $filename = time().rand(100,999).".{$fileExt}";
        $local_file = fopen($_SERVER['DOCUMENT_ROOT'].__ROOT__.'/Uploads/'.$filename,'w');
        if(local_file !== false){
            if(fwrite($local_file,$media['mediaBody']) !== false){
                fclose($local_file);
            }
        }
        return "http://".$_SERVER['SERVER_NAME'].__ROOT__."/Uploads/".$filename;
    }
}
?>