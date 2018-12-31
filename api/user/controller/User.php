<?php
namespace app\user\controller;

use think\Controller;
use think\Request;
use think\Db;



header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT');


class User extends Controller{   
    public function getUserList()
    {   
    	$data=Db::name('user')->select();
    	if(isset($data) && count($data)){
    		$res=Array('code'=>200,
    			'success' => true,
    			'msg'=>'获取到用户列表',
                'number'=> count($data),
    			'data'=>$data
    		);
    	}else {
    		$res=Array('code'=>-1,
    			'success' => true,
    			'msg'=>'用户为空',
                'number' => 0,
    			'data'=>0
    		);
    	}
        return json($res);
    }

    /*
    *  查询用户
    * params
    * id: array
    * type: default is null or 0
    * keywords: default is ''
    * pageIndex: default is null or 0 
    * pageSize: default is 20 
    */ 
    public function queryUser(){

        // $a=array("red","green");
        // array_push($a,"blue","yellow");
        // print_r($a);


        $request = Request::instance();
        $id = $request->param('id');
        $type =  $request->param('type');
        $keyword =  $request->param('keyword');
        $pageIndex = $request->param('pageIndex');
        $pageSize =  $request->param('pageSize');

        $sql = array();
        if(isset($id) && !empty($id)) {
           array_push($sql,array('id'=>$id));
        };

        if(isset($type) && !empty($type)) {
           array_push($sql,array('type'=>$type));
        };
        if(isset($keyword) && !empty($keyword)) {
           array_push($sql,array('keyword'=>$keyword));
        };

        if(isset($pageIndex) && !empty($pageIndex)) {
           array_push($sql,array('pageIndex'=>$pageIndex));
        }else {
          array_push($sql,array('pageIndex'=>1));
        };

        if(isset($pageSize) && !empty($pageSize)) {
           array_push($sql,array('pageSize'=>$pageSize));
        }else {
            array_push($sql,array('pageSize'=>10));
        };

        print_r($sql);




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