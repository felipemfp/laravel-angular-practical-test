<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatasetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datasets', function (Blueprint $table) {
            $table->integer('id');

            $table->string('name');
            $table->string('description');
            $table->string('url');

            $table->integer('year_start');
            $table->integer('year_end');
            $table->string('coverage');
            $table->string('periodicity');
            $table->dateTime('updated_date');

            $table->integer('source_provider_id');
            $table->integer('source_manager_id');
            $table->integer('group_id');
            $table->integer('authority_id');

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
        Schema::dropIfExists('datasets');
    }
}
