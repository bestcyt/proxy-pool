<?php

namespace App\Repositories;

use App\Model\proxy\Urls;
use App\Repositories\Interfaces\ProxyUrlRepositoryInterface;

class ProxyUrlRepository implements ProxyUrlRepositoryInterface
{

    //后期优化@todo 可以走链式调用 , 实现多
    public function all()
    {
        return Urls::all();
    }

    public function find($id)
    {
        return Urls::find($id);
    }

    public function where($where = [])
    {
        if (!$where){
            return $this->all();
        }
        return Urls::where($where)->get();
    }
}
