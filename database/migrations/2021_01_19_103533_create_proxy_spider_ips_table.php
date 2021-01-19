<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProxySpiderIpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proxy_spider_ips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('url_id')->comment('网址表id');
            $table->string('ip', 100)->comment('从代理网站爬到的ip');
            $table->char('http_type',5)->comment('代理ip的请求类型，默认http')->default('http');
            $table->integer('port')->comment('代理ip端口');
            $table->string('isp', 50)->comment('运营商');
            $table->string('location', 100)->comment('地理位置');
            $table->tinyInteger('is_use')->comment('是否能用,1能用，-1不能用')->default(1);
            $table->tinyInteger('level')->comment('代理级别(0:无参数 1透明代理 2匿名代理 3混淆代理 4高匿代理)');
            $table->integer('last_check_time')->comment('ip最近验证时间');
            $table->integer('last_check_res_time')->comment('ip最近验证响应时间');
            $table->integer('spider_time')->comment('采集批次eg：20200119,用日期ymd');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proxy_spider_ips');
    }
}
