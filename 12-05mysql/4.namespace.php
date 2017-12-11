<?php
namespace a;
function hd(){
	echo 'a空间的hd函数';
}
//hd();//a空间的hd函数
//\b\hd();//b空间的hd函数
//常量
const PATH = 'www/c89';
//echo PATH;//www/c89


class IndexController{
	public function index(){
		echo 'a空间的index方法';
	}
}
//a空间的index方法
//(new IndexController())->index ();






namespace b;

function hd(){
	echo 'b空间的hd函数';
}
//hd();//b空间的hd函数
//输出调用a空间的hd函数
// \跟空间(全局空间)
//调用全局空间中a空间里面的hd函数
//\a\hd ();//a空间的hd函数

//报错：PATH未定义
//const定义的常量收到命名空间显示，只作用到当前自己空间
//echo PATH;
//调用a空间PATH
//echo \a\PATH;//www/c89


//类找不到，访问报错：b\IndexController找不到
//(new IndexController())->index ();
//访问a空间IndexController类
//a空间的index方法
(new \a\IndexController())->index ();

