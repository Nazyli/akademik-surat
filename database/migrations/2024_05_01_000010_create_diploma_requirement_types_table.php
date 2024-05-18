<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiplomaRequirementTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diploma_requirement_types', function (Blueprint $table) {
            $table->string("id")->primary();
            $table->string('requirement')->nullable();
            $table->longText('description')->nullable();
            $table->string('degree')->nullable();
            $table->string('status')->nullable();
            $table->integer("sort_order")->nullable();
            $table->boolean('required');
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
        Schema::dropIfExists('diploma_requirement_types');
    }
}
