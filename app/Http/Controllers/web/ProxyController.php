<?php

namespace App\Http\Controllers\web;

use App\Services\ProxyUrlService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tools\simple_html_dom;

class ProxyController extends Controller
{
    public $proxyUrlService;


    public function __construct(ProxyUrlService $proxyUrlService)
    {
        $this->proxyUrlService = $proxyUrlService;
    }

    public function index(){
        $simple = new simple_html_dom();
        //获取网址，爬取
        $proxyUrls = $this->proxyUrlService->getUseUrls();
        foreach ($proxyUrls as $proxyUrl){
            $url = $proxyUrl->url;
            // 判断能不能访问
            $html = file_get_contents($url);
//            $html = file_get_html($url);
            $simple->load($html);
            $trs = $simple->find('table tbody tr');
//            dd(count($trs));
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
                    'http_type' => $tr->find('td')[3]->plaintext,
                ];
            }
            dd($data);
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
