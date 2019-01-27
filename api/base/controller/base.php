<?php 
namespace app\base\controller;

use think\Controller;
use think\Request;
use think\Db;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: content-type');

 class Base extends Controller {
    // 添加楼盘库
    public function addBase(){
        $request = Request::instance();

        $house_name = $request->param('house_name');
        $house_developer =  $request->param('house_developer');
        $house_position =  $request->param('house_position');
        $house_sbuway_line=  $request->param('house_sbuway_line');
        $deliver_time= $request->param('deliver_time');
        $house_manage_company =  $request->param('house_manage_company');
        $house_fee = $request->param('house_fee');
        $total_cover_area =  $request->param('total_cover_area');
        $total_construction_area=  $request->param('total_construction_area');
        $house_floor =  $request->param('house_floor');
        $tihu_number=  $request->param('tihu_number');
        $total_house_number = $request->param('total_house_number');
        $parking_rate =  $request->param('parking_rate');
        $singlefloor_housenumber = $request->param('singlefloor_housenumber');
        $house_oritation =  $request->param('house_oritation');
        $building_number=  $request->param('building_number');
        $saleing_buildingnumber_floornumber = $request->param('saleing_buildingnumber_floornumber');
        $has_opened_building_number =  $request->param('has_opened_building_number');
        $not_opend_building_number=  $request->param('not_opend_building_number');
        $saleing_house_type = $request->param('saleing_house_type');
        $saleing_house_floor =  $request->param('saleing_house_floor');
        $saleing_house_area = $request->param('saleing_house_area');
        $saleing_house_specialprice =  $request->param('    saleing_house_specialprice');
        $saleing_house_averageprice = $request->param('saleing_house_averageprice');
        $saleing_house_maxprice =  $request->param('saleing_house_maxprice');
        $decorate_situation = $request->param('decorate_situation');
        $rent_situation =  $request->param('rent_situation');
        $is_charter =  $request->param('is_charter');
        $charter_policy = $request->param('charter_policy');
        $open_time =  $request->param('open_time');
        $next_open_time = $request->param('next_open_time');
        $discount_activity =  $request->param('discount_activity');
        $discount_situation =  $request->param('discount_situation');
        $near_traffic = $request->param('near_traffic');
        $near_education =  $request->param('near_education');
        $near_business = $request->param('near_business');
        $near_environment =  $request->param('near_environment');

        if(empty($house_name)) {
            $res=Array('code'=>0,
                'success' => 0,
                'msg'=>'请填写楼盘名称',
                'data'=>0
            );
        }else {
            $baseInfo = [];
            if(!empty($house_name)) {
                $baseInfo['$house_name'] = $house_name;
            };
            if(!empty($house_developer)) {
              $baseInfo['house_developer'] = $house_developer;
            };
            if(!empty($house_position)) {
                $baseInfo['house_position'] = $house_position;
            };
            if(!empty($house_sbuway_line)) {
              $baseInfo['house_sbuway_line'] = $house_sbuway_line;
            };
            if(!empty($deliver_time)) {
                $baseInfo['deliver_time'] = $deliver_time;
            };
            if(!empty($house_manage_company)) {
              $baseInfo['house_manage_company'] = $house_manage_company;
            };
            if(!empty($house_fee)) {
                $baseInfo['house_fee'] = $house_fee;
            };
            if(!empty($total_cover_area)) {
              $baseInfo['total_construction_area'] = $total_cover_area;
            };
            if(!empty($total_construction_area)) {
              $baseInfo['total_construction_area'] = $total_construction_area;
            };
            if(!empty($house_floor)) {
                $baseInfo['house_floor'] = $house_floor;
            };
            if(!empty($tihu_number)) {
              $baseInfo['tihu_number'] = $tihu_number;
            };
            if(!empty($total_house_number)) {
              $baseInfo['total_house_number'] = $total_house_number;
            };
            if(!empty($parking_rate)) {
                $baseInfo['parking_rate'] = $parking_rate;
            };
            if(!empty($singlefloor_housenumber)) {
              $baseInfo['singlefloor_housenumber'] = $singlefloor_housenumber;
            };
            if(!empty($house_oritation)) {
              $baseInfo['house_oritation'] = $house_oritation;
            };
            if(!empty($building_number)) {
                $baseInfo['$building_number'] = $building_number;
            };
            if(!empty($saleing_buildingnumber_floornumber)) {
              $baseInfo['saleing_buildingnumber_floornumber'] = $saleing_buildingnumber_floornumber;
            };
            if(!empty($has_opened_building_number)) {
                $baseInfo['has_opened_building_number'] = $has_opened_building_number;
            };
            if(!empty($not_opend_building_number)) {
              $baseInfo['not_opend_building_number'] = $not_opend_building_number;
            };
            if(!empty($saleing_house_type)) {
                $baseInfo['saleing_house_type'] = $saleing_house_type;
            };
            if(!empty($saleing_house_floor)) {
              $baseInfo['saleing_house_floor'] = $saleing_house_floor;
            };
            if(!empty($saleing_house_area)) {
                $baseInfo['saleing_house_area'] = $saleing_house_area;
            };
            if(!empty($saleing_house_specialprice)) {
              $baseInfo['saleing_house_specialprice'] = $saleing_house_specialprice;
            };
            if(!empty($saleing_house_averageprice)) {
              $baseInfo['saleing_house_averageprice'] = $saleing_house_averageprice;
            };
            if(!empty($saleing_house_maxprice)) {
                $baseInfo['saleing_house_maxprice'] = $saleing_house_maxprice;
            };
            if(!empty($decorate_situation)) {
              $baseInfo['decorate_situation'] = $decorate_situation;
            };
            if(!empty($rent_situation)) {
              $baseInfo['rent_situation'] = $rent_situation;
            };
            if(!empty($is_charter)) {
                $baseInfo['is_charter'] = $is_charter;
            };
            if(!empty($charter_policy)) {
              $baseInfo['charter_policy'] = $charter_policy;
            };
            if(!empty($open_time)) {
              $baseInfo['open_time'] = $open_time;
            };



            if(!empty($next_open_time)) {
              $baseInfo['next_open_time'] = $next_open_time;
            };
            if(!empty($discount_activity)) {
                $baseInfo['discount_activity'] = $discount_activity;
            };
            if(!empty($discount_situation)) {
              $baseInfo['discount_situation'] = $discount_situation;
            };
            if(!empty($near_traffic)) {
              $baseInfo['near_traffic'] = $near_traffic;
            };
            if(!empty($near_education)) {
              $baseInfo['near_education'] = $near_education;
            };
            if(!empty($near_business)) {
                $baseInfo['near_business'] = $near_business;
            };
            if(!empty($near_environment)) {
              $baseInfo['near_environment'] = $near_environment;
            };
            
            //客户添加日期
            $baseInfo['date'] = date("Y-m-d");
            //插入数据
            $newDate =  Db::name('house_base')->insert($baseInfo);

            $res=Array('code'=>200,
                'success' => true,
                'msg'=>'添加客户成功',
                'data'=>$newDate
            );
        };
        return json($res);
    }

 	/*
 	* 获取楼盘库列表
 	*/
    //搜索
    public function query(){
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
            $list = Db::name('house_base')->where($userParams)->select();
         }else{
            $list = Db::name('house_base')->select();
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

    /*
    * 查询客户
    * params
    * user_id: int
    * type: default is null or 0
    * keywords: default is ''
    * pageIndex: default is null or 0 
    * pageSize: default is 20 
    */
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
