<?php
//创建一个命名空间应用控制一个页面
namespace app\home\controller;
//加载库类满足两个条件use导入命名空间使用核心控制器
use houdunwang\core\Controller;
//应用类索引扩展控制器
class Index extends Controller{
//声明一个公共的index的方法
    public function index(){

        //echo 'index';
        $this->setRedirect('?s=member/mine/index')->message('柔若时光里最美的挥霍');
        echo '首页';

    }
    //声明一个公共的的方法add的方法
    public function add(){

        ////链式操作，关键$this->setRedirect 封装一个生成url的函数u


        $this->setRedirect (u('article/add'))->message('柔若时光里最美的挥霍');
    }
}



