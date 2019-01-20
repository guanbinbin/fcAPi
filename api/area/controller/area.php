<?php 
namespace app\client\controller;

use think\Controller;
use think\Request;
use think\Db;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: content-type');

 class Area extends Controller {
 	/*
 	* 获取所有地区
 	*/ 
 	public function getArea(){
 		$data=Db::name('area')->select();

        $request = Request::instance();


    	if(isset($data) && count($data)){
    		$res=Array('code'=>200,
    			'success' => true,
    			'msg'=>'获取到用户列表',
    			'data'=>$data
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

