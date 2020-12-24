<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->integer('safe')->change();
            $table->integer('cost')->change();
            $table->integer('fun')->change();
            $table->integer('tourism')->change();
            $table->integer('food')->change();
            $table->integer('english')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn('safe', 'cost', 'fun', 'tourism', 'food', 'english');
        });
    }
}
