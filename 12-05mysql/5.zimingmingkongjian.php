<?php
namespace  a\d{
	class IndexController{
		public function index(){
			echo 'a\c空间index方法';
		}
	}
	//(new IndexController())->index ();
	define ('APP','www');
	//echo APP;
}


namespace b\c{
	//Class 'b\c\IndexController' not found
	//(new IndexController())->index ();
	//输出a空间IndexController
	//a\c空间index方法
	//(new \a\d\IndexController())->index ();


	//echo APP;
}
