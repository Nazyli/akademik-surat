<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiplomaRetrievalRequestsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diploma_retrieval_requests_details', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('request_id')->nullable();
            $table->foreign('request_id')->references('id')->on('diploma_retrieval_requests');
            $table->string('requirement')->nullable();
            $table->foreign('requirement')->references('id')->on('diploma_requirement_types');
            $table->longText('user_notes')->nullable();
            $table->string('size_file')->nullable();
            $table->string('url_file', 500)->nullable();
            $table->string('form_status')->nullable();
            $table->timestamp('submission_date')->nullable();
            $table->timestamp('approved_date')->nullable();
            $table->string('approved_by')->nullable();
            $table->longText('comment')->nullable();
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
        Schema::dropIfExists('diploma_retrieval_requests_details');
    }
}
