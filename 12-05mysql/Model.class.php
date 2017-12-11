<?php
include '../helper.php';
/**
 * 模型类
 * Class Model
 * 自己完成e方法
 * 注释
 */
class Model
{
	private static $pdo = null ;
	public function __construct ($host = 'localhost',$dbname ='c89',$user = 'root',$password='root')
	{
		//连接数据库
		if(is_null (self::$pdo)){
			try{
				//连接数据库
				$dsn = "mysql:host={$host};dbname={$dbname}";
				self::$pdo = new PDO($dsn,$user,$password);
				//设置字符集
				self::$pdo-> query ('set names utf8');
				//设置错误属性（抛出异常）
				self::$pdo->setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			}catch (Exception $e){
				die($e->getMessage ());
			}
		}
	}
	//执行有结果集的查询
	//select
	public function q($sql){
		try{
			//执行sql语句
			$res = self::$pdo->query ($sql);
			//将结果集取出来
			return  $res->fetchAll (PDO::FETCH_ASSOC);
		}catch (Exception $e){
			die($e->getMessage ());
		}
	}

	//执行无结果集的sql
	//insert、update、delete
	public function e($sql){
		try{
			return self::$pdo->exec ($sql);
		}catch (Exception $e){
			//输出错误消息
			die($e->getMessage ());
		}
	}
}
//$res = (new Model())->q ('select * from student');
$res = (new Model())->e ("delete from student where sex='男'");
p($res);
