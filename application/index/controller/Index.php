<?php
namespace app\index\controller;
use think\Controller;

class Index extends Controller
{
	public function index()
	{
	    $fromId     =   input('fromid');
	    $toid       =   input('toid');
	    $this->assign([
	        'fromid'    =>  $fromId,
            'toid'      =>  $toid
        ]);
		return view();
	}

	public function lists()
    {
        $fromId         =   input('fromid');
        $this->assign([
            'fromid'    =>  $fromId
        ]);
        return view();
    }
}