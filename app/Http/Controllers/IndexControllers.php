<?php
/*
 *
 */
namespace App\Http\Controllers;

class IndexControllers extends Controller{

    //http://cms.com/index/index
    public function index(){
        //return 'haha';
        //return route('indexindex'); //输出：http://cms.com/index/index
        //return "$id";
        
        return view("Index.index");
    }
}




