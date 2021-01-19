<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProxyUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proxy_urls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('uid')->comment('以后发展成群用的，可以用多个登录维护的人自行添加')->default(null);
            $table->string('url')->comment('采集的网址');
            $table->tinyInteger('is_free')->comment('是否免费,0免费，1收钱')->default(0);
            $table->tinyInteger('is_use')->comment('是否还能用，1可以，-1不行');
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
        Schema::dropIfExists('proxy_urls');
    }
}
