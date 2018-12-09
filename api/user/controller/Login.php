<?php
namespace app\user\controller;

use think\Controller;
use think\Request;
use think\Db;

// http://localhost/tp5/index.php/user/User/addUser
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: content-type');


class Login extends Controller{   
	public function login(){
		/*
         通过id判断是与否有该用户
         1. userId or name 
         2. password
         return  
         { code: 200, msg: 'login success', status: true}
         { code: -1, msg: 'login fail', status: false}
      */

        $request = Request::instance();

        $name = $request->param('name');
        $pwd =  $request->param('pwd');

        if( $name && $pwd) {
           $res=Db::name('user')->where('name',$name)->where('pwd',$pwd)->find();
           if(!empty($res)) {
                $data = array(
                     'code' => 200, 
                     'success'=> true,
                     'msg'=>'用户登录成功',
                     'data'=> $res
                );
            }else {
                $data = array('code' => 0, 'success'=> false,'msg'=>'用户名或者密码错误！');
            }
           
        }else {
            $data = array('code' => -1, 'success'=> false,'msg'=>'登录失败,请重新核对用户名和密码');
        }

        return json($data);
    }
    
}

