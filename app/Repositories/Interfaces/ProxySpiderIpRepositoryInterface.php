<?php

namespace App\Repositories\Interfaces;

//爬取的ip表仓储接口
interface ProxySpiderIpRepositoryInterface
{

    public function all();

    public function find($id);

    //限制where格式
    public function where($where);

}
