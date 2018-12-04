<?php
namespace app\user\controller;

use think\Controller;
use think\Db;

// http://localhost/tp5/index.php/user/User/addUser

 // header('Access-Control-Allow-Origin: *');
class User
{   
    public function addUser()
    {   
    	$data=Db::table('userInfo')->select();
        return json($data);
    }
    
    
}