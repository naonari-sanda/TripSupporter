<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('country_id')->unsigned();
            $table->decimal('recommend', 2, 1)->comment('オススメ');
            $table->integer('safe')->comment('治安');
            $table->integer('cost')->comment('費用');
            $table->integer('fun')->comment('楽しさ');
            $table->integer('tourism')->comment('観光');
            $table->integer('food')->comment('料理');
            $table->integer('english')->comment('英語');
            $table->string('city', 15)->comment('お気に入りの国');
            $table->string('review', 300)->nullable()->comment('レビュー');
            $table->string('imgpath')->nullable()->comment('画像');
            $table->timestamps();

            //外部キー
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
