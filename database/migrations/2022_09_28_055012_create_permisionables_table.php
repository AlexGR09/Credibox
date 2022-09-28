<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermisionablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permisionables', function (Blueprint $table) {
            $table->unsignedBigInteger('permisionable_id');
            $table->string('permisionable_type');
            $table->unsignedBigInteger('permiso_id');
            $table->boolean('c')->default(false);
            $table->boolean('r')->default(false);
            $table->boolean('u')->default(false);
            $table->boolean('d')->default(false);
            $table->unsignedBigInteger('creadopor_id')->nullable();
            $table->unsignedBigInteger('actualizadopor_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permisionables');
    }
}
