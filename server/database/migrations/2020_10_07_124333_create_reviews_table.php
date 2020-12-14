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
            $table->decimal('safe', 2, 1)->comment('治安');
            $table->decimal('cost', 2, 1)->comment('費用');
            $table->decimal('fun', 2, 1)->nullable()->comment('楽しさ');
            $table->decimal('tourism', 2, 1)->comment('観光');
            $table->decimal('food', 2, 1)->comment('料理');
            $table->decimal('english', 2, 1)->comment('英語');
            $table->string('review')->nullable()->comment('レビュー');
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
