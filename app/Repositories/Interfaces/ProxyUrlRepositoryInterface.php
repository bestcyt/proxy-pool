<?php

namespace App\Repositories\Interfaces;

//url表仓储接口
interface ProxyUrlRepositoryInterface
{

    public function all();

    public function find($id);

}
