<?php
function __autoload($name){
	//echo $name;//app\IndexController
	include str_replace ('\\','/',$name) . '.php';
}
(new \app\IndexController())->index();
//(new \common\CommonController());