<?php

namespace App\Services;

use App\Repositories\Interfaces\ProxySpiderIpRepositoryInterface;
use App\Repositories\Interfaces\ProxyUrlRepositoryInterface;
use Illuminate\Http\Request;

class ProxyUrlService
{
    public $proxyUrls;
    public $request ;

    // 网址业务层
    public function __construct(ProxyUrlRepositoryInterface $proxyUrls)
    {
        $this->proxyUrls = $proxyUrls;
        $this->request = Request::class;
    }

    //获取网址列表
    public function getUrls(){
        //是否有过滤参数 @todo , 遍历判断， 先放着吧，先写定时脚本
        $list = $this->proxyUrls->all();
        return $list;
    }

}
