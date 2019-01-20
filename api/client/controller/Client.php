<?php 
namespace app\client\controller;

use think\Controller;
use think\Request;
use think\Db;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: content-type');

 class Client extends Controller {
 	/*
 	* 获取用户列表
 	*/ 
 	public function getClientList(){
 		$data=Db::name('client')->select();

        //处理客户归属人
        $list = [];
        $users = Db::name('user')->select();
        for($i=0; $i<count($data); $i++) {
          for($j=0; $j<count($users); $j++) {
            if($data[$i]['user_id'] == $users[$j]['user_id']) {
                $item = Array('client_id'=>$data[$i]['client_id'],'name'=>$data[$i]['name'],'phone'=>$data[$i]['phone'],'address'=>$data[$i]['address'],'loupan'=>$data[$i]['loupan'],'huxing'=>$data[$i]['huxing'],'price'=>$data[$i]['price'],'mianji'=>$data[$i]['mianji'],'belonger'=>$users[$j]['name'],'user_id'=>$users[$j]['user_id'],'loupan_type'=>$data[$i]['loupan_type'],'is_active'=>$data[$i]['is_active']);
                array_push($list, $item);
            }
          }
        }


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

 	/*
 	*  查询客户黑名单
 	*/ 
 	public function getBlackList(){
 		$data=Db::name('black_user')->select();
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

    public function queryClient(){
        $request = Request::instance();

        $client['user_id'] = $request->param('user_id');
        $getKeywords['keywords'] = $request->param('keywords');
  
        if(isset($getKeywords['keywords'])) {
            $client['phone'] = ['like',$getKeywords['keywords'].'%'];
        };
       
        if(empty($client)) {
           $data = Db::name('client')->select();
        }else {
           $data = Db::name('client')->where($client)->select();
        };


        //处理客户归属人
        $list = [];
        $users = Db::name('user')->select();
        for($i=0; $i<count($data); $i++) {
          for($j=0; $j<count($users); $j++) {
            if($data[$i]['user_id'] == $users[$j]['user_id']) {
                $item = Array('client_id'=>$data[$i]['client_id'],'name'=>$data[$i]['name'],'phone'=>$data[$i]['phone'],'address'=>$data[$i]['address'],'loupan'=>$data[$i]['loupan'],'huxing'=>$data[$i]['huxing'],'price'=>$data[$i]['price'],'mianji'=>$data[$i]['mianji'],'belonger'=>$users[$j]['name'],'user_id'=>$users[$j]['user_id'],'loupan_type'=>$data[$i]['loupan_type'],'is_active'=>$data[$i]['is_active']);
                array_push($list, $item);
            }
          }
        }




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