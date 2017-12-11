<?php
/**
 * Created by PhpStorm.
 * User: 徐刚
 * Date: 2017/12/7
 * Time: 17:40
 */
//命名空间
namespace houdunwang\view;

//创建一个实列化Bese类
class Base
{
    //利用私有的方法存储变量
    private $data=[];
    //模版文件
    private $file='';

    //声明公共make的方法显示模版目录文件
    public function make(){
        echo '平遥倒转时空的小世界';
        p(MODULE);
        P(CONTROLLER);
       p(ACTION);
       // include '../app/home/view/index/index.heml';
        //include '../app/'.MODULE.'/view/'.strtolower (CONTROLLER).'/'.ACTION.'.php';
        //$this->file= '../app/'.MODULE.'/view/'.strtolower (CONTROLLER).'/'.ACTION.'.' . c('view.suffix');
       //return $this;
    }
    //分配变量
    //声明with的方法
    public function with($var=[]){
        //p($var);die;
        //把$var的值赋值于数据库
        $this->data=$var;
        return $this;
    }
    //声明公共方法
   public function __toString(){
        //p($this->data);
       //将键名变为变量名字,将键值变为变量值
       extract ($this->data);
       //die;
       if($this->file){

       }
        return'';

    }



}