<?php
namespace app\user\controller;

use think\Controller;
use think\Request;
use think\Db;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: content-type');


class Login extends Controller{   
	public function login(){
        $request = Request::instance();
        $name = $request->param('name');
        $pwd =  $request->param('pwd');
        if( $name && $pwd) {
           $res=Db::name('user')->where('name',$name)->where('pwd',$pwd)->find();
           if(!empty($res)) {
                $data = array(
                    'code' => 200, 'success'=> true,'msg'=>'用户登录成功','data'=> $res);
            }else {
                $data = array('code' => 0, 'success'=> false,'msg'=>'用户名或者密码错误！');
            }
           
        }else {
            $data = array('code' => -1, 'success'=> false,'msg'=>'登录失败,请重新核对用户名和密码');
        };
        return json($data);
        return $name;
    }
    
}

