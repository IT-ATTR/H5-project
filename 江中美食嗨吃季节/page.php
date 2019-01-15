<?php 
 /** ******************************************************************************
  * 江中H5分页功能的类
  *
  * @author:江亮 (jiangliangscau@163.com)
  * @time：2018-05-20
  * @modify 2018-06-07
  * @param string 查哪一张表，有九张表的评论
  * @param string 查哪一页，一页十个评论是定死的
  * @return json
  *****************************************************	**************************/
final class page{
	private $pdo;
	//每次查询的数据
	private $prepage;
	public function __construct(){
		$this->prepage=10;
		$this->pdo = new PDO('mysql:host=localhost;port=3306;charset=utf8;dbname=mrgcgz',"mrgcgz","mrgcgz1234");
	}

	public function getPageData($tablename,$nowpage){
		//查几条数据
		$num = $this->prepage;
		//获取当前页码
		$x = ($nowpage-1)*$num;
		//获取总得

		$sql1 = "select count(*) as num from {$tablename} where 1";
		$stmt1 = $this->pdo->query($sql1);
		$toalnum = $stmt1 ->fetch(PDO::FETCH_ASSOC);
		$total = $toalnum['num'];
		//总页数
		$pagetotal =intval(ceil($total/10));
		if ($nowpage>$pagetotal) {
			die();
		}

		//使用pdo预处理查询用户评论,并且通过审核的评论才可以展示
		//添加审核功能的代码使用的是JzController.class.php
        // $sql = "select * from {$tablename} where auth='1' order by addtime desc limit {$x},{$num}";
        $sql = "select * from {$tablename} where 1 order by addtime desc limit {$x},{$num}";

		$stmt = $this->pdo->query($sql);
		// var_dump($this->pdo->prepare($sql));
		// var_dump($stmt);
		echo json_encode( $stmt->fetchAll() );
	}
}

$obj = new page;
//拼接数据库的表名
$tablename = "active_h5_".$_GET['tablename'];
// echo $tablename;
$nowpage = empty($_GET['page'])?1:$_GET['page'];
$obj->getPageData($tablename,$nowpage);

 ?>
