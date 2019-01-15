<?php
/* 
 * Edition:	ET080708
 * Desc:	Core Engine 3 (Memcache/Compile/Replace)
 * File:	template.core.php
 * Author:	David Meng
 * Site:	http://www.systn.com
 * Email:	mdchinese@gmail.com
 * 
 */
error_reporting(0);

define("ET3!",TRUE);
class ETCore{
	var $ThisFile	= '';				//当前文件
	var $IncFile	= '';				//引入文件
	var $ThisValue	= array();			//当前数值
	var $FileList	= array();			//载入文件列表
	var $IncList	= array();			//引入文件列表
	var $ImgDir		= array('images');	//图片地址目录
	var $HtmDir		= 'cache_htm/';		//静态存放的目录
	var $HtmID		= '';				//静态文件ID
	var $HtmTime	= '180';			//秒为单位，默认三分钟
	var $AutoImage	= 1;				//自动解析图片目录开关默认值
	var $Hacker		= "<?php if(!defined('ET3!')){die('You are Hacker!<br>Power by Ease Template!');}";
	var $Compile	= array();
	var $Analysis	= array();
	var $Emc		= array();

	/**
	*	声明模板用法
	*/
	function ETCoreStart(
		$set = array(
				'ID'		 =>'1',					//缓存ID
				'TplType'	 =>'htm',				//模板格式
				'CacheDir'	 =>'cache',				//缓存目录
				'TemplateDir'=>'template' ,			//模板存放目录
				'AutoImage'	 =>'on' ,				//自动解析图片目录开关 on表示开放 off表示关闭
				'LangDir'	 =>'language' ,			//语言文件存放的目录
				'Language'	 =>'default' ,			//语言的默认文件
				'Copyright'	 =>'off' ,				//版权保护
				'MemCache'	 =>'' ,					//Memcache服务器地址例如:127.0.0.1:11211
			)
		){

		$this->TplID		= (defined('TemplateID')?TemplateID:( ((int)@$set['ID']<=1)?1:(int)$set['ID']) ).'_';

		$this->CacheDir   	= (defined('NewCache')?NewCache:( (trim($set['CacheDir']) != '')?$set['CacheDir']:'cache') ).'/';

		$this->TemplateDir	= (defined('NewTemplate')?NewTemplate:( (trim($set['TemplateDir']) != '')?$set['TemplateDir']:'template') ).'/';

		$this->Ext			= (@$set['TplType'] != '')?$set['TplType']:'htm';

		$this->AutoImage	= (@$set['AutoImage']=='off')?0:1;
		
		$this->Copyright	= (@$set['Copyright']=='off')?0:1;
		
		$this->Server		= (is_array($GLOBALS['_SERVER']))?$GLOBALS['_SERVER']:$_SERVER;
		$this->version		= (trim($_GET['EaseTemplateVer']))?die('Ease Templae E3!'):'';
		
		//载入语言文件
		$this->LangDir		= (defined('LangDir')?LangDir:( ((@$set['LangDir']!='language' && @$set['LangDir'])?$set['LangDir']:'language') )).'/';
		if(is_dir($this->LangDir)){
			$this->Language	= (defined('Language')?Language:( (($set['Language']!='default' && $set['Language'])?$set['Language']:'default') ));
			if(@is_file($this->LangDir.$this->Language.'.php')){
				$lang = array();
				@include_once $this->LangDir.$this->Language.'.php';
				$this->LangData = $lang;
			}
		}el