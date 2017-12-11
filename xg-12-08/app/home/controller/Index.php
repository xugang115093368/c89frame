<?php

namespace app\home\controller;

use houdunwang\core\Controller;
use system\model\Student;

class Index extends Controller {
	public function index(){
		/********测试模型中方法***********/
		//$res =Model::q('select * from student');
		//p($res);
		//根据主键查找数据库单一一个数据
			//获取学生表中id(主键)=1数据
			//$data = Student::find(1);
			//p($data);
			//$data = Student::field('age,sname')->find(1);
			//p($data);

			//根据其余字段(不是主键)查找某一条数据
			//$data = Student::where("sname='赵虎'")->first();
			//p($data);

			//获取数据表所有数据
			//$res = Student::getAll();
			//p($res);

			//查找年龄>30的同学
			//$data = Student::where("age>30 or sex='男'")->getAll();
			//p($data);

			//查询指定列
			//$data = Student::where('age>30')->field("sname,sex")->getAll();
			//p($data);

			//排序封装（注意这句话打开页面会报错，留给你的作业）
			//$data = Student::where('age>30')->order('age desc')->getAll();


		//insert数据写入
		//$data = [
		//	'age'=>18,
		//	'sname'=>'你好超人',
		//	'sex'=>'男',
		//	'cid'=>1,
		//];
		//Student::insert($data);

		//修改
		//$data = [
		//	'age'=>28,
		//	'sname'=>'王朝修改',
		//	'sex'=>'男',
		//];
		//$res = Student::where('id=1')->update($data);
		//p($res);

		//删除
		//Student::where('id=1')->delete();

	}


	public function add(){
		View::make();
	}


}