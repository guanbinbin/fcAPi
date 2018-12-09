<?php
namespace app\user\controller;

use think\Controller;
use think\Request;
use think\Db;


header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Headers: x-requested-with,content-type');
// header('Access-Control-Allow-Methods: OPTIONS,POST,GET');

class User extends Controller{   
    public function getUserList()
    {   
    	$data=Db::name('user')->select();
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

    /*
    * 添加新用户
    *@param: string name
    *@param: string pwd
    *@param: int phone
    *@param: int qq
    */ 
    public function addUser()
    {   
    	$request = Request::instance();
        $name = $request->param('name');
        $pwd =  $request->param('pwd');
        $type =  $request->param('type');
        $phone = $request->param('phone');
        $qq =  $request->param('qq');
        $date = date("Y-m-d");

        $data=Array(
        	'name'=>$name,
        	'pwd' =>$pwd,
        	'type' => $type,
        	'phone'=>$phone,
        	'qq' => $qq,
        	'date' => $date
        );

       Db::name('user')->insert($data);
	   $userId = Db::name('user')->getLastInsID();

		if(!empty($userId)) {
			$res = array('code'=>200,
				'success'=>true,
				'msg'=>'用户创建成功',
				'data'=>Array('userId'=>$userId,
					'name'=>$name,
					'pwd'=>$pwd,
					'phone'=>$phone,
					'qq'=>$qq,
					'date'=>$date
				)
			);
		}else {
			$res = array('code'=>-1,
				'success'=>false,
				'msg'=>'用户创建失败');
		}
        return json($res);
    }

    public function updateUser(){
    }

    public function filterUser(){
    	/*
    	*根据用户类型： type筛选用户
    	*/ 
    	$request = Request::instance();
        $type =  $request->param('type');

        if($type == 0 ){
          $data=Db::name('user')->select();
        }else {
          $data=Db::name('user')->where('type',$type)->select();
        }	

    	
    	if(isset($data) && count($data)){
    		$res=Array('code'=>200,
    			'success' => true,
    			'msg'=>'成功获取用户列表',
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
    
    public function searchUser(){
      /*
      * 用户类型： $type
      * 模糊查询条件： $condition
      */ 
      $request = Request::instance();
      $type =  $request->param('type');
      $condition =  $request->param('condition');
      $query = "1";

      $data = Db::name('user')->where('id|name|qq|phone|date','like',1)->select();

      if(isset($data) && count($data)){
    		$res=Array('code'=>200,
    			'success' => true,
    			'msg'=>'成功获取用户列表',
    			'data'=>$data
    		);
      }else {
    		$res=Array('code'=>-1,
    			'success' => true,
    			'msg'=>'用户为空',
    			'data'=>0
    		);
      };

      return json($data);
    } 
}