<?php

namespace App\Repositories\Interfaces;

//可用ip表仓储接口
interface ProxySpiderAbleIpRepositoryInterface
{

    public function all();

    public function find($id);

    //限制where格式
    public function where($where);

}
