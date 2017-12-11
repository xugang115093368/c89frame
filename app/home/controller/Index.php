<?php

namespace app\home\controller;

use houdunwang\core\Controller;

class Index extends Controller {
	public function index(){
		//echo 'index';
		//1.public/view放入message.php模板文件，详情参考模板文件
		//2.在houdunwang/core/创建Controller.php类
		//3.Index继承Controller类
		//4.测试能否调用Controller类里面message方法
		//链式操作，关键$this->setRedirect ()需要返回$this
		//$this->setRedirect ()->message('添加成功');
		echo '首页';
		//p(u('member/index'));//?s=home/member/index
		//p(u('member'));//?s=home/Index/member
		//p(u('member/Entry/index'));//?s=member/Entry/index
	}

	public function add(){

		//$this->setRedirect ()->message('添加成功');
		//$this->setRedirect ('?s=member/mine/index')->message('添加成功');
		//封装一个生成url的函数u
		//u('模块/控制器/方法')----> ?s=member/mine/index
		//p(u('home/index/index'));
		//p(u('index/index'));
		$this->setRedirect (u('article/add'))->message('添加成功');

	}
}