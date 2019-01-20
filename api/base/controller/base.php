<?php 
namespace app\client\controller;

use think\Controller;
use think\Request;
use think\Db;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: content-type');

 class Base extends Controller {
 	/*
 	* 获取楼盘库列表
 	*/ 
 	public function getHouseBase(){
 		//$data=Db::name('house_base')->select();

        $request = Request::instance();


    	if(isset($list) && count($list)){
    		$res=Array('code'=>200,
    			'success' => true,
    			'msg'=>'获取到用户列表',
    			'data'=>$list
    		);
    	}else {
    		$res=Array('code'=>-1,
    			'success' => true,
    			'msg'=>'用户为空',
    			'data'=>0
    		);
    	}
        return json($res);
 	}

 }

?>
