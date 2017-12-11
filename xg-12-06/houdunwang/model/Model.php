<?php
namespace houdunwang\model;
class Model
{
    public function __call ( $name , $arguments )
    {
        return self ::runParse ( $name , $arguments );
    }

    public static function __callStatic ( $name , $arguments )

    {
        //self调用自己里面的方法
        return self ::runParse ( $name , $arguments );
    }

    public static function runParse ( $name , $arguments )

    {
        //p(get_called_class());
        //获得当前调用的模型的名称，因为我们要使用其作为查询的数据的表名
        $class=get_called_class();
        //p($class);die;//system\model\Student
        //$names调用的方法
        //  p($name);//field/
      return call_user_func_array ( [ new Base($class) , $name ] , $arguments );

    }
}