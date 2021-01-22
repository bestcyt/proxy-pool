<?php

namespace App\Http\Controllers\web;

use App\Services\ProxySpiderIpService;
use App\Services\ProxyUrlService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tools\simple_html_dom;
use function GuzzleHttp\Psr7\str;

class ProxyController extends Controller
{
    public $proxyUrlService;
    public $proxySpiderIpService;


    public function __construct(ProxyUrlService $proxyUrlService,ProxySpiderIpService $proxySpiderIpService)
    {
        $this->proxyUrlService = $proxyUrlService;
        $this->proxySpiderIpService = $proxySpiderIpService;
    }

    public function index(){
        $simple = new simple_html_dom();
        //获取网址，爬取
        $proxyUrls = $this->proxyUrlService->getUseUrls();
        $spiderTime = date('YmdH');
        $currentDayBegin = strtotime(date('Y-m-d'));
        foreach ($proxyUrls as $proxyUrl){
            $url = $proxyUrl->url;
            $data = $this->proxySpiderIpService->begin($url);
            $html = $this->proxySpiderIpService->getUrlHtml($url);
            // 判断能不能访问
            $html = iconv("gb2312", "utf-8//IGNORE",file_get_contents($url));
            $simple->load($html);
            //一个url一个入口

            //解析页面单独出来一个方法

            //判断分页一个方法，再递归回解析页面，把分页url传入
            $trs = $simple->find('table tbody tr');
            $data = [];
            foreach ($trs as $tr){
                //第一个tr是th，跳过
                if (!$tr->find('td')){
                    continue;
                }
                //@todo 先这么写，后面可以直接根据配置循环key，再后面可以直接黏贴html格式，算了再说吧
                $data[] = [
                    'url_id' => $proxyUrl->id,
                    'ip' => $tr->find('td')[0]->plaintext,
                    'port' => $tr->find('td')[1]->plaintext,
                    'http_type' => $tr->find('td')[3]->plaintext,
                    'isp' => $tr->find('td')[5]->plaintext,
                    'location' => $tr->find('td')[5]->plaintext,
                    'level' => $tr->find('td')[2]->plaintext,
                    'last_check_time' => $tr->find('td')[7]->plaintext,
                    'last_check_res_time' => $tr->find('td')[6]->plaintext,
                    'spider_time' => $spiderTime,
                ];
            }
            //看最后一个数据验证时间是否超过今日
            $currentPageLastOne = array_pop($data);
            //获取页面html，拿到table，取最后验证数据，看是否是今日的
        }

        echo 77;
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
