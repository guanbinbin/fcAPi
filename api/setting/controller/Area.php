<?php 
namespace app\setting\controller;

use think\Controller;
use think\Request;
use think\Db;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: content-type');

 class Area extends Controller {
 	public function getArea(){
        $data=Db::name('area')->select();
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

    //修改地区
    public function updateArea(){
        $request = Request::instance();
        $area_id =  $request->param('area_id');
        $area_name =  $request->param('area_name');

        $data = Db::name('area')->update(['area_name' => $area_name,'area_id'=>$area_id]);
        if(!empty($data)){
            $res = array('code'=>200,
                'success'=>true,
                'msg'=>'地区修改成功');
        }else {
            $res = array('code'=>0,
                'success'=>false,
                'msg'=>'地区修改失败');
        }
        return json($res);
    }

    public function deleteArea(){
        $request = Request::instance();
        $area_id = $request->param('area_id');

        $res = Db::name('area')->delete($area_id);


        if(!empty($res)) {
            $data = Array("code"=>200,"success"=>true,"msg"=>"删除成功！","data"=>$res);
        }else {
            $data = Array("code"=>0,"success"=>false,"msg"=>"删除失败！","data"=>0);
        }
        return json($data);
    }

 }

?>

