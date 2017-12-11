<?php

namespace houdunwang\model;

use Exception;
use PDO;

class Base
{
	private static $pdo = null;
	protected      $table;//操作数据表
	protected      $where;//sql语句where条件
	protected      $field = '';//指定查询的字段

	public function __construct ( $class )
	{
		//获取数据表名方式一：
		//$this->table = strtolower (ltrim (strrchr($class,'\\'),'\\'));
		//获取数据表名方式二：
		$info          = explode ( '\\' , $class );
		$this -> table = strtolower ( $info[ 2 ] );
		//p($this->table);
		//1.连接数据库
		if ( is_null ( self ::$pdo ) ) {
			$this -> connect ();
		}
	}

	/**
	 * 连接数据库
	 */
	private function connect ()
	{
		try {
			$dsn        = c ( 'database.driver' ) . ":host=" . c ( 'database.host' ) . ";dbname=" .
						  c ( 'database.dbname' );
			$user       = c ( 'database.user' );
			$password   = c ( 'database.password' );
			self ::$pdo = new PDO( $dsn , $user , $password );
			//字符集
			self::$pdo->query ('set names '.c('database.charset'));
			//设置错误属性
			self::$pdo->setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		} catch ( Exception $e ) {
			exit( $e -> getMessage () );
		}
	}

	/**
	 * 根据主键获取数据库单一一条数据
	 *
	 * @param $pk    主键值
	 *
	 * @return mixed
	 */
	public function find ( $pk )
	{
		//p($this->table);
		//获取查询数据表的主键
		$priKey = $this -> getPriKey ();
		$this->field  = $this->field ? : '*';
		//$sql = "select * from student where id=1";
		$sql = "select {$this->field} from {$this->table} where {$priKey}={$pk}";
		$res = $this -> q ( $sql );

		return current ( $res );
	}

	/**
	 * 查询单一一条数据
	 *
	 * @return mixed
	 */
	public function first ()
	{
		//$sql = "select * from student where sname='赵虎'";
		$this->field  = $this->field ? : '*';

		$sql  = "select {$this->field} from {$this->table} {$this->where}";
		$data = $this -> q ( $sql );

		//p($data);
		return current ( $data );
	}

	/**
	 * 查找指定列的字段
	 * @param $field	字段名称
	 *
	 * @return $this
	 */
	public function field ( $field )
	{
		//p ( $field );//sname,sex
		$this->field = $field;

		return $this;
	}

	/**
	 * sql语句中where条件
	 *
	 * @param $where
	 *
	 * @return $this
	 */
	public function where ( $where )
	{
		//p($where);//age>30
		//"where age>30"
		$this -> where = 'where ' . $where;

		return $this;
	}

	/**
	 * 获取数据表中所有数据
	 *
	 * @return mixed    所有数据数组
	 */
	public function getAll ()
	{
		//$this->field  = $this->field ? $this->field : '*';
		$this->field  = $this->field ? : '*';
		//$sql = "select * from student";
		$sql = "select {$this->field} from {$this -> table}  {$this->where}";

		//p($sql);die;
		return $this -> q ( $sql );
	}

	/**
	 * 获取数据表中主键的名称
	 *
	 * @return mixed    主键名称
	 */
	public function getPriKey ()
	{
		$sql = "desc {$this->table}";
		$res = $this -> q ( $sql );
		//p($res);//这里一定要打印看数据
		foreach ( $res as $k => $v ) {
			if ( $v[ 'Key' ] == 'PRI' ) {
				$priKey = $v[ 'Field' ];
				break;
			}
		}

		return $priKey;
	}

	/**
	 * 更新数据
	 * @param $data	要更新的数组数据
	 *
	 * @return bool
	 */
	public function update($data){
		//如果没有where条件不允许更新
		if(!$this->where){
			return false;
		}
		$set = '';
		foreach($data as $k=>$v){
			if(is_int ($v)){
				$set .= $k . '=' . $v . ',';
			}else{
				$set .= $k . '=' . "'$v'" . ',';
			}
		}
		$set = rtrim($set,',');
		//p($set);die;
		//sql = "update student set sname='',age=19,sex='男' where id=1";
		$sql = "update {$this->table} set {$set} {$this->where}";
		return $this->e ($sql);
	}

	public function delete(){
		//如果没有where条件不允许更新
		if(!$this->where){
			return false;
		}
		//$sql = "delete from student where id=1";
		$sql = "delete from {$this->table} {$this->where}";
		return $this->e ($sql);
	}

	/**
	 * 数据表写入数据
	 * @param $data
	 *
	 * @return mixed
	 */
	public function insert($data){
		//p($data);die;
		$field = '';
		$value = '';
		foreach($data as $k=>$v){
			$field .= $k . ',';
			if(is_int ($v)){
				$value .= $v . ',';
			}else{
				$value .= "'$v'" . ',';
			}
		}
		$field = rtrim ($field,',');
		//p($field);die;
		$value = rtrim ($value,',');
		//p($value);die;
		//$sql = "insert into student (age,sname,sex,cid) values (1,'超人','男',1)";
		$sql = "insert into {$this->table} ({$field}) values ({$value})";
		//p($sql);die;
		return $this->e ($sql);
	}

	//执行有结果集的查询
	//select
	public function q ( $sql )
	{
		try {
			//执行sql语句
			$res = self ::$pdo -> query ( $sql );

			//将结果集取出来
			return $res -> fetchAll ( PDO::FETCH_ASSOC );
		} catch ( Exception $e ) {
			die( $e -> getMessage () );
		}
	}

	//执行无结果集的sql
	//insert、update、delete
	public function e ( $sql )
	{
		try {
			return self ::$pdo -> exec ( $sql );
		} catch ( Exception $e ) {
			//输出错误消息
			die( $e -> getMessage () );
		}
	}
}