<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormTypeSchemaMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_type_schema_meta', function (Blueprint $table) {
            $table->id();
            $table->integer('form_id');
            $table->integer('form_schema_id');
            $table->string('text');
            $table->string('val');
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
        Schema::dropIfExists('form_type_schema_meta');
    }
}
