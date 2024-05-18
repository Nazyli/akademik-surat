<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDashboardNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dashboard_news', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string("title")->nullable();
            $table->string("body")->nullable();
            $table->string("img_url")->nullable();
            $table->string("status")->nullable();
            $table->string("category")->nullable();
            $table->integer("sort_order")->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('dashboard_news');
    }
}
