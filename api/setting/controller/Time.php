<?php 
namespace app\setting\controller;

use think\Controller;
use think\Request;
use think\Db;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: content-type');

 class Time extends Controller {
    /*获取激活时间
    */ 
    public function getTime(){
        $data=Db::name('active_time')->where('time_id',1)->find();
        if(isset($data) && count($data)){
            $res=Array('code'=>200,
                'success' => true,
                'msg'=>'获取到跟进时间周期',
                'data'=>$data
            );
        }else {
            $res=Array('code'=>-1,
                'success' => true,
                'msg'=>'没有获取到跟进的时间周期',
                'data'=>0
            );
        }
        return json($res);
    }

    public function updateTime(){
        $request = Request::instance();
        $active_time =  $request->param('active_time');

        $data = Db::name('active_time')->update(['active_time' => $active_time,'time_id'=>1]);
        if(!empty($data)){
            $res = array('code'=>200,
                'success'=>true,
                'msg'=>'时间修改成功');
        }else {
            $res = array('code'=>0,
                'success'=>false,
                'msg'=>'时间修改失败');
        }
        return json($res);
    }

 }

?>

