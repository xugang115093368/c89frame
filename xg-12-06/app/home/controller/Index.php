<?php
//创建一个命名空间应用控制一个页面
namespace app\home\controller;
//加载库类满足两个条件use导入命名空间使用核心控制器
use houdunwang\core\Controller;
//导入使用huodunwang模型
use houdunwang\model\Model;
use system\model\Student;
//应用类索引扩展控制器
class Index extends Controller{
//声明一个公共的index的方法
    public function index(){
        /******测试模型中方法**********/
        //通过助手c函数连接数据库查询student的数据
        //  $res=Model::q("select * from student");
        //打印结果
        //p($res);
        //根据主键查找数据库单一一个数据
        //获取学生表中id(主键)=1数据通过Base.php里面的find函数
        //$data=Student::find(1);
        // $data=Student::getPriKey();
        //p($data);
        // $data=Student::field('age,sname')->find(1);
        //$data=Student::field('age,sname');
        //$data=Student::find(3);
        //p($data);
        //根据其余字段(不是主键)查找某一条数据
        //$data=Student::where ("name='好'")->first();
        //p($data);
        //获取数据表所有数据
        //$res= Student::getAll();
        //p($res);
        //查找年年龄>30的同学
        //$data=Student::where("age>30 or sex='男'")->getAll();
        //p($data);
        //查询指定列
        //$data = Student::where('age>30')->field("name,sex")->getAll();
        //p($data);
        //排序封装（注意这句话打开页面会报错，留给你的作业）
        $data = Student::where('age>20')->order('age desc')->getAll();
        p($data);
      //  nsert数据库写入
      //  $data=[
      //      'age'=>18,
      //      'name'=>'金色花',
      //      'sex'=>'男',
      //      'id'=>8,
      //  ];
      //  Student::insert($data);
      //  修改
      //  $data=[
      //      'age'=>28,
      //      'name'=>'王朝修改',
      //      'sex'=>'男',
      //  ];
      //  $res=Student::where('id=3')->update($data);
      //  p($res);
      //  删除
      //  p(Student::where('id=4')->delete());


    }
    //声明一个公共的的方法add的方法
    public function add(){
        View::make();


    }
}



