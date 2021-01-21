<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique()->comment('国名');
            $table->string('imgpath')->nullable()->comment('画像');
            $table->integer('area')->comment('面積');
            $table->integer('population')->comment('人口');
            $table->string('capital')->comment('首都');
            $table->string('language')->comment('言語');
            $table->string('religion')->comment('宗教');
            $table->integer('gdp')->comment('GDP');
            $table->integer('happiness')->comment('幸福度');
            $table->string('map')->nullable()->comment('地図');
            $table->string('covid', 300)->nullable()->comment('コロナ情報');
            $table->string('detail', 500)->comment('詳細');
            $table->string('comment', 20)->nullable()->comment('コメント');
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
        Schema::dropIfExists('countries');
    }
}
