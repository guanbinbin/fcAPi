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

    public function addClient(){
        $request = Request::instance();

        $name = $request->param('name');
        $phone =  $request->param('phone');
        $user_id =  $request->param('user_id');
        $mail=  $request->param('mail');
        $other_contact = $request->param('other_contact');
        $address =  $request->param('address');
        $loupan = $request->param('loupan');
        $price =  $request->param('price');
        $mianji=  $request->param('mianji');
        $huxing = $request->param('huxing');
        $house_floor =  $request->param('house_floor');
        $buy_for=  $request->param('buy_for');
        $beizhu = $request->param('beizhu');
        $loupan_type =  $request->param('loupan_type');

        if(empty($name) || empty($phone)) {
            $res=Array('code'=>0,
                'success' => 0,
                'msg'=>'请将姓名和电话填写完整',
                'data'=>0
            );
        }else {
            $clientInfo = [];
            if(!empty($user_id)) {
                $clientInfo['user_id'] = $user_id;
            };
            if(!empty($mail)) {
              $clientInfo['mail'] = $mail;
            };
            if(!empty($other_contact)) {
                $clientInfo['other_contact'] = $other_contact;
            };
            if(!empty($address)) {
              $clientInfo['address'] = $address;
            };
            if(!empty($loupan)) {
                $clientInfo['loupan'] = $loupan;
            };
            if(!empty($price)) {
              $clientInfo['price'] = $price;
            };
            if(!empty($mianji)) {
                $clientInfo['mianji'] = $mianji;
            };
            if(!empty($huxing)) {
              $clientInfo['huxing'] = $huxing;
            };
            if(!empty($house_floor)) {
                $clientInfo['house_floor'] = $house_floor;
            };
            if(!empty($buy_for)) {
              $clientInfo['buy_for'] = $buy_for;
            };
            if(!empty($beizhu)) {
              $clientInfo['beizhu'] = $beizhu;
            };
            if(!empty($loupan_type)) {
                $clientInfo['loupan_type'] = $loupan_type;
            };
            if(!empty($name)) {
              $clientInfo['name'] = $name;
            };
            if(!empty($phone)) {
              $clientInfo['phone'] = $phone;
            };

            //客户添加日期
            $clientInfo['date'] = date("Y-m-d");

            //插入数据
            $newDate =  Db::name('client')->insert($clientInfo);
            $userId = Db::name('client')->getLastInsID();

            //添加用户记录
            if( !empty($newDate)) {
                $houseId = Db::name('client')->getLastInsID();
                if(!empty($beizhu)) {
                    $des = $beizhu;
                }else {
                    $des = '开始跟进';
                };

                $status = [];
                $status['house_id'] = $houseId;
                $status['user_id'] = $user_id;
                $status['step'] = 1;
                $status['description'] = $des;
                $status['date'] = date("Y-m-d");
                Db::name('house_status')->insert($status);
            };

            $res=Array('code'=>200,
                'success' => true,
                'msg'=>'添加客户成功',
                'data'=>$newDate
            );
        };
        return json($res);
    }

    public function getOneClient(){
        $request = Request::instance();
        $house_id =  $request->param('client_id');

        $data = Db::name('client')->where('client_id',$house_id)->select();

        if(isset($data)){
            $res=Array('code'=>200,
                'success' => true,
                'msg'=>'获取到指定客户',
                'data'=>$data
            );
        }else {
            $res=Array('code'=>0,
                'success' => false,
                'msg'=>'客户为空',
                'data'=>0
            );
        }
        return json($res);
    }

    public function getBase(){
        $request = Request::instance();
        $list = Db::name('house_base')->select();
        if(isset($list)){
            if(count($list)){
                $res=Array('code'=>200,
                'success' => true,
                'msg'=>'获取到用户列表',
                'data'=>$list);
            }else {
                $res=Array('code'=>1,
                'success' => true,
                'msg'=>'用户为空',
                'data'=>$list);
            }
        }else {
            $res=Array('code'=>-1,
                'success' => true,
                'msg'=>'参数错误',
                'data'=>0
            );
        }
        return json($res);
    }
    
 }

?>