<?php


namespace App\Repositories;


use App\Model\proxy\SpiderIps;
use App\Repositories\Interfaces\ProxySpiderIpRepositoryInterface;

class ProxySpiderIpRepository implements ProxySpiderIpRepositoryInterface
{

    public function all()
    {
        return SpiderIps::all();
    }

    public function find($id)
    {
        return SpiderIps::find($id);
    }

    public function where($where)
    {
        return SpiderIps::where($where)->get();
    }
}
