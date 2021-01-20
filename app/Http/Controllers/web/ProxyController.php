<?php

namespace App\Http\Controllers\web;

use App\Services\ProxyUrlService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProxyController extends Controller
{
    public $proxyUrlService;


    public function __construct(ProxyUrlService $proxyUrlService)
    {
        $this->proxyUrlService = $proxyUrlService;
    }

    //代理池列表ip，分页
    public function proxyList(){

    }

    //列表手动点击检测某ip
    public function proxyCheck(){
        //获取request

        //调用model或者别的层的方法


    }
}
