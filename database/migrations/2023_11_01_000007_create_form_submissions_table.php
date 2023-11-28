<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_submissions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('form_status')->nullable();
            $table->string('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments');
            $table->string('study_program_id')->nullable();
            $table->foreign('study_program_id')->references('id')->on('study_programs');
            $table->string('form_template_id')->nullable();
            $table->foreign('form_template_id')->references('id')->on('form_templates');
            $table->string('size_file')->nullable();
            $table->string('url_file')->nullable();
            $table->string('signed_file')->nullable();
            $table->string('signed_size_file')->nullable();
            $table->timestamp('submission_date')->nullable();
            $table->longText('keterangan')->nullable();
            $table->longText('komentar')->nullable();
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
        Schema::dropIfExists('form_submissions');
    }
}
