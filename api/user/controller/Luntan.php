<?php
namespace app\user\controller;

use think\Controller;
use think\Request;
use think\Db;

header('Access-Control-Allow-Origin: *');

class Luntan extends Controller{   
    public function getList(){
        $data=Db::name('forum_thread')->where('fid',57)->select();
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