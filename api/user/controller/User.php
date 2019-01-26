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
    	$data=Db::name('user')->limit(1,10)->select();
        $total=Db::name('user')->select();
    	if(isset($data) && count($data)){
    		$res=Array('code'=>200,
    			'success' => true,
    			'msg'=>'获取到用户列表',
                'number'=> count($total),
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
    * 查询用户
    * params
    * id: array
    * type: default is null or 0
    * keywords: default is ''
    * pageIndex: default is null or 0 
    * pageSize: default is 20 
    */ 
    public function queryUser(){
        $request = Request::instance();
        $id = $request->param('id');
        $type =  $request->param('type');
        $keyword =  $request->param('keyword');
        $pageIndex = $request->param('pageIndex');
        $pageSize =  $request->param('pageSize');

        $sql = array();
        $limit = array();
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
           array_push($limit,array('pageIndex'=>$pageIndex));
        }else {
          array_push($limit,array('pageIndex'=>1));
        };

        if(isset($pageSize) && !empty($pageSize)) {
           array_push($limit,array('pageSize'=>$pageSize));
        }else {
            array_push($limit,array('pageSize'=>10));
        };

        
        if(count($sql)) {
            $condition = array();
            foreach($sql as $key => $value) {
              foreach($sql[$key] as $k => $val){
                //array_push($condition, $k)
              }
              
            }
            print_r($condition);
        }else {
            
        }

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
        $request = Request::instance();
        $obj =  $request->param('obj');

        $arr['id'] = $obj['id'];
        $arr['name'] = $obj['name'];
        $arr['type'] = $obj['type'];
        $arr['pwd'] = $obj['pwd'];
        $arr['phone'] = $obj['phone'];
        $arr['qq'] = $obj['qq'];


        $res = Db::name('user')->update($arr);
        return json($res);
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
    		$res=Array('code'=>0,
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

      $data = Db::name('user')->where('type',$type)->where('id|name','like',"%{$condition}")->select();

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

    public function pageUserList(){
      /*
      * pageIndex： 当前页码
      * pageSize： 个数
      */ 
      $request = Request::instance();
      $pageIndex =  $request->param('pageIndex');
      $pageSize =  $request->param('pageSize');

      $data=Db::name('user')->page($pageIndex,$pageSize)->select();
      if(isset($data)){
        $res=Array('code'=>200,'success' => true,'msg'=>'成功获取用户列表','data'=>$data);
      }else {
        $res=Array('code'=>-1,
                'success' => true,
                'msg'=>'用户为空',
                'data'=>0
            );
      }
      
      return json($res);
    }

    public function deleteUser(){
        $request = Request::instance();
        $id = $request->param('id');

        $res = Db::name('user')->delete($id);


        if(!empty($res)) {
            $data = Array("code"=>200,"msg"=>"删除成功！","data"=>$res);
        }else {
            $data = Array("code"=>0,"msg"=>"删除失败！","data"=>0);
        }
        return json($data);
    }

    public function getCircleUsers(){
        $request = Request::instance();
        $users = Db::name('user')->select();

        $superAdmin = 0;
        $admin = 0;
        $person = 0;

        for($i=0; $i<count($users); $i++) {
            if($users[$i]['type'] == 1) {
              $superAdmin += 1;
            };
            if($users[$i]['type'] == 2) {
              $admin += 1;
            };
            if($users[$i]['type'] == 3) {
              $person += 1;
            };
        };

        $list = [];
        array_push($list, array('value'=>$superAdmin,'name'=>'超级管理员'));
        array_push($list, array('value'=>$admin,'name'=>'普通管理员'));
        array_push($list, array('value'=>$person,'name'=>'普通用户'));


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

    // 更新用户信息
    public function update(){
        $request = Request::instance();

        $user_id = $request->param('user_id');
        $name = $request->param('name');
        $pwd= $request->param('pwd');
        $type = $request->param('type');
        $phone = $request->param('phone');
        $qq = $request->param('qq');

        if(empty($user_id)) {
            $res=Array('code'=>-1,
                'success' => false,
                'msg'=>'更新用户失败,没找到用户编号！',
                'data'=>0
            );
        }else {
          if(!empty($user_id)) {
            $updataParams['user_id'] = $user_id;
          };
          if(!empty($name)) {
            $updataParams['name'] = $name;
          };
          if(!empty($pwd)) {
            $updataParams['pwd'] = $pwd;
          };
          if(!empty($type)) {
            $updataParams['type'] = $type;
          };
          if(!empty($phone)) {
            $updataParams['phone'] = $phone; 
          };
          if(!empty($qq)) {
            $updataParams['qq'] = $qq;   
          };

          // 修改的日期
          $updataParams['date'] = date("Y-m-d");  

          //返回更新的数据
          $updateInfo = Db::name('user')->update($updataParams);
          if(!empty($updateInfo)){
            $res=Array('code'=>200,
                'success' => true,
                'msg'=>'更新用户成功！',
                'data'=>$updataParams);
          }else {
            $res=Array('code'=>0,
                'success' => false,
                'msg'=>'更新用户失败！',
                'data'=>0
            );
          };
        };
        return json($res);
    }

    //删除用户
    public function delete(){
        $request = Request::instance();
        $user_id = $request->param('user_id');
        
        if(empty($user_id)){
            $res=Array('code'=>-1,
                'success' => false,
                'msg'=>'删除失败,没找到用户编号！',
                'data'=>0
            );
        }else {
          $number = Db::name('user')->delete($user_id);
          $res=Array('code'=>200,
                'success' => true,
                'msg'=>'删除成功！',
                'data'=>$user_id);
        };
        return json($res);
    }

    //搜索
    public function search(){
        $request = Request::instance();
        $keywords = $request->param('keywords');
        $type = $request->param('type');

        $userParams = [];
        if(!empty($keywords)) {
            if(is_numeric($keywords)){
                $userParams['user_id|phone|qq'] = ['like','%'.$keywords.'%'];
                // $userParams['phone'] = ['like','%'.$keywords.'%'];
                // $userParams['qq'] = ['like','%'.$keywords.'%'];
            }else {
                $userParams['name'] = ['like','%'.$keywords.'%'];
            };
            if(!empty($type)){
              $userParams['type'] = $type;
            };
            $list = Db::name('user')->where($userParams)->select();
         }else if( empty($keywords) && !empty($type)){ 
            $userParams['type'] = $type;
            $list = Db::name('user')->where($userParams)->select();
         }else{
            $list = Db::name('user')->select();
         };
         
        
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





    /*
    * 查询用户
    * params
    * user_id: int
    * type: default is null or 0
    * keywords: default is ''
    * pageIndex: default is null or 0 
    * pageSize: default is 20 
    */ 
    // public function query(){
    //    $request = Request::instance();
    //    $user_id = $request->param('user_id'); 

    //    if( !empty($user_id) ){
    //      $data = Db::name('user')->where('user_id',$user_id)->select();
    //      if(empty($data)) {
    //         $res=Array('code'=>0,
    //             'success' => false,
    //             'msg'=>'没有查询到指定用户！',
    //             'data'=>0);
    //      }else {
    //         $res=Array('code'=>200,
    //             'success' => true,
    //             'msg'=>'查询到指定用户！',
    //             'data'=>$data);
    //      };
    //    }else {
    //      $userParams = [];
    //      $keywords = $request->param('keywords'); 
    //      $type = $request->param('type');
    //      if(!empty($keywords) && !empty( $type )) {
    //         $userParams['user_id'] = ['like','%'.$keywords.'%'];
    //         $userParams['name'] = ['like','%'.$keywords.'%'];
    //         $userParams['phone'] = ['like','%'.$keywords.'%'];
    //         $userParams['qq'] = ['like','%'.$keywords.'%'];
    //         $userParams['type'] = $type;
    //      };



    //    };
    //    return json($res);
    // }


