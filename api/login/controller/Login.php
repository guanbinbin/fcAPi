<?php
namespace app\user\controller;

use think\Db;

// http://localhost/tp5/index.php/user/User/addUser

 // header('Access-Control-Allow-Origin: *');
class Login
{   
	public function login(){
		header('Access-Control-Allow-Origin: *');
		/*
         通过id判断是与否有该用户
         1. userId or name 
         2. password
         return  
         { code: 1, msg: 'login success', status: true}
         { code: 0, msg: 'login fail', status: false}
      */
		$name= $_POST['name'];
        $pwd= $_POST['pwd'];
        
        $response = {};
        $data=Db::table('userInfo')->select();

        if(isset($name) && isset($pwd)) {
          for($i = 0; $i<count($data); $i++) {
          	if($data[$i].name == $name && $data[$i].pwd == $pwd) {
          		$response = { 
          			code: 1, 
          			msg: 'login success', 
          			status: true
          		};
          		break;
          	}else {
          		$response = { 
          			code: 0, 
          			msg: 'login fail', 
          			status: false
          		};
          	}
          }
        }else {
        	$response = { 
        		code: 0, 
        		msg: '请输入用户名和密码不为空', 
        		status: false
        	};
        };

        return json($response);
        
	}
    
}