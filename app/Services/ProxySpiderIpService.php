<?php


namespace App\Services;

use App\Tools\simple_html_dom;

class ProxySpiderIpService
{
    public $simple;
    //获取 simple 对象
    public function getSimpleObj(){
        return new simple_html_dom();
    }

    //后期可以 接口单独出来一个处理页面的方法，几个url的解析继承接口，再绑定实现
    public function begin($url){
        //判断不同url 目前一个云代理
        //在这里分发业务
        $this->simple = $this->getSimpleObj();
        $beginUrl = $url;
        $data = [];
        //不
        $pageNum = 1;
        while (1){
            //获取html
            $html = $this->getUrlHtml($beginUrl);
            //获取html数据
            $tmp = $this->getHtmlData($html);
            array_push($data,$tmp);
            //用data判断是否有下一页
            $currentPageLastOne = array_pop($tmp);
            //只爬验证时间是当天的
            if ($this->checkLastVerifyTime($currentPageLastOne['last_check_time']) ){
                //去爬下一页 直接拼接下一页url吧
                $pageNum ++;
                $beginUrl = $url . '?stype=1&page=' . $pageNum;
            }
        }
        dd($data);
    }

    //验证表格最后一行数据的验证时间是否是当天的，不是就后面不爬了
    public function checkLastVerifyTime($lastOneCheckDate){
        return strtotime($lastOneCheckDate) > strtotime(date('Y-m-d'));
    }

    //获取html
    public function getUrlHtml($url){
        $html = iconv("gb2312", "utf-8//IGNORE",file_get_contents($url));
        return $html;
    }

    //获取页面数据
    public function getHtmlData($html){
        $spiderTime = date('YmdH');
        $this->simple->load($html);
        $trs = $this->simple->find('table tbody tr');
        $data = [];
        foreach ($trs as $tr){
            //第一个tr是th，跳过
            if (!$tr->find('td')){
                continue;
            }
            //@todo 先这么写，后面可以直接根据配置循环key，再后面可以直接黏贴html格式，算了再说吧
            $data[] = [
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
        return $data;
    }


    //判断是否有下一页
    public function ifHasNextPage($html){
        $list = $this->simple->find('#listnav a[href]',0)->href;
dd(222,$list);
        return true;
    }

    public function getNextPageUrl($html,$currentPage,$nextPage){

    }


}
