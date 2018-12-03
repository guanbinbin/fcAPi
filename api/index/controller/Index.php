<?php
namespace app\index\controller;

class Index
{
    public function index()
    {
        return 'hello,thinkphp!';
    }
    
    public function hello($name)
    {
        return 'Hello,'.$name;
    }
}
