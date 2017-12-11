<?php
//houdunwang\model命名空间和目录结构一样，才能让composer.jion自动记载
namespace houdunwang\model;
//导入Exception空间
use Exception;
//从Exception导入PDO
use PDO;
//创建一个Base的类
class Base
{
    //创建公共方法$pdo保存他的初始值
    private static $pdo = null;
    //定义私有属性$table执行操作数据表
    protected  $table;
    //定义sql语句wherede属性
    protected  $where;
    //定义field指定查询的字段
    protected  $field='';
    // protected  $first;
    //构造方法传参来自student页面传过来的数据
    public function __construct ($class)
    {
        //explode把字符串转成数组获取方法表名打印结果
        $info=explode('\\',$class);//system\model\Student
        //p($info);
        //strtolower把字符串转成小写
        $this->table=strtolower($info[2]);
        //p($this->table);//student
        //1.连接数据库判断$pdo是否为空是空着执行if里面的语句，不是空着跳过if语句
        if ( is_null ( self ::$pdo ) ) {
            $this -> connect ();
        }
    }

    //连接数据库
    private function connect ()
    {
        //连接数据库到houdunwang的view,Base文件处理稳健后缀名的问题
        try {
            $dsn        = c('database.driver').":host=".c('database.host').";dbname=".c('database.dbname');
            $user       = c('database.user');
            $password   = c('database.password');
            self ::$pdo = new PDO( $dsn , $user , $password );
            //设置字符集用函数添加配置项里面可以进行修改
            self::$pdo->query ('set names '.c('database.charset'));
            //从system的配置项那边返回设置错误属性
            self::$pdo->setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch ( Exception $e ) {
            //处理参数后终止程序
            exit( $e -> getMessage () );
        }
    }

    //根据主键获取数据库单一一条数据
    //$pk主键值 find的属性
    public function find($pk){
        //p($pk);
        //获取查询数据表的主键
        $priKey = $this -> getPriKey();
        //p($priKey);
        // 判断字段等于号是后面赋值给前面
//      $this->field = $this->field ? : '*';
        $this->field = $this->field ? $this->field: '*';
        // p($this->field);
        //组合查询字段
        //$sql="select * from student where id=1";
        //组合查询语句
        $sql="select {$this->field} from {$this->table} where {$priKey}={$pk}";
        // p($sql);//select * from studentwhereid=3
        //把组合好的sql语句写入数据库
        $res=$this->q ($sql);
        //p($res);
        //通过函数return返回结果
         return current($res);
    }

    // @param $field	封装字段名称属性
    public function field ( $field )
    {
       //p ( $field );//sname,sex打印结果
       // $this调用本页面的
        $this->field = $field;
        //p($this->field);
        //返回app目录index的页面
        return $this;
    }

    //获取数据表中主键的公有方法
    // @return mixed    主键名称
    //getPriKey属性
    public function getPriKey ()
    {
        //查看表结构
        $sql = "desc {$this->table}";
        //p($sql);//desc student
        //向数据库中写入sql的语句
        $res = $this -> q ( $sql );
        //p($res);//这里一定要打印看数据
        //用foreach来变遍历内容
        foreach ( $res as $k => $v ) {
            //用语句if把键值对应的值赋给$priKey
            if ( $v[ 'Key' ] == 'PRI' ) {
                $priKey = $v[ 'Field' ];
                //p($priKey);
                //当找到键值的时候结束遍历
                break;
            }
        }

        return $priKey;
    }

    //sql语句中where的方法条件查询
    public function where($where){
        //p($where);//name='好'打印结果
        //组合的查询的语句
        $this->where='where '.$where;
        //p($this->where);
        //返回对象，进行链式操作,跳到app目录index页面
        return $this;

    }

    //查询单一一条数据
    //first
    public function first(){
        // p($this->field);die;
        //$ql= "select * from student where sname ='赵虎'";
        //判断字段里面有值还是空值
        $this->field=$this->field ?:'*';
        //p($this->field);
        //连接sql语句
        $sql="select {$this->field} from {$this->table} {$this->where}";
        //p($sql);die;
        //把语句写入数据库
        $data = $this-> q ($sql);
        //p($data);
        //返回结果
        return current($data);
    }

    //@return mixed    所有数据数组
    //getAll的方法
    public function getAll()
    {
        //$this->field  = $this->field ? $this->field : '*';
        //判断属性field是否有已经有值了
        $this->field  = $this->field ? : '*';
        //p($this->field);
        //$sql = "select * from student";
        //组合语句像数据库中写入语句
        $sql = "select {$this->field} from {$this -> table}  {$this->where}";
        //p($sql);die;
        //像数据库写入数据并返回结果
        return $this -> q ( $sql );
    }
    //排序封装
    //order创建公共方法
    public function order ( $order )
    {

        //p ($this->order);die;
       //p ( $order );//sname,sex
        // $this调用本页面的
        $this->order = $order;
        //p($this->order);
        //返回对象，链式操作,从app index那里执行最后的getAll
        return $this;
    }
    //写入数据库的方法insert
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
        //组合语句
        $sql = "insert into {$this->table} ({$field}) values ({$value})";
        //p($sql);die;
        //将连接起来的语句写进数据库里面，并返回到app目录的index页面
        return $this->e ($sql);

    }
    //修改数据 update
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
    //删除delete
    public function delete(){
        //没有where条件，是查不出结果的，所以没有这个条件就会返回null
        if(!$this->where){
            return false;
        }
        //$sql = "delete from student where id=1";
        $sql = "delete from {$this->table} {$this->where}";
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