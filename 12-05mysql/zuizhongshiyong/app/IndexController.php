<?php
namespace app;

//继承CommonController方式一
//class IndexController extends \common\CommonController{
//	public function index(){
//		echo 'index';
//	}
//}

//方式二,使用use导入命名空间
//最为常用，见的最多的情况
//use common\CommonController;
//
//class IndexController extends CommonController {
//	public function index(){
//		echo 'index';
//	}
//}

//方式三
use common\CommonController as c;

class IndexController extends c {
	public function index(){
		echo 'index';
	}
}
