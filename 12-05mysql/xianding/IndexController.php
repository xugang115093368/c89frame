<?php
/**
 * 加载类库：是否include将文件加载过来
 * 			命名空间是否正确
 */
namespace index\a;
include './CommonController.php';
class IndexController extends \CommonController
{
		public function index(){
			//echo 'index';
			echo '<br>';
			//当前命名空间
			echo __NAMESPACE__;//index\a
		}
}
(new IndexController())->index ();