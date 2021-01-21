<?php

namespace App\Console\Commands;

use App\Services\ProxyUrlService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SpiderUrls extends Command
{
    protected $name = 'spiderUrls';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spiderUrls';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '爬取多个网站，获取ip，存储';

    protected $proxyUrlService;

    /**
     * Create a new command instance.
     * SpiderUrls constructor.
     * @param ProxyUrlService $proxyUrlService
     */
    public function __construct(ProxyUrlService $proxyUrlService)
    {
        $this->proxyUrlService = $proxyUrlService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::info('爬虫脚本');
        //注入service 业务分离
        //获取urls
//        $urls = $this->proxyUrlService->getUrls();
        //记录所有可用网址日志

        //循环爬取，如果失败，或者无法访问，说明不可用，更新网址

        //爬完，更新ip表

    }
}
