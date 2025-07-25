<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expert_experiences', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('expert_id');
            $table->foreign('expert_id')->references('id')->on('experts')->onDelete('cascade');

             $table->string('name_compani')->nullable();
             $table->text('texte')->nullable();
             $table->string('spec')->nullable();
              $table->string('yers_start')->nullable();
              $table->string('yers_end')->nullable();
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
        Schema::dropIfExists('expert_experiences');
    }
};
