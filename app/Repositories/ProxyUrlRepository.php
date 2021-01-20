<?php

namespace App\Repositories;

use App\Model\proxy\Urls;
use App\Repositories\Interfaces\ProxyUrlRepositoryInterface;

class ProxyUrlRepository implements ProxyUrlRepositoryInterface
{

    public function all()
    {
        //读取db
        // TODO: Implement all() method.

        return Urls::all();
    }

    public function find($id)
    {
        // TODO: Implement find() method.
        return Urls::find($id);
    }
}
