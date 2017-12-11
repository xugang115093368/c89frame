<?php
//命名空间
namespace houdunwang\view;

class View{
    //声明call方法
    //调用(new View())->make()触发call方法;
    public function __call($name ,$arguments){
        p($name);
        //p($arguments)
        return self::runParse($name,$arguments);
    }
    //声明公共方法调用View::make()触发callStatic的方法
    public static function __callStatic($name, $arguments)
    {
        // TODO: Implement __callStatic() method.

        //通过返回触发来运行的方法
        return self::runParse($name,$arguments);

    }
//声明静态的方法调用(new Base)->$name();触发runParse的方法
    public static function runParse($name,$arguments){
         //(new Base)->$name();
        //p($arguments);die;
        //(new Base)->$name($arguments);
        return call_user_func_array ( [ new Base , $name ] , $arguments);
    }

}