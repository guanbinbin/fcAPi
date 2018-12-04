<?php
namespace app\user\controller;

use think\Controller;
use think\Request;
use think\Db;

// http://localhost/tp5/index.php/user/User/addUser

class Login extends Controller{   
	public function login(){
		/*
         通过id判断是与否有该用户
         1. userId or name 
         2. password
         return  
         { code: 1, msg: 'login success', status: true}
         { code: 0, msg: 'login fail', status: false}
      */

        $request = Request::instance();

        $name = $request->param('name');
        $pwd =  $request->param('pwd');

        // $data=Db::table('userInfo')->select();

        // $response = "";
        // for($i= 0; $i< count($data); $i++) {
        //   if($data[$i].name == $name && $data[$i].pwd== $pwd){
        //     $response = { 
        //       "code": 1, 
        //       "msg": '登录成功！',
        //       "data": {
        //           "id": 1,
        //           "name": "李强",
        //           "pwd": "123456",
        //           "phone": "15255575890",
        //           "qq": "1234321",
        //           "date": "2018-12-01",
        //           "type": 1
        //       }
        //       "status": false
        //     };
        //     break;
        //   }else {
        //     $response = { 
        //       code: 0, 
        //       msg: '用户名或者密码错误！',
        //       status: false
        //     }
        //   }
        // }

        return json($name);
        
	}
    
}

